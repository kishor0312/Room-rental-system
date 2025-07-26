<?php
    include "config.php";

    $name = "Admin";
    $address = "Balkot";
    $phone = "Not available";
    $email = "Not available";

    $id = (int) $_GET['id'];
    $query = "SELECT owner_id FROM added_by WHERE prod_id=$id";
    $result = mysqli_query($conn, $query);
    
    $row = $result->fetch_assoc();
    $owner_id = (int) $row['owner_id'];
   
    if ($owner_id === 1) {
        $query = "SELECT phone, email FROM admin";
        $result = mysqli_query($conn, $query);
        $row = $result->fetch_assoc();
        $phone = $row['phone'];
        $email = $row['email'];
    } else {
        $query = "SELECT full_name, phone_number, email FROM user WHERE id = $owner_id";
        $result = mysqli_query($conn, $query);
        $row = $result->fetch_assoc();
        $phone = $row['phone_number'];
        $email = $row['email'];
        $name = $row['full_name'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .owner-info {
            margin: 20px 0;
        }
        .owner-info p {
            font-size: 18px;
            color: #555;
            margin: 10px 0;
        }
        .owner-info p span {
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Owner Details</h2>
        <div class="owner-info">
            <p><span>Name:</span> <?= $name ?></p>
            <p><span>Email:</span> <?= $email ?></p>
            <p><span>Phone no:</span> <?= $phone ?></p>
            <p><span>Address:</span> <?= $address ?></p>
        </div>
    </div>
</body>
</html>
