
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update proprty</title>
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

         <?php
         include "../config.php";

         $id = $_GET['id'];

         $query= "select * from  prop_detail where prod_id='$id' ";
         $data=mysqli_query($conn,$query);
         $result =mysqli_fetch_assoc($data);

         ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form_container">
         
           <h2>Update Property Detail</h2>
            <div class="prop_title">
                <label for="">Property Title:</label>
                <input type="text" value="<?php echo $result['title']; ?>" name="title" class="title" placeholder="Enter property title" required>
            </div>

            <div class="prop_type">
                <label for="">Select property type:</label>
                <select  name="type" id="p_type"   requied>
                    <option value="room" 

                    <?php                   
                    if($result['type'] =='room')
                    {
                        echo "selected";
                    }
                    ?>
                    
                    >Rooms</option>
                    <option value="flats & apartment"
                    
                    <?php                   
                    if($result['type'] =='flats & apartment')
                    {
                        echo "selected";
                    }
                    ?>
                    
                    >Flats and apartment</option>
                    <option value="house"
                    
                    <?php                   
                    if($result['type'] =='house')
                    {
                        echo "selected";
                    }
                    ?>
                    
                    >House</option>
                    <option value="hostel room"
                    
                    <?php                   
                    if($result['type'] =='hostel room')
                    {
                        echo "selected";
                    }
                    ?>
                    
                    >Hostel rooms</option>                
                 </select>
            </div>

            <div class="prop_price">
                <label for="">Property Price:</label>
                <input type="varchar" value="<?php echo $result['price']; ?>" name="price" class="price"  placeholder="Enter the price"  requied>
            </div>

            <div class="prop_location">
                <label for="">Property location:</label>
                <input type="text" value="<?php echo $result['location']; ?>" name="location" class="location" placeholder=" Enter the location"  required>
            </div>

            <div class="prop_detail">
               <label for="">SQFT:</label> <input type="number" value="<?php echo $result['area'];?>" name="area" class="feet">
               <label for="">No of Bedrooms:</label> <input type="number" value="<?php echo $result['bedroom'];?>" name="bedroom" class="bedroom">
               <label for="">No of bathrooms:</label> <input type="number" value="<?php echo $result['bathroom'];?>" name="bathroom" class="bathroom">
            </div>       
 
            <div class="submit">
            <input type="submit" name="submit" value="Update" submit>
            </div>
         </div>
                     
    </form>
</body>
</html>


<?php

 if(isset($_POST['submit'])){

   $title=$_POST['title'];
   $type=$_POST['type'];
   $price=$_POST['price'];
   $location=$_POST['location'];
   $area=$_POST['area'];
   $bedroom=$_POST['bedroom'];
   $bathroom=$_POST['bathroom'];

 $query= "update prop_detail set title= '$title',  type='$type', price='$price',
  location='$location',  area='$area', bedroom='$bedroom', bathroom='$bathroom' where prod_id='$id'";
 
 $data=mysqli_query($conn,$query);

 if($data){
   echo '<script>alert("Data updated successfully!");</script>';

    ?>

   <meta http-equiv="refresh" content="0; url = http://localhost/BCA%204th%20sem%20project/admin/view%20property.php" />

   <?php

 } else{
  echo '<script>alert("failed to update!");</script>';
 }
 
 $conn->close(); 
}
?>