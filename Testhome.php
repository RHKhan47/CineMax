<?php
session_start();
include 'TopBar.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Website</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
body {
    background-image: url("back2.jpg");
    background-repeat: no-repeat;
    background-size: cover; /* Ensures the image covers the entire area */
    background-position: center bottom; /* Adjusts position to the bottom center */
    background-attachment: fixed; /* Fixes the background image */
    margin: 0;
    padding: 0;
    background-color: #f8f9fa; 
    color: #d3d3d3;  
    font-family: 'Arial', sans-serif; 
}


.container {
    background-color: rgb(127, 23, 23);
}

.header {
    color: white;
    text-align: center;
}

.carousel-inner {
    height: 300px; 
}

.carousel-item {
    background-size: cover;
    background-position: center top; 
    height: 300px; 
}

.carousel-caption {
    color: white;
    padding: -100px;
}

.text-center a:link, a:visited {
    background-color:  rgba(0, 0, 0, 0.8);
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
}

.text-center a:hover, a:active {
    background-color: white;
    color: rgb(127, 23, 23);
}


#fullScreenModal {
    background-color: rgba(0, 0, 0, 0.9); /* Darker background */
}


.hidden {
    display: none;
}


.movie-container {
    position: relative;
    overflow: hidden;
    padding: 20px 0;
    margin: 50px 250px;
    display: flex;
    justify-content: space-between;
    color: white;
    flex-wrap: wrap;
}

.movie-wrapper {
    display: flex;
    transition: transform 0.3s ease-in-out;
    flex-grow: 1;
    flex-wrap: wrap;
    justify-content: flex-start; /* Align movies to the left */
}

.movie-block {
    flex: 0 0 auto;
    margin: 0 10px;
    position: relative;
}

.movie-block img {
    width: 230px;
    height: 370px; 
    object-fit: cover; 
    transition: transform 0.3s ease-in-out, filter 0.3s ease-in-out;
    transform-origin: center; 
}

.movie-block:hover img {
    transform: scale(1.1);
    filter: blur(1px);
}

.movie-block:hover .movie-details,
.movie-block:hover .get-ticket-button {
    opacity: 1;
}

.movie-details {
    position: absolute;
    bottom: 40px; 
    left: 5%; 
    right: 5%; 
    text-align: left; 
    color: white;
    opacity: 0;
    transition: opacity 0.3s ease-in-out;
    font-weight: bold;
    z-index: 2; 
}

.movie-details .movie-name {
    font-size: 18px; 
    margin-bottom: 5px;
}

.movie-details .genre,
.movie-details .language {
    font-size: 14px; 
    margin-bottom: 3px;
    white-space: nowrap; 
    display: inline-block;
}

.movie-details .genre:after {
    content: " "; 
    display: inline;
    margin-right: 10px;
}

.get-ticket-button {
    position: absolute;
    bottom: 5px;
    right: 12px; 
    background-color: rgba(0, 0, 0, 0.9); /* Black with 80% opacity */
    color: white;
    padding: 5px 10px;
    text-decoration: none;
    font-size: 14px;
    border-radius: 3px;
    opacity: 0;
    transition: opacity 0.3s ease-in-out;
    z-index: 3;
}

.get-ticket-button:hover {
    background-color: white;
    color: rgb(127, 23, 23);
    text-decoration: none; 
}


.section-header {
    margin-top: 120px; 
    text-align: center;
    color: white;
    margin-left: 250px;
    margin-right: 250px;
    position: relative;
}


.section-header h2::after {
    content: '';
    display: block;
    width: calc(100% - 120px); /* Adjust the width to leave space for the "View All" button */
    height: 1px;
    background-color: white;
    position: absolute;
    bottom: -10px; /* Adjust the distance from the text */
    left: 0;
}

.section-header button {
    margin-right: 0; /* Ensures the button aligns with the header */
}

.search-container {
    position: absolute;
    right: 250px; /* 250px gap from the right side */
    display: flex;
    align-items: center;
    margin-top: 50px; /* Add margin at the top */

}

.search-input {
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    width: 250px;
    opacity: 0; /* Start fully transparent */
    height: 0; /* Start with height 0 */
    overflow: hidden; /* Hide the overflow */
    transition: opacity 0.3s ease-in-out, height 0.3s ease-in-out; /* Transition for both opacity and height */
}

.search-input.show {
    opacity: 1; /* Fully visible when active */
    height: 30px; /* Set a fixed height when active */
}

