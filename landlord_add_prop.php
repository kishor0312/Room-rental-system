<?php
session_start();
include "config.php";

if(isset($_POST['submit'])){

    // Get form values
    $title = $_POST['title'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $location = $_POST['location'];
    $area = $_POST['area'];
    $bedroom = $_POST['bedroom'];
    $bathroom = $_POST['bathroom'];
    $latitude = isset($_POST['latitude']) ? $_POST['latitude'] : 0.0;
    $longitude = isset($_POST['longitude']) ? $_POST['longitude'] : 0.0;

    // Image upload
    $image = $_FILES['image']['name'];
    $temp_image = $_FILES['image']['tmp_name'];
    move_uploaded_file($temp_image, "landlord_prop_image/$image");

    // Insert into prop_detail
    $query = "INSERT INTO prop_detail 
        (title, type, price, location, image, area, bedroom, bathroom, latitude, longitude)
        VALUES
        ('$title','$type','$price', '$location', '$image', '$area', '$bedroom', '$bathroom', '$latitude', '$longitude')";
    
    $data = mysqli_query($conn, $query);

    // Get last inserted prod_id
    $query = "SELECT prod_id FROM prop_detail WHERE prod_id = (SELECT MAX(prod_id) FROM prop_detail)";
    $result = $conn->query($query);
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $prod_id = $row['prod_id'];
        $id = $_SESSION['id'];
        $query = "INSERT INTO added_by (prod_id, owner_id, owner_type) VALUES($prod_id, $id,'landlord')";
        $data = mysqli_query($conn, $query);
    }

    if($data){
        echo '<script>alert("Property added successfully!");</script>';
    } else {
        echo '<script>alert("Data insertion failed!");</script>';
    }

    $conn->close(); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Property by Landlord</title>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<style>
body {margin:0; padding:0; font-family: Arial, sans-serif;}
.form_container {max-width:40rem; margin:50px auto; padding:20px; background-color:#fff; border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,0.1);}
h2 {display:block; margin-left:10rem;}
.form_container label {display:block; margin-bottom:10px;}
.form_container input, .form_container select {width:80%; padding:10px; margin-bottom:20px; border:1px solid #ccc; border-radius:5px;}
.prop_detail {display:flex; justify-content:space-evenly; margin-top:1rem;}
.prop_detail label {margin-left:1rem;}
.prop_detail .feet, .prop_detail .bedroom, .prop_detail .bathroom {width:5rem;}

/* Updated button style (orange, same as property detail page) */
.form_container .submit input[type="submit"] {
    background: #e67e22;
    color: white;
    padding: 12px 25px;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    text-transform: uppercase;
    font-size: 14px;
    transition: background 0.3s;
    margin-top: 2rem;
    margin-left: 5rem;
}
.form_container .submit input[type="submit"]:hover {
    background: #d35400;
}

#map {width:80%; height:400px; margin-bottom:20px;}
</style>

</head>
<body>

<a href="index.php" class="logo-container">
<img src="image/logo.jpg" class="logo">
</a>

<form action="" method="POST" enctype="multipart/form-data">
<div class="form_container">
    <h2>Enter Property Detail</h2>

    <label>Property Title:</label>
    <input type="text" name="title" placeholder="Enter property title" required>

    <label>Select property type:</label>
    <select name="type" required>
        <option value="room">Rooms</option>
        <option value="flats & apartment">Flats and apartment</option>
        <option value="house">House</option>
        <option value="hostel room">Hostel rooms</option>
    </select>

    <label>Property Price:</label>
    <input type="text" name="price" placeholder="Enter the price" required>

    <label>Property Location:</label>
    <input type="text" name="location" placeholder="Enter the location" required>

    <label>Upload Image:</label>
    <input type="file" name="image">

    <div class="prop_detail">
        <label>SQFT:</label> <input type="number" name="area" class="feet">
        <label>No of Bedrooms:</label> <input type="number" name="bedroom" class="bedroom">
        <label>No of Bathrooms:</label> <input type="number" name="bathroom" class="bathroom">
    </div>

    <!-- Map Section -->
    <label>Select Property Location on Map:</label>
    <div id="map"></div>
    <input type="hidden" name="latitude" id="latitude">
    <input type="hidden" name="longitude" id="longitude">

    <div class="submit">
        <input type="submit" name="submit" value="Submit">
    </div>
</div>
</form>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
// Initialize map
var defaultLat = 27.7172; // Kathmandu
var defaultLng = 85.3240;
var map = L.map('map').setView([defaultLat, defaultLng], 13);

// Add OpenStreetMap tiles
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap'
}).addTo(map);

// Add draggable marker
var marker = L.marker([defaultLat, defaultLng], {draggable: true}).addTo(map);

// Update hidden fields on marker move
marker.on('dragend', function(e){
    var latLng = marker.getLatLng();
    document.getElementById('latitude').value = latLng.lat;
    document.getElementById('longitude').value = latLng.lng;
});

// Set initial hidden fields
document.getElementById('latitude').value = defaultLat;
document.getElementById('longitude').value = defaultLng;
</script>

</body>
</html>
