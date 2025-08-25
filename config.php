<?php
$servername = "localhost";
$username = "foo";
$password = "bar";
$dbname="saharighar";

  $conn = new mysqli($servername,$username,$password,$dbname);

  if($conn->connect_error){
   die("Connection failed: ". $conn->connect_error);
  }
?>