<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>view propery</title>


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
include '../config.php';

    $query= "select * from  prop_detail";
    $data=mysqli_query($conn,$query);
    $total= mysqli_num_rows($data);

    if($total != 0){
    ?>
    <h1 align="center"> Detail of property listing</h1>
    <table border="3px" align="center" cellspacing="0" width="85%" >
     <tr>
        <th width="5%"> ID</th>
        <th width="15%">Title</th>
        <th width="10%">Type</th>
        <th width="5%">Price</th>
        <th width="10%">Location</th>
        <th width="5%">Area in sqft</th>
        <th width="10%">No of bedroom</th>
        <th width="10%">No of bathroom</th>
        <th width="15%">Operations</th>
     </tr>  
    <?php
    while($row=mysqli_fetch_assoc($data))   
    {
        $id       =$row["prod_id"];
        $title    =$row["title"];
        $type     =$row["type"];
        $price    =$row["price"];
        $location =$row["location"];
        $area     =$row["area"];
        $bedroom  =$row["bedroom"];
        $bathroom =$row["bathroom"];
          
      
        echo"<tr>
        <td> $id </td>
        <td> $title </td>
        <td> $type </td>
        <td> $price </td>
        <td> $location </td>
        <td> $area </td>
        <td> $bedroom </td>
        <td>  $bathroom </td>
        <td><a href='update.php?id=$id'><input type='submit' value='Update' class='update'></a>
            <a href='delete.php?id=$id'><input type='submit' value='Delete' class='delete' onclick='return confirm(\"Are you sure you want to delete this record?\")'></a>
        </td>      
     </tr>";
    }
}else{
        echo '<script>alert("No record found!");</script>';   
    }      
   ?>

</table>

</body>
</html>

