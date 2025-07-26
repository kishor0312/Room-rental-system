<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Example</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .footer {
            background-color: white;
            color: black;
            padding: 20px 0;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            border-top: 1px solid #ddd;
        }
        .footer div {
            margin: 10px;
        }
        .footer a {
            color: gray;
            text-decoration: none;
            display: block;
            margin: 5px 0;
        }
        .footer a:hover {
            color: black;
        }
        .footer .contact-us {
            text-align: left;
        }
        .footer .contact-us p {
            margin: 5px 0;
        }
        .footer .social-icons {
            display: flex;
            gap: 10px;
        }
        .footer .social-icons a {
            color: black;
            font-size: 25px;
        }
        .footer .social-icons a:hover{
            color: #007bff;
        }
        .footer .social-icons .insta a.insta {
            background: linear-gradient(45deg, #feda75, #fa7e1e, #d62976, #962fbf, #4f5bd5);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .footer .social-icons .insta a:hover {
            background: linear-gradient(45deg, #fa7e1e, #d62976, #962fbf, #4f5bd5, #feda75);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .footer .social-icons .whatsapp a:hover{
            color: green;
        }
        
        .footer .logo img {
            width: 100px;
            height: auto;
        }
        .footer .copyright {
            background-color: #f1f1f1;
            color: black;
            text-align: center;
            padding: 10px 0;
            margin-top: 10px;
            width: 100%;
        }
    </style>
</head>
<body>

<!-- Your website content -->

<?php
echo '
<div class="footer">
<a href="" class="logo-container">
<img src="image/logo.jpg" class="logo">
</a>
    <div>
        <h3>Quick Links</h3>
        <a href="home.php">Home</a>
        <a href="room.php">Room</a>
        <a href="flat_and_apartment.php">Flat and Apartment</a>
        <a href="house.php">House</a>
        <a href="hostel_room.php">Hostel Room</a>
        <a href="about_us.php">About Us</a>
        <a href="blog.php">Blog</a>
    </div>
    <div class="contact-us">
        <h3>Contact Us</h3>
        <p>Balkot-kausaltar road, Balkot, Bhaktapur</p>
        <p>9814311191, 9811320312</p>
        <p><a href="mailto:info@saharighar.com" style="color: #000;">info@saharighar.com</a></p>
        <div class="social-icons">
        <div class="facebook">
        <a href="https://www.facebook.com" id="facebook"><i class="fa-brands fa-facebook"></i></a>
        </div>

        <div class="insta">
        <a href="https://www.instagram.com"><i class="fa-brands fa-square-instagram"></i>   </a>
        </div>

        <div class="whatsapp">
        <a href="https://www.whatsapp.com" id="whatsapp"><i class="fa-brands fa-square-whatsapp"></i></a>
        </div>
           
        </div>
    </div>
</div>
<div class="footer copyright">
    <div>Copyright © 2024 - saharighar.com - All rights reserved.</div>
</div>
';
?>

</body>
</html>
