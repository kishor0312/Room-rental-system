<?php
include 'header.php';
?>

<style>
/* Zoom out the whole page */
body {
    zoom: 0.7; /* Shrinks page to 70% */
}
</style>

<script>
function checkLogin(isLoggedIn) {
    if (!isLoggedIn) {
        alert('You must be logged in to view more details.');
        window.location.href = 'login.php';
        return false;
    }
    return true;
}
</script>

<!-- hero section -->
<section class="hero">
    <div class="herosec">
        <form class="searchbar" onsubmit="return false;">
            <input type="text" name="location" id="location" class="searchinput" placeholder="Enter Location">
            <input type="text" name="price" id="price" class="searchinput" placeholder="Enter Price">
            <select name="type" id="type" class="searchinput">
                <option value="">Select Type</option>
                <option value="Room">Room</option>
                <option value="House">House</option>
                <option value="Flats and Apartment">Flats and Apartment</option>
                <option value="Hostel Rooms">Hostel Rooms</option>
            </select>
            <button type="button" class="searchbtn" id="searchBtn"><i class="fa-solid fa-magnifying-glass"></i></button>
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
    <div class="box-container" id="propertyList">
        <!-- Properties will be loaded here by AJAX -->
    </div>
</section>

<?php
if (!isset($_SESSION['role']) || (isset($_SESSION['role']) && $_SESSION['role'] !== 'landlord')) {
    echo "
    <section class='feat-introbox' id='featured'>
        <div class='feat-head'>
        </div>
    </section>";
}
?>
<section class="featured">
    <div class="box-container" id="recommendedPropertyList">
        <!-- Recommended Properties will be loaded here by AJAX -->
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    function fetchProperties(){
        var location = $("#location").val();
        var price = $("#price").val();
        var type = $("#type").val();
        
        $.ajax({
            url: "fetch_properties.php",
            method: "GET",
            data: {location: location, price: price, type: type},
            success: function(data){
                $("#propertyList").html(data);
            }
        });
    }

    function fetchRecommendedProperties(){
        $.ajax({
            url: "recommend_properties.php",
            method: "GET",
            success: function(data){
                $("#recommendedPropertyList").html(data);
            }
        });
    }

    // Fetch all properties on page load
    fetchProperties();
    fetchRecommendedProperties();

    // Live search on typing or changing filters
    $("#location, #price, #type").on("input change", function(){
        fetchProperties();
    });

    $("#searchBtn").click(function(){
        fetchProperties();
    });
});
</script>

<!-- footer -->
<?php
include 'footer.php';
?>
</body>
</html>
