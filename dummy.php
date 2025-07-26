<?php
include 'header.php';
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

    <!-- hero section -->
<section class="hero">
    <div class="herosec">
        <form class="searchbar" action="" method="GET">
            <input type="text" name="searchbar" id="search" class="searchinput" placeholder="Search your location">
            <button type="submit" class="searchbtn"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>
</section>
       
    <!-- featured properties intro-->
        <?php
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'landlord') {
            echo"
    <section class='feat-introbox'  id='featured'>
        <div class='feat-head'>
         <p id='head' ><b>Properties!</b></p>
        </div>
    </section>";
            }else{
                echo"
                <section class='feat-introbox'  id='featured'>
                    <div class='feat-head'>
                     <p id='head' ><b>Find the best </b>home for you</p>
                     <p id='content'>Welcome to our featured property! 
                     This modern and stylish room is located in the heart of the city.
                      With its spacious layout, contemporary furnishings, and convenient amenities,
                       it's perfect for professionals and students. Don't miss out on the opportunity to
                        make this your new home</p>
                    </div>
                </section>";
            }
           ?>  

  <!-- featured property listing  -->
       <section class="featured">
        <div class="box-container">
         
             <!-- box-->
            <?php
            $query= "select * from  prop_detail";
            $logged_in= isset($_SESSION['loggedin'])=== true;

            
            // $result=mysqli_query($conn,$query);  
            $result=mysqli_query($conn,$query);  
            while($row=mysqli_fetch_assoc($result))
            {
              $id       =$row["prod_id"];
              $title    =$row["title"];
              $price    =$row["price"];
              $location =$row["location"];
              $image    =$row["image"];
              $area     =$row["area"];
              $bedroom  =$row["bedroom"];
              $bathroom =$row["bathroom"];
                
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
             ?> 

             <!-- <div class="box">
                <div class="image-container">
                    <img src="image/room 1.jpg" alt="roomimage">
                    <div class="info">
                        <h3>3 days ago</h3>
                        <h3>for rent</h3>
                    </div>
                    <div class="icon">
                        <a href="#" class="fas fa-film">
                            <h3>2</h3>
                        </a>
                        <a href="#" class="fas fa-camera">
                            <h3>6</h3>
                        </a>
                    </div>
                </div>
                <div class="content">
                    <div class="price">
                        <h3>10000/Month</h3>
                        <a href="#" class="fas fa-heart"></a>
                        <a href="#" class="fas fa-envelope"></a>
                        <a href="#" class="fas fa-phone"></a>
                    </div>
                </div>
                <div class="location">
                    <h3>1BHK Apartment</h3>
                    <p>balkot, Bhaktapur,nepal</p>
                </div>
                <div class="detail">
                    <h3><i class="fas fa-expand"></i> 2000sqft</h3>
                    <h3><i class="fas fa-bed"></i> 1 bed</h3>
                    <h3><i class="fas fa-bath"></i> 1 bath</h3>
                </div>
                <div class="buttons">
                    <a href="#" class="btn">Request info</a>
                    <a href="#" class="btn">View Detail</a>
                </div>
            </div>   -->
        </div>
    </section>
    
    <!-- footer -->
<?php
include 'footer.php'
?>


  
</body>

</html>



