<?php
  include '../config.php';
  session_start(); // Starting the session
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />  
      <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

<?php
  $uname = $_SESSION['u_name'];
  if($uname == true)
  {

  }else{
    header("Location: login.php");
  }
?>
  <div class="sidebar">
  <a href="" class="logo-container">
    <img src="../image/logo.jpg" class="logo">
    </a>
    <ul>
      <li><a href="index.php" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
      <li><a href="addproperty.php"><i class="fas fa-plus"></i> Add Property</a></li>
      <li><a href="view property.php"><i class="fas fa-eye"></i> View Property</a></li>
      <li><a href="tenant.php"><i class="fas fa-users"></i> Tenant Management</a></li>
      <li><a href="landlord.php"><i class="fas fa-user-tie"></i> Landlord Management</a></li>
      <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
  </div>

  <div class="header">
    <h2>Dashboard</h2>
    <a href=""><img src="my_image.jpg" alt="" height="55rem" width=""></a>
  </div>

  <div class="dashboard">
  <?php
  $query= "select * from  prop_detail";
  $data=mysqli_query($conn,$query);
  $total= mysqli_num_rows($data);

  echo" 
     <div class='card_1' >
     <h2>Property Details</h2>
     <p>Total: <span id='propertyCount'>$total</span></p>
     </div>
   ";
  ?>
 
 <?php
  $query= "SELECT * FROM user WHERE role = 'tenant'";
  $data=mysqli_query($conn,$query);
  $total= mysqli_num_rows($data);
  echo "
    <div class='card_2'>
      <h2>Tenants Details</h2>
      <p>Total: <span id='tenantCount'>$total</span></p>
    </div>
  ";
?>


<?php
  $query= "SELECT * FROM user WHERE role = 'landlord'";
  $data=mysqli_query($conn,$query);
  $total= mysqli_num_rows($data);
  echo "
    <div class='card_3'>
      <h2>Landlord Details</h2>
      <p>Total: <span id='LandlordCount'>$total</span></p>
    </div>
  ";
?>