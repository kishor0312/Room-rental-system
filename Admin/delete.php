<?php
include '../config.php';

$id= $_GET['id'];

$query = "delete from prop_detail where prod_id='$id' ";
$data= mysqli_query ($conn, $query);

if($data){
   
    echo '<script>alert("Data deleted successfully!");</script>';
    ?>
<meta http-equiv="refresh" content="0; url = http://localhost/BCA%204th%20sem%20project/admin/view%20property.php" />
   <?php
}else{
    echo"not deleted";
}
?>