<?php


function to_float($v, $default = 0.0) {
    if ($v === null || $v === '') return (float)$default;
    return (float)$v;
}

function min_max_scale_value($val, $min, $max) {
    if ($max - $min == 0) return 0.0;
    return ($val - $min) / ($max - $min);
}

function one_hot_encode_value($value, $unique_values) {
    $row = array_fill(0, count($unique_values), 0);
    $index = array_search($value, $unique_values, true);
    if ($index !== false) $row[$index] = 1;
    return $row;
}

function build_flat_vector_from_vectorized($item, $schema) {
    $flat = [];
    $flat[] = isset($item['price']) ? (float)$item['price'] : 0.0;
    $flat[] = isset($item['area']) ? (float)$item['area'] : 0.0;
    $flat = array_merge($flat, isset($item['location']) ? $item['location'] : array_fill(0, count($schema['location']), 0));
    $flat = array_merge($flat, isset($item['bedroom']) ? $item['bedroom'] : array_fill(0, count($schema['bedroom']), 0));
    $flat = array_merge($flat, isset($item['bathroom']) ? $item['bathroom'] : array_fill(0, count($schema['bathroom']), 0));
    return array_map('floatval', $flat);
}

function euclidean_distance_arrays($a, $b) {
    $len = max(count($a), count($b));
    $sum = 0.0;
    for ($i = 0; $i < $len; $i++) {
        $av = ($i < count($a)) ? $a[$i] : 0.0;
        $bv = ($i < count($b)) ? $b[$i] : 0.0;
        $sum += ($av - $bv) * ($av - $bv);
    }
    return sqrt($sum);
}

function distance($a, $b, $weight = 1.0) {
    $dist = euclidean_distance_arrays($a, $b);
    $w = is_numeric($weight) ? (float)$weight : 1.0;
    return $dist + 1.0 - $w;
}

function build_global_schema_and_rows($conn) {
    $sql = "SELECT prod_id, price, location, bedroom, area, bathroom FROM prop_detail";
    $res = $conn->query($sql);
    if (!$res) die("Query failed: " . $conn->error);

    $rows = [];
    $price_vals = $area_vals = $locations = $bedrooms = $bathrooms = [];

    while ($r = $res->fetch_assoc()) {
        $r['location'] = isset($r['location']) ? trim($r['location']) : '';
        $r['bedroom']  = isset($r['bedroom']) ? trim($r['bedroom']) : '';
        $r['bathroom'] = isset($r['bathroom']) ? trim($r['bathroom']) : '';
        $r['price']    = ($r['price'] === null || $r['price'] === '') ? 0 : to_float($r['price']);
        $r['area']     = ($r['area'] === null || $r['area'] === '') ? 0 : to_float($r['area']);

        $rows[] = $r;
        $price_vals[] = $r['price'];
        $area_vals[]  = $r['area'];
        if ($r['location'] !== '') $locations[] = $r['location'];
        if ($r['bedroom']  !== '') $bedrooms[] = $r['bedroom'];
        if ($r['bathroom'] !== '') $bathrooms[] = $r['bathroom'];
    }

    $locations = array_values(array_unique($locations));
    sort($locations, SORT_NATURAL | SORT_FLAG_CASE);
    $bedrooms = array_values(array_unique($bedrooms));
    sort($bedrooms, SORT_NATURAL | SORT_FLAG_CASE);
    $bathrooms = array_values(array_unique($bathrooms));
    sort($bathrooms, SORT_NATURAL | SORT_FLAG_CASE);

    $schema = [
        'price_min' => count($price_vals) ? min($price_vals) : 0,
        'price_max' => count($price_vals) ? max($price_vals) : 0,
        'area_min'  => count($area_vals) ? min($area_vals) : 0,
        'area_max'  => count($area_vals) ? max($area_vals) : 0,
        'location'  => $locations,
        'bedroom'   => $bedrooms,
        'bathroom'  => $bathrooms,
    ];

    return ['rows' => $rows, 'schema' => $schema];
}

