<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Update</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .reg_container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        .reg_container h1 {
            margin-bottom: 20px;
            color: #333;
        }

        .form_input {
            margin-bottom: 15px;
            position: relative;
        }

        .form_input input {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 5px 0 0 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form_input input:focus {
            border-color: #007bff;
            outline: none;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #0056b3;
        }

        .alert {
            color: red;
            font-size: 12px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="reg_container">
    <h1>Tenant Update</h1>

    <?php
        include "../config.php";
        $id = $_GET['id'];
        $query = "SELECT * FROM user WHERE id='$id'";
        $data = mysqli_query($conn, $query);
        $result = mysqli_fetch_assoc($data);
    ?>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="form_input">
            <input type="text" value="<?php echo $result['full_name']; ?>" name="fullname" placeholder="Full name" required>
        </div>

        <div class="form_input">
            <input type="email" value="<?php echo $result['email']; ?>" name="email" placeholder="Email" required>
        </div>

        <div class="form_input">
            <input type="text" value="<?php echo $result['phone_number']; ?>" name="phonenmbr" placeholder="Phone number" required>
        </div>

        <div class="form_input">
            <input type="password" value="<?php echo $result['password']; ?>" name="password" placeholder="Password" required>
        </div>

        <div class="form_input">
            <input type="password" value="<?php echo $result['repeat_password']; ?>" name="Repeat_password" placeholder="Repeat Password" required>
        </div>

        <button type="submit" value="Update" name="submit">Update</button>
    </form>
</div>

<?php
    include '../config.php';

    if (isset($_POST['submit'])) {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $phone = $_POST['phonenmbr'];
        $password = $_POST['password'];
        $rep_password = $_POST['Repeat_password'];

        $query = "UPDATE user SET full_name='$fullname', email='$email', phone_number='$phone', password='$password', repeat_password='$rep_password' WHERE id='$id'";

        $data = mysqli_query($conn, $query);

        if ($data) {
            echo '<script>alert("Data updated successfully!");</script>';
            echo '<meta http-equiv="refresh" content="0; url=http://localhost/BCA%204th%20sem%20project/admin/tenant.php" />';
        } else {
            echo '<script>alert("Failed to update!");</script>';
        }

        $conn->close();
    }
?>
</body>
</html>