.search-icon {
    font-size: 20px;
    color: white;
    margin-right: 10px; /* Space between icon and input */
    cursor: pointer;
}






.nav-buttons {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 10;
    opacity: 0;
    transition: opacity 0.3s ease-in-out;
}
.movie-container:hover .nav-buttons {
    opacity: 1;
}

.nav-buttons button {
    background: none;
    border: none;
    font-size: 50px;
    color: white;
    cursor: pointer;
}

.nav-buttons button:hover {
    color: rgba(255, 255, 255, 0.8);
}

.nav-buttons.left {
    left: 0px;
}

.nav-buttons.right {
    right: 0px;
}

.trailer-icon {
    position: absolute;
    top: 50%; 
    left: 50%; 
    transform: translate(-50%, -50%); 
    font-size: 60px; /* Larger icon size */
    color: rgba(255, 255, 255, 0.9);
    cursor: pointer;
    opacity: 0; /* Hidden by default */
    transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
    z-index: 10; /* Ensure it appears above the movie details */
}

.movie-block:hover .trailer-icon {
    opacity: 1;
    transform: translate(-50%, -100%) scale(1.1); /* Slightly enlarge on hover */
}



.modal-content {
    background-color: transparent;
    border: none;
    box-shadow: none;
    padding: 0;
}

.modal-header {
    border-bottom: none;
    padding: 0;
}

.modal-body {
    padding: 0;
}

.view-all-button {
    color: #ffffff;
    background-color: transparent;
    border: 1px solid #ffffff;
    transition: background-color 0.3s, color 0.3s;
}

.view-all-button:hover {
    background-color: #ffffff;
    color: #000000;
    border: 1px solid #ffffff;
}

/* Scoped styles for the Now Showing modal */
#NowModal .movie-container {
    margin: 50px 150px;  /* Reduced margin specifically for this modal */
}

#NowModal .section-header {
    margin-top: 0px;  /* Reduced top margin specifically for this modal */
    margin-left: 150px;
    margin-right: 150px;
}


    </style>
</head>
<body>

<?php 
include 'conn.php';

// $searchQuery = "";

if (!isset($_GET['userid'])) {
    $userid = 0;
} else {
    $userid = htmlspecialchars($_GET['userid']);
    include 'User_nav.php';  // user nav    
}

if (!isset($_GET['adminid'])) {
    $adminid=0;
} else {
    $adminid = htmlspecialchars($_GET['adminid']);
    include 'Admin_nav.php'; // admin nav
}

if($userid ==0 && $adminid==0)
{
    include 'nav.php';  // Guest nav
}
?>

<div class="header">
    <div id="carouselExample" class="carousel slide" data-ride="carousel" style="height: 85vh;">
      <div class="carousel-inner" style="height: 85vh;">
        <div class="carousel-item active" style="background-image: url('sl1.jpg');height: 85vh;background-position: center -100px;"></div>
        <div class="carousel-item" style="background-image: url('sl2.jpg');height: 90vh;background-position: center -160px;"></div>
        <div class="carousel-item" style="background-image: url('pexels-pavel-danilyuk-7234214.jpg'); height: 85vh;background-position: center -150px;"></div>
      </div>
        <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<div class="text-center" style="background-color:  rgba(0, 0, 0, 0.8);">
    <a class="me-box" href="https://facebook.com/MYCINEPLEX/">
        <span class="btn"><i class="fa fa-facebook"></i> Visit Facebook</span>
    </a>
    <a href="https://www.youtube.com/channel/UCgYEyIGj0WlQGZY_Wxg6zYg" class="btn">
        <span class="btn"><i class="fa fa-youtube"></i> Visit Youtube</span>
    </a>
    <a href="https://www.instagram.com/mystarcineplex/">
        <span class="btn"><i class="fa fa-instagram"></i> Visit Instagram</span>
    </a>  
</div>


<!-- Search here -->
<div class="search-container">
    <i class="fa fa-search search-icon" onclick="toggleSearch()"></i>
    <input type="text" id="search-input" class="search-input" placeholder="Search Here">
</div>



<script>
function toggleSearch() {
    var searchInput = document.getElementById('search-input');
    if (searchInput.classList.contains('show')) {
        searchInput.classList.remove('show');
        setTimeout(() => {
            searchInput.style.height = '0'; // Set height to 0 after class removal for the slide up effect
        }, 300); // Delay to allow transition to complete
    } else {
        searchInput.style.height = '30px'; // Set height for the slide down effect
        searchInput.classList.add('show');
    }
}

