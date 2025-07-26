<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/stylelogandreg.css">
</head>
<body>
    <div class="logo_home">
           <a href="index.php" class="logo-container">
                <img src="../image/logo.jpg" class="logo">
            </a>
    </div> 
    
    <div class="log_container">
        <span><h1>Admin Login</h1></span>
      <form action="login.php"  method="post">
           
          
            <div class="log_form_input">            
              <input class="uname" type="text" name="uname" placeholder="username">
            </div>

            
         
            <div class="log_form_input">             
              <input type="password" name="password" placeholder="password">
            </div> 

            <button type="submit" name="submit">Submit</button>
    </form>
 </div>   
</body>
</html>

<?php 

include "../config.php";
session_start(); // Starting the session

if(isset($_POST['submit'])){
    $uname= $_POST['uname'];
    $password = $_POST['password'];

    $sql= "SELECT * FROM admin WHERE u_name='$uname' AND password ='$password'";
    
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if($result->num_rows > 0){
        // Login successful, set session variables
        $_SESSION['u_name'] = $uname;
        $_SESSION['loggedin'] = true;
        $_SESSION['a_id'] = $row['id'];
        
        header("Location: index.php");
        exit();
    } else {
        // Login failed
        echo '<script>alert("Invalid username or password");</script>';   
        exit();
    }
}
?>