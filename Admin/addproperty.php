<?php
session_start(); // Starting the session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add proprty</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
   <style>
    
/* admin addpropety styling */
body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
  }
  
  .form_container {
    max-width: 40rem;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  
  h2{
      display:block;    
      margin-left:10rem;
  }
  
  .form_container label {
    display: block;
    margin-bottom: 10px;
  }
  
  .form_container .prop_title .title{
    width: 80%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
  
  }.form_container select {
    width: 80%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }
  
  .form_container .prop_price .price {
    width: 80%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
  
  }
  
  .form_container .prop_image #image {
    width: 80%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  .form_container .prop_location .location {
    width: 80%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  
  
  .prop_detail {
    display: flex;
    justify-content: space-evenly;
    margin-top:1rem;
  }
  
  .detail_item {
    flex: 1;
  }
  .prop_detail .feet{
  width: 5rem;
  }
  
  .prop_detail .bedroom{
  width: 5rem;
  }
  
  .prop_detail .bathroom{
  width: 5rem;
  }
  
  .prop_detail label{
      margin-left: 1rem;
  }
  
  
  .form_container .submit input[type="submit"] {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    position:relative;
    margin-top:2rem;
    margin-left:15rem;
  }
  
  .form_container .submit input[type="submit"]:hover {
    background-color: #0056b3;
  }
   </style>
</head>
<body>

<a href="index.php" class="logo-container">
    <img src="../image/logo.jpg" class="logo">
    </a>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form_container">
    
           <h2>Enter Property Detail</h2>
            <div class="prop_title">
                <label for="">Property Title:</label>
                <input type="text" name="title" class="title" placeholder="Enter property title" required>
            </div>

            <div class="prop_type">
                <label for="">Select property type:</label>
                <select  name="type" id="p_type"   requied>
                    <option value="room">Rooms</option>
                    <option value="flats & apartment">Flats and apartment</option>
                    <option value="house">House</option>
                    <option value="hostel room">Hostel rooms</option>                
                 </select>
            </div>

            <div class="prop_price">
                <label for="">Property Price:</label>
                <input type="varchar"  name="price" class="price"  placeholder="Enter the price"  requied>
            </div>

            <div class="prop_location">
                <label for="">Property location:</label>
                <input type="text"  name="location" class="location" placeholder=" Enter the location"  required>
            </div>

            <div class="prop_image">
            <label for="image">Upload Image 1:</label>
            <input type="file" id="image" name="image" >
            </div>

            <div class="prop_detail">
               <label for="">SQFT:</label> <input type="number" name="area" class="feet">
               <label for="">No of Bedrooms:</label> <input type="number" name="bedroom" class="bedroom">
               <label for="">No of bathrooms:</label> <input type="number" name="bathroom" class="bathroom">
            </div>       
 
            <div class="submit">
            <input type="submit" name="submit" placeholder="Submit" submit>
            </div>
         </div>
                     
    </form>
</body>
</html>

<?php
include "../config.php";


 if(isset($_POST['submit'])){

   $title=$_POST['title'];
   $type=$_POST['type'];
   $price=$_POST['price'];
   $location=$_POST['location'];
   $area=$_POST['area'];
   $bedroom=$_POST['bedroom'];
   $bathroom=$_POST['bathroom'];

    //image access
    $image=$_FILES['image']['name'];
    // accessing image tempname
    $temp_image=$_FILES['image']['tmp_name'];

    move_uploaded_file($temp_image, "./property_images/$image");

 $query= "insert into prop_detail (title, type, price, location, image, area, bedroom, bathroom) values('$title','$type',
 '$price', '$location', '$image', '$area', '$bedroom', '$bathroom')";
 
 $data=mysqli_query($conn,$query);

 

 $query = "Select prod_id from prop_detail where prod_id = (select max(prod_id) from prop_detail)";
 $result=$conn->query($query);
 if ($result->num_rows === 1) {
   // output data of each row
       $row = $result->fetch_assoc();
       $prod_id = $row['prod_id'] ;
       // var_dump($row);
       $id = $_SESSION['a_id'];
      //  var_dump($_SESSION);
      //  die();
  $query= "insert into added_by (prod_id, owner_id, owner_type) values($prod_id, $id,'admin')";
  $data=mysqli_query($conn,$query);
 } else {
   echo "0 results";
 }
 // session variable used 
  


 if($data){
   echo '<script>alert("Data inserted successfully!");</script>';
 } else{
  echo '<script>alert("Data insertion failed!");</script>';
 }
 
 $conn->close(); 
}
?>