</script>


<!-- Now showing -->
<div class="section-header d-flex justify-content-between align-items-center">
    <h2 id="nowShowingHeader">Now Showing</h2>    
    <button type="button" data-toggle="modal" data-target="#NowModal"  class="view-all-button btn btn-primary" >View All</button>
</div>

<div class="movie-container">
    <div class="slider-wrapper">
        <button class="prev-slide" onclick="prevSlide()">❮</button>
        <div class="movie-wrapper" id="nowShowing">
            <div class="slider">
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['moviesrh'])) {
                    if (isset($_POST['search'])) {
                        $searchQuery = htmlspecialchars($_POST['search']);
                    }
                    $sql = "SELECT movieid, poster,moviename,cast,genre,language,rating,trailer FROM movies WHERE (MovieName LIKE '%$searchQuery%' OR Genre LIKE '%$searchQuery%' OR Language LIKE '%$searchQuery%'OR Cast LIKE '%$searchQuery%') AND Schedule = 'Now Showing'";
                } else {
                    $sql = "SELECT movieid, poster,moviename,cast,genre,language,rating,trailer FROM movies WHERE Schedule = 'Now Showing'";
                }

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $poster = base64_encode($row['poster']);
                        $finfo = finfo_open(FILEINFO_MIME_TYPE);
                        $mimeType = finfo_buffer($finfo, $row['poster']);
                        finfo_close($finfo);
                        $_SESSION["movieid"] = $row['movieid'];
                        echo '<div class="movie-block" style="min-width: 5%;">'; // Ensure 5 posters fit in one slide
                        echo '<img src="data:' . $mimeType . ';base64,' . $poster . '" class="img-fluid">';
                        echo '<div class="trailer-icon" data-toggle="modal" data-target="#trailerModal" data-trailer="' . htmlspecialchars($row['trailer']) . '">';
                        echo '<i class="fa fa-play-circle" style="font-size: 60px; color: rgba(255, 255, 255, 0.9);"></i>';
                        echo '</div>';
                        echo '<div class="movie-details">';
                        if (!empty($row['rating'])) {
                            echo '<h6 style="font-size: 1.5rem;">⭐' . $row['rating'] . '</h6>';
                        }
                        echo '<div class="movie-name">' . htmlspecialchars($row['moviename']) . '</div>';
                        echo '<div class="movie-genre">Genre: ' . htmlspecialchars($row['genre']) . '</div>';
                        echo '<div class="movie-language">Language: ' . htmlspecialchars($row['language']) . '</div>';
                        echo '</div>';
                        echo '<a href="show-movie-details.php?id=' . htmlspecialchars($row['movieid']) . '&userid=' . $userid . '&adminid=' . $adminid . '" class="get-ticket-button">Get Ticket</a>';
                        echo '</div>';
                    }
                } else {
                    echo "<h3>No Result</h3>";
                }
                ?>
            </div>
        </div>
        <button class="next-slide" onclick="nextSlide()">❯</button>
    </div>
</div>


<style>
.slider-wrapper {
    position: relative;
    width: 100%;
    overflow: hidden;
}

.slider {
    display: flex;
    transition: transform 0.5s ease-in-out;
}

.movie-block {
    flex: 0 0 18.6%; 
    box-sizing: border-box;
    padding: 5px;
}

.prev-slide, .next-slide {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    font-size: 2rem;
    cursor: pointer;
    padding: 10px;
    z-index: 1;
    display: none; /* Hidden by default */
}

.prev-slide {
    left: 0;
}

.next-slide {
    right: 0;
}

</style>

<script>
let currentSlide = 0;
const slideWidth = 20; // Percentage width of each slide
const totalSlides = document.querySelectorAll('.movie-block').length;
const visibleSlides = 5;

function updateSliderPosition() {
    const slider = document.querySelector('.slider');
    slider.style.transform = `translateX(-${currentSlide * slideWidth}%)`;
}

function nextSlide() {
    if (currentSlide < totalSlides - visibleSlides) {
        currentSlide++;
        updateSliderPosition();
    }
}

function prevSlide() {
    if (currentSlide > 0) {
        currentSlide--;
        updateSliderPosition();
    }
}


