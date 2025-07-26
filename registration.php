<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="css/stylelogandreg.css">
    <script>
        function toggleLandlordFields() {
            const role = document.querySelector('input[name="role"]:checked').value;
            const landlordFields = document.getElementById('landlord-fields');
            if (role === 'landlord') {
                landlordFields.style.display = 'block';
            } else {
                landlordFields.style.display = 'none';
            }
        }

        function validatePassword() {
            const password = document.getElementById('password').value;
            const repPassword = document.getElementById('rep_password').value;
            const passwordPattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/;

            if (!passwordPattern.test(password)) {
                alert('Password must be at least 8 characters long, contain 1 uppercase letter, 1 number, and 1 special character.');
                return false;
            }

            if (password !== repPassword) {
                alert('Passwords do not match.');
                return false;
            }

            return true;
        }
    </script>
</head>
<body>

<div class="logo_home">
    <a href="index.php" class="logo-container">
        <img src="image/logo.jpg" class="logo">
    </a>
</div>

<div class="reg_container">
    <span><h1>REGISTER NOW</h1></span>
    <form action="" method="post" enctype="multipart/form-data" onsubmit="return validatePassword()">
        <div class="form_input">
            <input type="text" name="fullname" placeholder="Full name" required>
        </div>

        <div class="form_input">
            <input type="Email" name="email" placeholder="Email" required>
        </div>

        <div class="form_input">
            <input type="text" name="phonenmbr" minlength="10" maxlength="10" placeholder="Phone number" required>
        </div>

        <div class="form_input">
            <input type="password" id="password" name="password" placeholder="Password" required>
        </div>

        <div class="form_input">
            <input type="password" id="rep_password" name="Repeat_password" placeholder="Repeat Password" required>
        </div>

        <div class="radio_input">
            <label>Select Your Role:</label>
            <input type="radio" class="radio_input" value="landlord" name="role" required onclick="toggleLandlordFields()"> Landlord
            <input type="radio" class="radio_input" value="tenant" name="role" required onclick="toggleLandlordFields()"> Tenant
        </div>

        <div id="landlord-fields" style="display:none;">
            <div class="form_input">
                <input type="text" name="address" placeholder="Address">
            </div>
            
            <div class="form_input">
                <label class="label">Upload ID:</label>
                <input type="file" name="image" accept="image/*">
            </div>
             
        </div>

        <button type="submit" name="submit">Submit</button>

        <span id="login"><p>Already have an account? <a href="login.php">Login Now</a></p></span>
    </form>
</div>

</body>
</html>

<?php
include 'config.php';

if(isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phonenmbr'];
    $password = $_POST['password'];
    $rep_password = $_POST['Repeat_password'];
    $role = $_POST['role'];
    $address = $_POST['address'];

    // image access
    $image = $_FILES['image']['name'];
    // accessing image temp name
    $temp_image = $_FILES['image']['tmp_name'];

    move_uploaded_file($temp_image, "landlord_id_image/$image");

    if($password == $rep_password) {
        $sql = "INSERT INTO user (full_name, email, phone_number, password, repeat_password, role, landlord_address, landlordid_image) 
                VALUES ('$fullname', '$email', '$phone', '$password', '$rep_password', '$role', '$address', '$image')";

        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Account created successfully");</script>';
            echo '<script>window.location.href = "login.php";</script>';    
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo '<script>alert("Password didn\'t match");</script>';
        echo '<script>window.location.href = "registration.php";</script>';    
    }

    $conn->close();
}
?>
