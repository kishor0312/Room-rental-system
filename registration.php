<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration</title>
  <link rel="stylesheet" href="css/stylelogandreg.css">
  <style>
    .error-message {
      color: red;
      font-size: 14px;
      margin-top: 2px;
      display: none;
    }
    .success-message {
      color: green;
      font-size: 14px;
      margin-top: 2px;
      display: none;
    }
  </style>
  <script>
    // Regex for name: only alphabets with max 2 spaces allowed
    const namePattern = /^[A-Za-z]+(?: [A-Za-z]+){0,2}$/;

    // Live Name validation
    function validateNameLive() {
      const nameField = document.getElementById("fullname");
      const nameError = document.getElementById("nameError");

      if (nameField.value === "") {
        nameError.style.display = "none";
        return;
      }

      if (!namePattern.test(nameField.value)) {
        nameError.textContent = "Enter a valid full name (only letters, max 2 spaces).";
        nameError.className = "error-message";
        nameError.style.display = "block";
      } else {
        nameError.textContent = "Valid name ✔";
        nameError.className = "success-message";
        nameError.style.display = "block";
      }
    }

    // Live Email validation
    function validateEmailLive() {
      const emailField = document.getElementById("email");
      const emailError = document.getElementById("emailError");
      const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

      if (emailField.value === "") {
        emailError.style.display = "none";
        return;
      }

      if (!emailPattern.test(emailField.value)) {
        emailError.textContent = "Enter a valid email (e.g., name@example.com).";
        emailError.className = "error-message";
        emailError.style.display = "block";
      } else {
        emailError.textContent = "Valid email ✔";
        emailError.className = "success-message";
        emailError.style.display = "block";
      }
    }

    // Password validation on submit
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

    function toggleLandlordFields() {
      const role = document.querySelector('input[name="role"]:checked').value;
      const landlordFields = document.getElementById('landlord-fields');
      if (role === 'landlord') {
        landlordFields.style.display = 'block';
      } else {
        landlordFields.style.display = 'none';
      }
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
      <input type="text" id="fullname" name="fullname" placeholder="Full name" required oninput="validateNameLive()">
      <div id="nameError" class="error-message"></div>
    </div>

    <div class="form_input">
      <input type="email" id="email" name="email" placeholder="Email" required oninput="validateEmailLive()">
      <div id="emailError" class="error-message"></div>
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