// Function to initialize the slider
function initializeSlider() {
    // If the total number of slides is less than or equal to the number of visible slides, hide the buttons
    if (totalSlides <= visibleSlides) {
        document.querySelector('.prev-slide').style.display = 'none';
        document.querySelector('.next-slide').style.display = 'none';
    } else {
        document.querySelector('.prev-slide').style.display = 'block';
        document.querySelector('.next-slide').style.display = 'block';
    }
}

// Initialize the slider on page load
initializeSlider();

</script>    









<!-- Full-screen modal for View All Now Showing -->
<div id="NowModal" class="modal fade fixed inset-0 bg-black bg-opacity-99 flex items-center justify-center z-50" tabindex="-1" role="dialog" aria-labelledby="NowModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg custom-modal-width" role="document">
        <div class="modal-content bg-black w-full h-full relative flex flex-col">
            <!-- Modal Heading Row -->
            <div class="section-header d-flex justify-content-between align-items-center">
                <h2>Now Showing</h2>    
                <button type="button" class="view-all-button btn btn-primary" data-dismiss="modal" aria-label="Close" style="border: none; padding: 0; font-size: 2rem;">  
                    &times;
                </button>
            </div>

            <!-- Modal Content -->
            <div class="movie-container custom-movie-layout">
                <div class="movie-wrapper custom-movie-wrapper">
                    <?php
                        $sql = "SELECT movieid, poster, moviename, cast, genre, language, rating, trailer FROM movies WHERE Schedule = 'Now Showing'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $poster = base64_encode($row['poster']);
                                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                                $mimeType = finfo_buffer($finfo, $row['poster']);
                                finfo_close($finfo);
                                $_SESSION["movieid"] = $row['movieid'];
                                echo '<div class="movie-block custom-movie-block">';
                                echo '<img src="data:' . $mimeType . ';base64,' . $poster . '" class="img-fluid">';
                                echo '<div class="trailer-icon" data-toggle="modal" data-target="#trailerModal" data-trailer="' . htmlspecialchars($row['trailer']) . '">';
                                echo '<i class="fa fa-play-circle" style="font-size: 60px; color: rgba(255, 255, 255, 0.9);"></i>';
                                echo '</div>';
                                echo '<div class="movie-details">';
                                // Display rating if it's available
                                if (!empty($row['rating'])) {
                                    echo '<h6 style="font-size: 1.5rem;">⭐' . $row['rating'] . '</h6>';
                                }
                                echo '<div class="movie-name">' . htmlspecialchars($row['moviename']) . '</div>';
                                echo '<div class="movie-genre">Genre: ' . htmlspecialchars($row['genre']) . '</div>';
                                echo '<div class="movie-language">Language: ' . htmlspecialchars($row['language']) . '</div>';
                                echo '</div>';
                                echo '<a href="show-movie-details.php?id=' . htmlspecialchars($row['movieid']) . '&userid=' . $userid . '&adminid=' . $adminid . '" class="get-ticket-button">Get Ticket</a>';
                                echo '</div>';
                            }
                        } else {
                            echo "<h3>No Result</h3>";
                        }
                    ?>
                </div>
            </div>

            <!-- Modal Footer with Close Button -->
            <div class="p-2 border-t border-gray-700 text-right">
                <button type="button" class="view-all-button btn btn-primary" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>






<!-- Ucoming -->
<div class="section-header d-flex justify-content-between align-items-center">
    <h2 id="upcomingHeader">Upcoming</h2>
    <button type="button" data-toggle="modal" data-target="#UpModal" class="view-all-button btn btn-primary" >View All</button>
</div>

