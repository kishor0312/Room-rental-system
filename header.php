<?php
include 'config.php';
session_start(); // Starting the session
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>saharighar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">

                     <!-- <script>
                    function message(){
                    alert("log in as landlord to add the property");
                    }
                    </script> -->
            <script>
            function message() {
            alert('You must be logged in as a landlord to add a property.');
            }
            </script>
  
</head>

<body>
    <header>
        <!-- topbar section -->
        <div class="topbar">
            <a href="index.php" class="logo-container">
                <img src="image/logo.jpg" class="logo">
            </a>
            <div class="add-find border ">
                
         <!-- php code for user login and role verification -->
            <?php
     if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['role']) && $_SESSION['role'] === 'landlord') {
        echo '<a href="landlord_add_prop.php" class="add">ADD PROPERTY <i class="fa-solid fa-plus"></i></a>';
     } else {
        echo '<a href="login.php" class="add" onclick="message()">ADD PROPERTY <i class="fa-solid fa-plus"></i></a>';
    }
    ?>            
    

            <a href="#featured" class="find">FIND HOME</a>
            </div>            
           <div class="last-top">
            <ul>
                <li><a href="" class="account"><i class="fa-solid fa-user"></i></a></li>
                
                <!-- php code for hiding login -->
                <?php 
                if (isset($_SESSION['loggedin'])=== true){
                    echo'<li><a href="logout.php" class="logout">LOGOUT<i class="fa-solid fa-right-to-bracket"></i></a></li>';
                }else {
                    echo '<li><a href="login.php" class="login"><i class="fa-solid fa-right-to-bracket"></i>LOGIN</a></li>';   
                     }               
                   ?>       
            </ul>
           </div>
                
        </div>

        <!-- navbar section -->
        <div class="navbar">
            <ul class="navitems">
                <li><a href="index.php">HOME</a></li>
                <li><a href="room.php">ROOM</a></li>
                <li><a href="flat_apartment.php">FLATS & APARTMENT</a></li>
                <li><a href="house.php">HOUSE</a></li>
                <li><a href="hostel.php">HOSTEL ROOMS</a></li>
                <li><a href="">CONTACT</a></li>
                <li><a href="">ABOUT US</a></li>
                <li><a href="">BLOG</a></li>
            </ul>
        </div>
    </header>

   
    