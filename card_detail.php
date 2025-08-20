<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Detail</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 1000px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        .image-container img {
            width: 100%;
            border-radius: 15px;
            object-fit: cover;
        }
        .info {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 15px;
        }
        .info h3 {
            font-size: 16px;
            color: #666;
            background: #f0f0f0;
            padding: 6px 12px;
            border-radius: 20px;
        }
        .price {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-top: 15px;
        }
        .price h3 {
            color: #e67e22;
            font-size: 22px;
            margin: 0;
        }
        .price a {
            color: #e67e22;
            font-size: 18px;
            transition: color 0.3s;
        }
        .price a:hover {
            color: #d35400;
        }
        .location h3 {
            font-size: 24px;
            margin-top: 20px;
        }
        .location p {
            font-size: 16px;
            color: #777;
        }
        .detail {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }
        .detail h3 {
            font-size: 16px;
            color: #555;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .detail i {
            color: #e67e22;
        }
        .buttons {
            text-align: center;
            margin-top: 25px;
        }
        .btn {
            background: #e67e22;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            text-transform: uppercase;
            font-size: 14px;
            transition: background 0.3s;
        }
        .btn:hover {
            background: #d35400;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .container {
                margin: 10px;
                padding: 15px;
            }
            .location h3 {
                font-size: 20px;
            }
            .price h3 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/hmac-sha256.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/enc-base64.min.js"></script>
<script>
    function generateSignature() {
        var currentTime = new Date();
        var formattedTime = currentTime.toISOString().slice(2, 10).replace(/-/g, '') + '-' + currentTime.getHours() + currentTime.getMinutes() + currentTime.getSeconds();
        document.getElementById("transaction_uuid").value = formattedTime;
        
        var total_amount = document.getElementById("total_amount").value;
        var transaction_uuid = document.getElementById("transaction_uuid").value;
        var product_code = document.getElementById("product_code").value;
        var secret = "8gBm/:&EnhH.1/q";
        
        var hash = CryptoJS.HmacSHA256(`total_amount=${total_amount},transaction_uuid=${transaction_uuid},product_code=${product_code}`, secret);
        var hashInBase64 = CryptoJS.enc.Base64.stringify(hash);
        document.getElementById("signature").value = hashInBase64;
    }
</script>

<div class="container">
    <h2>Detail of property:</h2>

    <?php
        include "config.php";
        $s = hash_hmac('sha256', 'Message', 'secret', true);
        $id = $_GET['id'];
        $query = "SELECT * FROM prop_detail WHERE prod_id='$id'";
        $result = mysqli_query($conn, $query);  
        while ($row = mysqli_fetch_assoc($result)) {
            $id       = $row["prod_id"];
            $title    = $row["title"];
            $price    = $row["price"];
            $location = $row["location"];
            $image    = $row["image"];
            $area     = $row["area"];
            $bedroom  = $row["bedroom"];
            $bathroom = $row["bathroom"];
            
            echo "
            <div class='image-container'>
                <img src='./Admin/property_images/$image' alt='room image'>
            </div>
            <div class='info'>
                <h3>3 days ago</h3>
                <h3>For Rent</h3>
            </div>
            <div class='price'>
                <h3>$".$price."/month</h3>
                <a href='#'><i class='fas fa-heart'></i></a>
                <a href='#'><i class='fas fa-envelope'></i></a>
                <a href='#'><i class='fas fa-phone'></i></a>
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
            ";
        }
    ?>

    <div class="buttons">
        <form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form"  method="POST" onsubmit="generateSignature()" target="_blank">
            <input type="hidden" id="amount" name="amount" value="<?php echo $price ?>" required>
            <input type="hidden" id="tax_amount" name="tax_amount" value="0" required>
            <input type="hidden" id="total_amount" name="total_amount" value="<?php echo $price ?>" required>
            <input type="hidden" id="transaction_uuid" name="transaction_uuid" value="241031" required>
            <input type="hidden" id="product_code" name="product_code" value="EPAYTEST" required>
            <input type="hidden" id="product_service_charge" name="product_service_charge" value="0" required>
            <input type="hidden" id="product_delivery_charge" name="product_delivery_charge" value="0" required>
            <input type="hidden" id="success_url" name="success_url" value="https://esewa.com.np" required>
            <input type="hidden" id="failure_url" name="failure_url" value="https://google.com" required>
            <input type="hidden" id="signed_field_names" name="signed_field_names" value="total_amount,transaction_uuid,product_code" required>
            <input type="hidden" id="signature" name="signature" value="<?php echo base64_encode($s); ?>" required>
            <input class="btn" value="Book now" type="submit">
        </form>
    </div>
</div>
</body>
</html>