<div class="movie-container">
    <div class="slider-wrapper">
        <button class="prev-slide" onclick="prevSlide()">❮</button>
        <div class="movie-wrapper" id="nowShowing">
            <div class="slider">
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['moviesrh'])) {
                    if (isset($_POST['search'])) {
                        $searchQuery = htmlspecialchars($_POST['search']);
                    }
                    $sql = "SELECT movieid, poster,moviename,cast,genre,language,rating,trailer FROM movies WHERE (MovieName LIKE '%$searchQuery%' OR Genre LIKE '%$searchQuery%' OR Language LIKE '%$searchQuery%'OR Cast LIKE '%$searchQuery%') AND Schedule = 'Upcoming'";
                } else {
                    $sql = "SELECT movieid, poster,moviename,cast,genre,language,rating,trailer FROM movies WHERE Schedule = 'Upcoming'";
                }

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $poster = base64_encode($row['poster']);
                        $finfo = finfo_open(FILEINFO_MIME_TYPE);
                        $mimeType = finfo_buffer($finfo, $row['poster']);
                        finfo_close($finfo);
                        $_SESSION["movieid"] = $row['movieid'];
                        echo '<div class="movie-block" >'; // Ensure 5 posters fit in one slide
                        echo '<img src="data:' . $mimeType . ';base64,' . $poster . '" class="img-fluid">';
                        echo '<div class="trailer-icon" data-toggle="modal" data-target="#trailerModal" data-trailer="' . htmlspecialchars($row['trailer']) . '">';
                        echo '<i class="fa fa-play-circle" style="font-size: 60px; color: rgba(255, 255, 255, 0.9);"></i>';
                        echo '</div>';
                        echo '<div class="movie-details">';
                        if (!empty($row['rating'])) {
                            echo '<h6 style="font-size: 1.5rem;">⭐' . $row['rating'] . '</h6>';
                        }
                        echo '<div class="movie-name">' . htmlspecialchars($row['moviename']) . '</div>';
                        echo '<div class="movie-genre">Genre: ' . htmlspecialchars($row['genre']) . '</div>';
                        echo '<div class="movie-language">Language: ' . htmlspecialchars($row['language']) . '</div>';
                        echo '</div>';
                        echo '<a href="show-movie-details.php?id=' . htmlspecialchars($row['movieid']) . '&userid=' . $userid . '&adminid=' . $adminid . '" class="get-ticket-button">Get Ticket</a>';
                        echo '</div>';
                    }
                } else {
                    echo "<h3>No Result</h3>";
                }
                ?>
            </div>
        </div>
        <button class="next-slide" onclick="nextSlide()">❯</button>
    </div>
</div>






<!-- Full-screen modal for View Upcoming Movies -->
<div id="UpModal" class="modal fade fixed inset-0 bg-black bg-opacity-99 flex items-center justify-center z-50" tabindex="-1" role="dialog" aria-labelledby="NowModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg custom-modal-width" role="document">
        <div class="modal-content bg-black w-full h-full relative flex flex-col">
            <!-- Modal Heading Row -->
            <div class="section-header d-flex justify-content-between align-items-center" >
                <h2 >Upcoming</h2>    
                <button type="button" class="view-all-button btn btn-primary" data-dismiss="modal" aria-label="Close" style="border: none;  padding: 0; font-size: 2rem;">  <!-- background: transparent; -->
                    &times;
                </button>
            </div>

            <!-- Modal Content -->
            <div class="movie-container custom-movie-layout">
                <div class="movie-wrapper custom-movie-wrapper">
                    <?php
                        $sql = "SELECT movieid, poster, moviename, cast, genre, language, rating, trailer FROM movies WHERE Schedule = 'Upcoming'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $poster = base64_encode($row['poster']);
                                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                                $mimeType = finfo_buffer($finfo, $row['poster']);
                                finfo_close($finfo);
                                $_SESSION["movieid"] = $row['movieid'];
                                echo '<div class="movie-block custom-movie-block">';
                                echo '<img src="data:' . $mimeType . ';base64,' . $poster . '" class="img-fluid">';
                                echo '<div class="trailer-icon" data-toggle="modal" data-target="#trailerModal" data-trailer="' . htmlspecialchars($row['trailer']) . '">';
                                echo '<i class="fa fa-play-circle" style="font-size: 60px; color: rgba(255, 255, 255, 0.9);"></i>';
                                echo '</div>';
                                echo '<div class="movie-details">';
                                // echo '<h6 style="font-size: 1.5rem;">⭐' . $row['rating'] . '</h6>';
                                echo '<div class="movie-name">' . htmlspecialchars($row['moviename']) . '</div>';
                                echo '<div class="movie-genre">Genre: ' . htmlspecialchars($row['genre']) . '</div>';
                                echo '<div class="movie-language">Language: ' . htmlspecialchars($row['language']) . '</div>';
                                echo '</div>';
                                echo '<a href="show-movie-details.php?id=' . htmlspecialchars($row['movieid']) . '&userid=' . $userid . '&adminid=' . $adminid . '" class="get-ticket-button">Get Ticket</a>';
                                echo '</div>';
                            }
                        } else {
                            echo "<h3>No Result</h3>";
                        }
                    ?>
                </div>
            </div>

            <!-- Modal Footer with Close Button -->
            <div class="p-2 border-t border-gray-700 text-right">
                <button type="button" class="view-all-button btn btn-primary" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>










