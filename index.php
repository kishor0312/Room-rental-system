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
            <input type="text" name="location" id="location" class="searchinput" placeholder="Enter Location">
            <input type="text" name="price" id="price" class="searchinput" placeholder="Enter Price">
            <select name="type" id="type" class="searchinput">
                <option value="">Select Type</option>
                <option value="Room">Room</option>
                <option value="House">House</option>
                <option value="Flats and Apartment">Flats and Apartment</option>
                <option value="Hostel Rooms">Hostel Rooms</option>
            </select>
            <button type="submit" class="searchbtn"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>
</section>

<!-- featured properties intro -->
<?php
if (isset($_SESSION['role']) && $_SESSION['role'] === 'landlord') {
    echo "
    <section class='feat-introbox' id='featured'>
        <div class='feat-head'>
            <p id='head'><b>Properties!</b></p>
        </div>
    </section>";
} else {
    echo "
    <section class='feat-introbox' id='featured'>
        <div class='feat-head'>
            <p id='head'><b>Find the best </b>home for you</p>
            <p id='content'>Welcome to our featured property! 
            This modern and stylish room is located in the heart of the city.
            With its spacious layout, contemporary furnishings, and convenient amenities,
            it's perfect for professionals and students. Don't miss out on the opportunity to
            make this your new home</p>
        </div>
    </section>";
}
?>

<!-- featured property listing -->
<section class="featured">
    <div class="box-container">
        <?php
            // Check if user is logged in
            $logged_in = isset($_SESSION['loggedin']) === true;

            // Construct the SQL Query
            $query = "SELECT * FROM prop_detail WHERE 1=1";
            if (isset($_GET['location']) && !empty($_GET['location'])) {
                $location = mysqli_real_escape_string($conn, $_GET['location']);
                $query .= " AND location LIKE '%$location%'";
            }
            if (isset($_GET['price']) && !empty($_GET['price'])) {
                $price = mysqli_real_escape_string($conn, $_GET['price']);
                $query .= " AND price <= '$price'";
            }
            if (isset($_GET['type']) && !empty($_GET['type'])) {
                $type = mysqli_real_escape_string($conn, $_GET['type']);
                $query .= " AND type LIKE '%$type%'";
            }

            // Execute the SQL Query
            $result = mysqli_query($conn, $query);

            // Check if records are found
            if (mysqli_num_rows($result) > 0) {
                // Display Filtered Results
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row["prod_id"];
                    $title = $row["title"];
                    $price = $row["price"];
                    $location = $row["location"];
                    $image = $row["image"];
                    $area = $row["area"];
                    $bedroom = $row["bedroom"];
                    $bathroom = $row["bathroom"];
                    echo "
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
                            <h3><i class='fas fa-bed'></i> $bedroom bed</h3>
                            <h3><i class='fas fa-bath'></i> $bathroom bath</h3>
                        </div>
                        <form method='GET' class='buttons' action='card_detail.php' onsubmit='return checkLogin($logged_in)'>  
                             <input type='hidden' name='id' value='$id'>         
                            <button type='submit' class='btn'>More Detail</button>
                        </form>
                    </div>";
                }
            } else {
                // Display alert message if no records found
                echo "<script>alert('No records found. Displaying all properties.');</script>";
                
                // Fetch and display all properties
                $all_properties_query = "SELECT * FROM prop_detail";
                $all_properties_result = mysqli_query($conn, $all_properties_query);
                while ($row = mysqli_fetch_assoc($all_properties_result)) {
                    $id = $row["prod_id"];
                    $title = $row["title"];
                    $price = $row["price"];
                    $location = $row["location"];
                    $image = $row["image"];
                    $area = $row["area"];
                    $bedroom = $row["bedroom"];
                    $bathroom = $row["bathroom"];
                    echo "
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
                            <h3><i class='fas fa-bed'></i> $bedroom bed</h3>
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

<!-- footer -->
<?php
include 'footer.php';
?>
</body>
</html>
