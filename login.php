
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/stylelogandreg.css">
</head>
<body>
    <div class="logo_home">
           <a href="index.php" class="logo-container">
                <img src="image/logo.jpg" class="logo">
            </a>
    </div> 
    
    <div class="log_container">
        <span><h1>User Login</h1></span>
      <form action="login.php" method="post">
           
          
            <div class="log_form_input">            
              <input class="email" type="Email" name="email" placeholder="Email or phonenumber" required>
            </div>


            
            <div class="log_form_input">             
              <input type="password" name="password" placeholder="password" required>
            </div> 

            <button type="submit" name="submit">Submit</button>

           <div class="registration">
            <P>Don't have an account? <a href="registration.php">Register</a></P>
     </div>
    </form>
 </div>   
</body>
</html>

<?php 
include 'config.php';
session_start(); // Starting the session
if(isset($_POST['submit'])){
    $email= $_POST['email'];
    $password = $_POST['password'];

    // Check if the user exists in the user table
    $sql= "SELECT * FROM user WHERE email='$email' AND password ='$password'";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if($result->num_rows > 0){
        // Login successful, set session variables
        $_SESSION['email'] = $email;
        $_SESSION['loggedin'] = true;
        $_SESSION['id'] = $row['id'];

        $_SESSION['role']=$row['role'];
        // var_dump($_SESSION['id']);      
        // die();
        
        header("Location: index.php");
        exit();
    } else {
        // Login failed
        echo '<script>alert("Invalid username or password");</script>';   
        exit();
    }
}

?>