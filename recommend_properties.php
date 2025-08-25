<?php
include 'config.php';
include 'recommend.php';
$logged_in = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;

$recommended = get_recommended_items_for_curr_user();
if(count($recommended) ==0) exit;
$recommended = implode(",", $recommended);
$query = "SELECT * FROM prop_detail WHERE prod_id in ($recommended)";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row["prod_id"];
        $title = $row["title"];
        $price = $row["price"];
        $location = $row["location"];
        $image = $row["image"];
        $area = $row["area"];
        $bedroom = $row["bedroom"];
        $bathroom = $row["bathroom"];

        echo "
        <div class='box'>
            <div class='image-container'>
                <img src='./Admin/property_images/$image' alt='roomimage'>
            </div>
            <div class='content'>
                <div class='price'>
                    <h3>$price / Month</h3>
                    <a href='#' class='fas fa-envelope'></a>
                    <a href='#' class='fas fa-phone'></a>
                </div>
            </div>
            <div class='location'>
                <h3>$title</h3>
                <p>$location</p>
            </div>
            <div class='detail'>
                <h3><i class='fas fa-expand'></i> $area sqft</h3>
                <h3><i class='fas fa-bed'></i> $bedroom bed</h3>
                <h3><i class='fas fa-bath'></i> $bathroom bath</h3>
            </div>
            <form method='GET' class='buttons' action='card_detail.php' onsubmit='return checkLogin($logged_in)'>  
                <input type='hidden' name='id' value='$id'>         
                <button type='submit' class='btn'>More Detail</button>
            </form>
        </div>
        ";
    }
} else {
    echo "<p style='color:red;'>No properties found.</p>";
}
?>
