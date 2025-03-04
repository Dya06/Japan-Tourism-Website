<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planner | Unveiled Japan</title>
    <link rel="stylesheet" href="header_style.css">
    <link rel="stylesheet" href="planner_style.css">
    <script src="planner_date_management.js" defer></script>
    <script src="planner_days_slider.js" defer></script>
    <script src="planner_attraction_details.js" defer></script>
</head>
<body>

    <?php include 'header.html'; ?> 

    <div class="title">
        <h1>Build Your Dream Japan Itinerary</h1>
    </div>

    <div class="popup">
        <div class="popup-overlay"></div>
        <div class="main-popup">
            <div class="attraction-details-container" id="attractionDetails">
                <h2>Attraction Details</h2>
                <img id="attractionImage" src="" alt="Attraction Image">
                <div class="attraction-details-container-information">
                    <p><strong>Place:</strong> <span id="attractionPlace"></span></p>
                    <p><strong>Start Time:</strong> <span id="attractionStartTime"></span></p>
                    <p><strong>End Time:</strong> <span id="attractionEndTime"></span></p>
                    <p><strong>Description:</strong> <span id="attractionDescription"></span></p>
                    <p><strong>Region:</strong> <span id="attractionRegion"></span></p>
                    <p><strong>Rating:</strong> <span id="attractionRating"></span></p>
                    <p><strong>Season:</strong> <span id="attractionSeason"></span></p>
                    <p><strong>Type:</strong> <span id="attractionType"></span></p>
                    <p><strong>Difficulty:</strong> <span id="attractionDifficulty"></span></p>
                </div>
                <span class="close-btn">&times;</span>
            </div>
        </div>
    </div>

    <div class="bg2"> 

        <div id="container">
            <h2 align="center">Planner</h2>

            <div id="dateSelection">
                <div class="plannerSection">
                    <label for="startDate">Start Date:</label>
                    <input type="date" id="startDate" placeholder="dd/mm/yyyy">
                </div>
                <div class="plannerSection">
                    <label for="endDate">End Date:</label>
                    <input type="date" id="endDate" placeholder="dd/mm/yyyy">
                </div>
            </div>

            <h2 align="center">Day Slider</h2>
            <div class="planner-container">
                <div class="day-slider">
                    <div class="scrollable">
                        <div id="daysSlider"></div>
                    </div>
                </div>
            </div>
        </div>
    </div> 

</body>
</html>