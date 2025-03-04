<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unveiled Japan - Planner</title>
    <link rel="stylesheet" href="header_style.css">
    <link rel="stylesheet" href="add_to_planner_style.css">
</head>
<body>


    <?php include 'header.html'; ?> 

    <div class="title">
        <h1>Add To Planner</h1>
    </div>

    <div class="main-container">
        
        <section class="title">
            <h1>Time Your Travel Plan</h1>
        </section>

        <hr>

        <section id="banner">
            <h2 align="center">Add to Your Planner</h2>
        </section>

        <section id="attractionDetails">
            <h4 id="selectedPlace"></h4>
            <form id="plannerForm" method="POST" action="add_to_planner.php">
                <input type="hidden" id="placeName" name="placeName">

                <div class="form-group">
                    <label for="selectedDate">Selected Date:</label>
                    <input type="date" id="selectedDate" name="selectedDate" required>
                </div>

                <div class="form-group">
                    <label for="startTime">Start Time:</label>
                    <input type="time" id="startTime" name="startTime" required step="900">
                </div>

                <div class="form-group">
                    <label for="endTime">End Time:</label>
                    <input type="time" id="endTime" name="endTime" required step="900">
                </div>

                <button type="submit" class="planner-button">Add to Planner</button>
            </form>
        </section>

    </div>

    <script>
        window.onload = function() {
            const place = localStorage.getItem('selectedPlace');
            const startDate = localStorage.getItem('startDate');
            const endDate = localStorage.getItem('endDate');
            const selectedDay = localStorage.getItem('selectedDay');

            if (!startDate || !endDate) {
                alert("Please select a date range in the planner before adding an attraction.");
                window.location.href = "planner.php";
                return;
            }

            if (place) {
                document.getElementById('selectedPlace').innerText = place; 
            } else {
                alert("Please search and select a place before adding to the planner.");
                window.location.href = "search.php";
                return;
            }

            const dateInput = document.getElementById('selectedDate');
            if (selectedDay) {
                dateInput.value = selectedDay; 
                dateInput.disabled = true; 
            } else {
                dateInput.min = startDate; 
                dateInput.max = endDate;   
            }

            function validateTimes(finalSelectedDay, startTime, endTime) {
                const savedAttractions = JSON.parse(localStorage.getItem('plannerAttractions') || '{}');
                const attractionsForDate = savedAttractions[finalSelectedDay] || [];

                for (const attraction of attractionsForDate) {
                    const existingStartTime = attraction.startTime;
                    const existingEndTime = attraction.endTime;

                    if (
                        (startTime >= existingStartTime && startTime < existingEndTime) ||
                        (endTime > existingStartTime && endTime <= existingEndTime) ||
                        (startTime <= existingStartTime && endTime >= existingEndTime)
                    ) {
                        return false; 
                    }
                }
                return true; 
            }

            document.getElementById('plannerForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const finalSelectedDay = dateInput.value; 
                const startTime = document.getElementById('startTime').value;
                const endTime = document.getElementById('endTime').value;

                if (startTime >= endTime) {
                    alert("End time must be after start time.");
                    return;
                }

                if (!validateTimes(finalSelectedDay, startTime, endTime)) {
                    alert("Selected time overlaps with an existing attraction.");
                    return;
                }

                const attractionData = {
                    place: place,
                    startTime: startTime,
                    endTime: endTime
                };

                let plannerAttractions = JSON.parse(localStorage.getItem('plannerAttractions') || '{}');
                if (!plannerAttractions[finalSelectedDay]) {
                    plannerAttractions[finalSelectedDay] = [];
                }
                
                plannerAttractions[finalSelectedDay].push(attractionData);
                
                try {
                    localStorage.setItem('plannerAttractions', JSON.stringify(plannerAttractions));
                    console.log('Attraction saved successfully:', attractionData);
                } catch (error) {
                    console.error('Error saving attraction to localStorage:', error);
                    alert("There was an error saving your attraction. Please try again.");
                    return;
                }

                window.location.href = 'planner.php';
            });
        };
    </script>

</body>
</html>
