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
    .update {
        background-color: lightgreen;
        border: lightgreen;
        border-radius: 5px;
        padding: 3px;
        margin: 1px 5px;
        height: 1.5rem;
    }

    .delete {
        background-color: red;
        border: red;
        border-radius: 5px;
        padding: 3px;
        margin: 1px 5px;
        height: 1.5rem;
    }

    /* Styles for image zoom */
    .image-container {
        position: relative;
        display: inline-block;
    }

    .zoomed {
        transform: scale(1.6);
        z-index: 1000;
        position: relative;
        transition: transform 0.3s ease-in-out;
    }

    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 999;
    }

    .overlay img {
        max-width: 90%;
        max-height: 90%;
    }

    .overlay.show {
        display: flex;
    }
  </style>
</head>
<body>

<a href="index.php" class="logo-container">
    <img src="../image/logo.jpg" class="logo">
    </a>

<?php
  $query= "SELECT * FROM user WHERE role = 'landlord'";
  $data = mysqli_query($conn, $query); 
  $total = mysqli_num_rows($data);

  if ($total != 0) {
?>
    <h1 align="center">Detail of Landlord</h1>
    <table border="3px" align="center" cellspacing="0" width="90%">
        <tr>
            <th width="5%">ID</th>
            <th width="10%">Full name</th>
            <th width="10%">Email</th>
            <th width="10%">Phone number</th>
            <th width="10%">Password</th>
            <th width="10%">Address</th>
            <th width="20%">ID Card</th>
            <th width="15%">Operation</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($data)) {
            $id = $row["id"];
            $full_name = $row["full_name"];
            $email = $row["email"];
            $p_number = $row["phone_number"];
            $password = $row["password"];
            $address = $row["landlord_address"];
            $image = $row["landlordid_image"];
            echo "<tr>
                    <td>$id</td>
                    <td>$full_name</td>
                    <td>$email</td>
                    <td>$p_number</td>
                    <td>$password</td>
                    <td>$address</td>
                    <td>
                        <div class='image-container'>
                            <img src='../landlord_id_image/$image' alt='id card pic' height='100' onclick='zoomImage(this)'>
                        </div>
                    </td>
                    <td>
                        <a href='landlord_update.php?id=$id'><input type='submit' value='Update' class='update'></a>
                        <a href='landlord_delete.php?id=$id'><input type='submit' value='Delete' class='delete' onclick='return confirm(\"Are you sure you want to delete this record?\")'></a>
                    </td>      
                </tr>";
        }
        ?>
    </table>
<?php
  } else {
      echo '<script>alert("No record found!");</script>';   
  }
?>

<div class="overlay" id="overlay" onclick="zoomOut()">
    <img id="zoomedImage" src="" alt="Zoomed Image">
</div>

<script>
    function zoomImage(img) {
        var overlay = document.getElementById('overlay');
        var zoomedImage = document.getElementById('zoomedImage');
        zoomedImage.src = img.src;
        overlay.classList.add('show');
    }

    function zoomOut() {
        var overlay = document.getElementById('overlay');
        overlay.classList.remove('show');
    }
</script>

</body>
</html>
