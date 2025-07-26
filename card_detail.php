<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Detail</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 40rem;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .image-container img {
            width: 100%;
            border-radius: 10px;
        }
        .info, .content, .location, .detail, .buttons {
            margin: 20px 0;
        }
        .info h3, .content h3, .location h3, .detail h3 {
            margin: 0 0 10px;
        }
        .info h3 {
            font-size: 18px;
            color: #555;
        }
        .price h3 {
            color: #e67e22;
            margin: 0;
        }
        .price a {
            margin-left: 10px;
            color: #e67e22;
            text-decoration: none;
        }
        .price a:hover {
            color: #d35400;
        }
        .location h3 {
            font-size: 24px;
        }
        .location p {
            font-size: 16px;
            color: #777;
        }
        .detail h3 {
            font-size: 18px;
            color: #555;
        }
        .detail h3 i {
            margin-right: 5px;
            color: #e67e22;
        }
        .buttons {
            text-align: center;
        }
        .buttons .btn {
            background: #e67e22;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-transform: uppercase;
        }
        .buttons .btn:hover {
            background: #d35400;
        }
    </style>
</head>
<body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/hmac-sha256.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/enc-base64.min.js"></script>
<script>
    function generateSignature() {
        // Generate transaction UUID
        var currentTime = new Date();
        var formattedTime = currentTime.toISOString().slice(2, 10).replace(/-/g, '') + '-' + currentTime.getHours() + currentTime.getMinutes() + currentTime.getSeconds();
        document.getElementById("transaction_uuid").value = formattedTime;
        
        // Retrieve payment details
        var total_amount = document.getElementById("total_amount").value;
        var transaction_uuid = document.getElementById("transaction_uuid").value;
        var product_code = document.getElementById("product_code").value;
        var secret = "8gBm/:&EnhH.1/q"; // Replace with your actual secret key
        
        // Generate signature
        var hash = CryptoJS.HmacSHA256(`total_amount=${total_amount},transaction_uuid=${transaction_uuid},product_code=${product_code}`, secret);
        var hashInBase64 = CryptoJS.enc.Base64.stringify(hash);
        document.getElementById("signature").value = hashInBase64;
    }
      // Call generateSignature() when input fields are changed
    document.getElementById("total_amount").addEventListener("input", generateSignature);
    document.getElementById("transaction_uuid").addEventListener("input", generateSignature);
    document.getElementById("product_code").addEventListener("input", generateSignature);
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
                ";
            }
            ?>
                
                <div class='info'>
                    <h3>3 days ago</h3>
                    <h3>for rent</h3>
                </div>
                <div class='content'>
                    <div class='price'>
                        <h3><?php echo"$".$price."/month";?></h3>
                        <a href='#' class='fas fa-heart'></a>
                        <a href='#' class='fas fa-envelope'></a>
                        <a href='#' class='fas fa-phone'></a>
                    </div>
                </div>
                <div class='location'>
                    <h3><?php echo $title?></h3>
                    <p><?php echo $location?></p>
                </div>
                <div class='detail'>
                    <h3><i class='fas fa-expand'></i> <?php echo $area?> sqft</h3>
                    <h3><i class='fas fa-bed'></i> <?php echo $bedroom?> bed</h3>
                    <h3><i class='fas fa-bath'></i> <?php echo $bathroom?> bath</h3>
                </div>
                <div class='buttons'>
                   
    <form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form"  method="POST" onsubmit="generateSignature()" target="_blank">
 <input type="hidden" id="amount" name="amount" value=<?php echo $price ?> required>
 <input type="hidden" id="tax_amount" name="tax_amount" value ="0" required>
 <input type="hidden" id="total_amount" name="total_amount" value=<?php echo $price ?> required>
 <input type="hidden" id="transaction_uuid" name="transaction_uuid" value="241031" required>
 <input type="hidden" id="product_code" name="product_code" value ="EPAYTEST" required>
 <input type="hidden" id="product_service_charge" name="product_service_charge" value="0" required>
 <input type="hidden" id="product_delivery_charge" name="product_delivery_charge" value="0" required>
 <input type="hidden" id="success_url" name="success_url" value="https://esewa.com.np" required>
 <input type="hidden" id="failure_url" name="failure_url" value="https://google.com" required>
 <input type="hidden" id="signed_field_names" name="signed_field_names" value="total_amount,transaction_uuid,product_code" required>
 <input type="hidden" id="signature" name="signature" value=<?php echo base64_encode($s); ?> required>
 <input value="Book now" type="submit">
 </form>
      </div>   
    </div>
     


</body>
</html>