function vectorize_row($row, $schema) {
    $price_s = min_max_scale_value(to_float($row['price']), $schema['price_min'], $schema['price_max']);
    $area_s  = min_max_scale_value(to_float($row['area']), $schema['area_min'], $schema['area_max']);

    return [
        'prop_id'  => $row['prod_id'],
        'price'    => $price_s,
        'area'     => $area_s,
        'location' => one_hot_encode_value($row['location'], $schema['location']),
        'bedroom'  => one_hot_encode_value($row['bedroom'], $schema['bedroom']),
        'bathroom' => one_hot_encode_value($row['bathroom'], $schema['bathroom'])
    ];
}

function knn_recommend($conn, $curr_items_raw, $k = 5) {
    $global = build_global_schema_and_rows($conn);
    $db_rows = $global['rows'];
    $schema  = $global['schema'];

    $db_vectorized = [];
    foreach ($db_rows as $r) {
        $db_vectorized[$r['prod_id']] = vectorize_row($r, $schema);
    }

    $curr_rows = [];
    foreach ($curr_items_raw as $r) $curr_rows[] = $r;

    $curr_vectorized = [];
    foreach ($curr_rows as $r) {
        $vec = vectorize_row($r, $schema);
        $vec['weight'] = isset($r['weight']) ? (float)$r['weight'] : 1.0;
        $curr_vectorized[] = $vec;
    }

    $distances_best = [];
    foreach ($curr_vectorized as $curr) {
        $flat_curr = build_flat_vector_from_vectorized($curr, $schema);
        foreach ($db_vectorized as $db_prod_id => $db_vec) {
            if ($db_prod_id == $curr['prop_id']) continue;
            $flat_db = build_flat_vector_from_vectorized($db_vec, $schema);
            $dist = distance($flat_curr, $flat_db, $curr['weight']);
            if (!isset($distances_best[$db_prod_id]) || $dist < $distances_best[$db_prod_id]) {
                $distances_best[$db_prod_id] = $dist;
            }
        }
    }

    if (empty($distances_best)) return [];
    asort($distances_best);
    return array_slice(array_keys($distances_best), 0, $k, true);
}

function get_recommended_items_for_curr_user($k = 5) {
    include 'config.php';
    if (!isset($_SESSION['id'])) return [];
    $uid = $_SESSION['id'];

    $sql = "SELECT il.prop_id AS prod_id, pd.price, pd.location, pd.bedroom, pd.area, pd.bathroom, il.weight 
            FROM interaction_log il
            JOIN prop_detail pd ON il.prop_id = pd.prod_id
            WHERE il.uid = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) die("Prepare failed: " . $conn->error);
    $stmt->bind_param("i", $uid);
    $stmt->execute();
    $res = $stmt->get_result();
    if (!$res) die("Query failed: " . $conn->error);

    $curr_rows = [];
    while ($r = $res->fetch_assoc()) {
        $curr_rows[] = [
            'prod_id'  => $r['prod_id'],
            'price'    => $r['price'],
            'location' => $r['location'],
            'bedroom'  => $r['bedroom'],
            'area'     => $r['area'],
            'bathroom' => $r['bathroom'],
            'weight'   => isset($r['weight']) ? $r['weight'] : 1.0
        ];
    }
    return knn_recommend($conn, $curr_rows, $k);
}

function get_recommended_items_for_curr_product($id, $k = 5) {
    include 'config.php';
    if (!isset($id)) return [];

    $sql = "SELECT prod_id, price, location, bedroom, area, bathroom FROM prop_detail WHERE prod_id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) die("Prepare failed: " . $conn->error);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    if (!$res) die("Query failed: " . $conn->error);
    if ($res->num_rows == 0) return [];

    $r = $res->fetch_assoc();
    $curr_rows = [[
        'prod_id'  => $r['prod_id'],
        'price'    => $r['price'],
        'location' => $r['location'],
        'bedroom'  => $r['bedroom'],
        'area'     => $r['area'],
        'bathroom' => $r['bathroom'],
        'weight'   => 1.0
    ]];
    return knn_recommend($conn, $curr_rows, $k);
}
?>
