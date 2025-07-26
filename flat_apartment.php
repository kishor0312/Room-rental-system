<?php
include 'header.php'
?>

<script>
function checkLogin(isLoggedIn) {
    if (!isLoggedIn) {
        alert('You must be logged in to view more details.');
        window.location.href = 'login.php'; // Redirect to login page
        return false; // Prevent form submission
    }
    return true; // Allow form submission
}
</script>
<!-- featured property listing  -->
<section class="featured">
        <div class="box-container">

             <!-- box-->

            <?php
             $logged_in= isset($_SESSION['loggedin'])=== true;
            $query= "select * from  prop_detail";
            $result=mysqli_query($conn,$query);

            while($row=mysqli_fetch_assoc($result))
            {
              $id       =$row["prod_id"];  
              $title    =$row["title"];
              $type     =$row["type"];
              $price    =$row["price"];
              $location =$row["location"];
              $image    =$row["image"];
              $area     =$row["area"];
              $bedroom  =$row["bedroom"];
              $bathroom =$row["bathroom"];


                 if($type==='flats & apartment')
                 {            
                echo"               
                <div class='box'>
                <div class='image-container'>
                    <img src='./Admin/property_images/$image' alt='roomimage'>
                    <div class='info'>
                        <h3>3 days ago</h3>
                        <h3>for rent</h3>
                    </div>
                    <div class='icon'>
                        <a href='#' class='fas fa-film'>
                            <h3>2</h3>
                        </a>
                        <a href='#' class='fas fa-camera'>
                            <h3>6</h3>
                        </a>
                    </div>
                </div>
                <div class='content'>
                    <div class='price'>
                        <h3>$price/Month</h3>
                        <a href='#' class='fas fa-envelope'></a>
                        <a href='#' class='fas fa-phone'></a>
                    </div>
                </div>
                <div class='location'>
                    <h3>$title </h3>
                    <p>$location</p>
                </div>
                <div class='detail'>
                    <h3><i class='fas fa-expand'></i> $area sqft</h3>
                    <h3><i class='fas fa-bed'></i> $bedroom  bed</h3>
                    <h3><i class='fas fa-bath'></i> $bathroom bath</h3>
                </div>
                <form method='GET' class='buttons' action='card_detail.php' onsubmit='return checkLogin($logged_in)'>  
                <input type='hidden' name='id' value='$id'>         
               <button type='submit' class='btn'>More Detail</button>
           </form>
               </div>";
                 }                                     
            }
             ?> 

             
        </div>
    </section>
<?php
include 'footer.php'
?>
  