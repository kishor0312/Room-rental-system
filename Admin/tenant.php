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
      <style>
        .update{
            background-color:lightgreen;
            border:lightgreen;
            border-radius:5px;
            padding:3px;
            margin:1px 5px 1px 5px;
            height:1.5rem;
        }

        .delete{
            background-color:red;
            border:red;
            border-radius:5px;
            padding:3px;
            margin:1px 5px 1px 5px;
            height:1.5rem;
        }


    </style>
</head>
<body>

<a href="index.php" class="logo-container">
    <img src="../image/logo.jpg" class="logo">
    </a>

 <?php
  $query= "SELECT * FROM user WHERE role = 'tenant'";
  $data=mysqli_query($conn,$query); 
  $total= mysqli_num_rows($data);

  if($total != 0){
    ?>
    <h1 align="center"> Detail of Tenant</h1>
    <table border="3px" align="center" cellspacing="0" width="70%" >
     <tr>
        <th width="5%"> ID</th>
        <th width="15%">Full name</th>
        <th width="10%">Email</th>
        <th width="10%">Phone number</th>
        <th width="10%">Password</th>
        <th width="20%">Operation</th>
       
    <?php
    while($row=mysqli_fetch_assoc($data))   
    {
        $id           =$row["id"];
        $full_name    =$row["full_name"];
        $email        =$row["email"];
        $p_number     =$row["phone_number"];
        $password     =$row["password"];
         
        echo"<tr>
        <td> $id </td>
        <td> $full_name </td>
        <td> $email </td>
        <td> $p_number </td>
        <td> $password </td>
        <td><a href='tenant_update.php?id=$id'><input type='submit' value='Update' class='update'></a>
            <a href='tenant_delete.php?id=$id'><input type='submit' value='Delete' class='delete' onclick='return confirm(\"Are you sure you want to delete this record?\")'></a>
        </td>      
     </tr>";
    }
}else{
        echo '<script>alert("No record found!");</script>';   
    }      
   ?>

</table>