<!-- Modal for trailer -->
<div class="modal fade bd-example-modal-lg" id="trailerModal" tabindex="-1" role="dialog" aria-labelledby="trailerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe id="trailerIframe" width="100%" height="500px" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>




<!-- <script>
const initialDisplayCount = 5;

function showMore(section) {
    const wrapper = document.querySelector(`#${section}`);
    const blocks = wrapper.querySelectorAll('.movie-block');
    let visibleBlocks = Array.from(blocks).filter(block => block.style.display !== 'none');

    if (visibleBlocks.length < blocks.length) {
        blocks[visibleBlocks.length].style.display = 'block';
    }
}

function showLess(section) {
    const wrapper = document.querySelector(`#${section}`);
    const blocks = wrapper.querySelectorAll('.movie-block');
    let visibleBlocks = Array.from(blocks).filter(block => block.style.display !== 'none');

    if (visibleBlocks.length > initialDisplayCount) {
        blocks[visibleBlocks.length - 1].style.display = 'none';
    }
}

function showNavButtons(container) {
    const leftButton = container.querySelector('.nav-buttons.left');
    const rightButton = container.querySelector('.nav-buttons.right');
    leftButton.style.opacity = '1';
    rightButton.style.opacity = '1';
}

function hideNavButtons(container) {
    const leftButton = container.querySelector('.nav-buttons.left');
    const rightButton = container.querySelector('.nav-buttons.right');
    leftButton.style.opacity = '0';
    rightButton.style.opacity = '0';
}

document.addEventListener('DOMContentLoaded', () => {
    const nowShowingBlocks = document.querySelectorAll('#nowShowing .movie-block');
    const upcomingBlocks = document.querySelectorAll('#upcoming .movie-block');
    
    // Initial display setup for both sections
    nowShowingBlocks.forEach((block, index) => {
        block.style.display = index < initialDisplayCount ? 'block' : 'none';
    });
    upcomingBlocks.forEach((block, index) => {
        block.style.display = index < initialDisplayCount ? 'block' : 'none';
    });
});

</script> -->

<script>
$(document).ready(function () {
    $('#trailerModal').on('show.bs.modal', function (e) {
        var trailerUrl = $(e.relatedTarget).data('trailer');
        $('#trailerIframe').attr('src', 'https://www.youtube.com/embed/' + trailerUrl);
    });

    $('#trailerModal').on('hidden.bs.modal', function () {
        $('#trailerIframe').attr('src', ''); // Clear the iframe src to stop the video
    });
});
</script>


<script>
$(document).ready(function() {
    $('#search-input').on('input', function() {
        const query = $(this).val(); // Get the input value

        // AJAX request for "Now Showing"
        $.ajax({
            url: '', // Send the request to the same page
            type: 'POST', // The request method
            data: { moviesrh: 1, search: query, section: 'nowShowing' }, // Specify section
            success: function(response) {
                const nowShowingContent = $(response).find('#nowShowing').html();
                $('#nowShowing').html(nowShowingContent); // Update Now Showing section
            },
            error: function(xhr, status, error) {
                console.error('An error occurred: ' + error); // Log error
            }
        });

        // AJAX request for "Upcoming"
        $.ajax({
            url: '', // Send the request to the same page
            type: 'POST', // The request method
            data: { moviesrh: 1, search: query, section: 'upcoming' }, // Specify section
            success: function(response) {
                const upcomingContent = $(response).find('#upcoming').html();
                $('#upcoming').html(upcomingContent); // Update Upcoming section
            },
            error: function(xhr, status, error) {
                console.error('An error occurred: ' + error); // Log error
            }
        });
    });
});



</script>


<?php include 'Footer.php'; ?>




<style>
.custom-modal-width {
    max-width: 90vw; /* Increased the width of the modal to 90% of the viewport */
    max-height: 100vh; /* Increase the modal height to 95% of the viewport height */
}

.custom-movie-layout {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}

.custom-movie-wrapper {
    display: flex;
    justify-content: flex-start;
    flex-wrap: wrap;
    gap: 20px; /* Adds space between the movies */
    width: 100%; /* Ensures the movie wrapper uses the full width of the modal */
}

.custom-movie-block {
    width: 230px; /* Consistent width for movie blocks */
    margin-bottom: 20px; /* Space below each movie block */
}

</style>

</body>
</html>
