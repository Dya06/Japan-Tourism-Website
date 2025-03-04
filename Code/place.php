<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unveiled Japan - Place Details</title>
    <link rel="stylesheet" href="header_style.css">
    <link rel="stylesheet" href="place_style.css">
</head>
<body>

    <?php include 'header.html'; ?> 

    <div class="title">
        <h1>Build Your Dream Japan Itinerary</h1>
    </div>

    <hr>

    <div id="banner">
        <h2 id="placeTitle">Place Details</h2>
    </div>

    <main id="placeDetails" style="padding: 20px;">
        <img id="placeImage" src="" alt="Place Image" class="place-image">
        <p id="placeDescription" class="place-description"></p>
        <p id="placeDetailsText" class="place-details-text"></p>
        <button id="addToPlannerBtn" class="button">Add to Planner</button>
    </main>

    <script>
        function loadPlaceDetails() {
            const selectedPlace = localStorage.getItem('selectedPlace');

            const placeData = {
                "Tokyo": {
                    "description": "Tokyo is Japan’s busy capital, known for its skyscrapers, shopping, and vibrant nightlife.",
                    "details": "Tokyo offers a wide array of attractions including Shibuya Crossing, the Imperial Palace, and the famous Tokyo Skytree.",
                    "imgSrc": "images/tokyo.jpg"
                },
                "Kyoto": {
                    "description": "Kyoto is known for its classical Buddhist temples, as well as gardens, imperial palaces, Shinto shrines, and traditional wooden houses.",
                    "details": "Key attractions include Fushimi Inari Shrine, Kinkaku-ji (Golden Pavilion), and Gion, the geisha district.",
                    "imgSrc": "images/kyoto.jpg"
                },
                "Osaka": {
                    "description": "Osaka is a large port city and commercial center on the Japanese island of Honshu.",
                    "details": "Main highlights include Osaka Castle, the bustling Dotonbori district, and Universal Studios Japan.",
                    "imgSrc": "images/osaka.jpg"
                },
                "Hokkaido": {
                    "description": "Hokkaido is known for its natural beauty, hot springs, and skiing resorts.",
                    "details": "Popular attractions include Shiretoko National Park and Daisetsuzan.",
                    "imgSrc": "images/hokkaido.jpg"
                },
                "Nara": {
                    "description": "Nara is famous for its tame deer and historic temples.",
                    "details": "Highlights include Todai-ji Temple and Nara Park.",
                    "imgSrc": "images/nara.jpg"
                },
                "Hiroshima": {
                    "description": "Hiroshima is known for its historical significance and beautiful gardens.",
                    "details": "Key sites include the Hiroshima Peace Memorial Park and Miyajima Island.",
                    "imgSrc": "images/hiroshima.jpg"
                },
                "Chubu": {
                    "description": "Chubu is known for its stunning mountainous regions and cultural heritage.",
                    "details": "Notable attractions include Mount Fuji and Shirakawago.",
                    "imgSrc": "images/chubu.jpg"
                },
                "Kanto": {
                    "description": "Kanto is a major economic and cultural center of Japan, encompassing Tokyo and surrounding prefectures.",
                    "details": "Key attractions include Nikko and the Ogasawara Islands.",
                    "imgSrc": "images/kanto.jpg" 
                },
                "Osaka": {
                    "description": "Osaka is a large port city known for its commercial centers and attractions like Osaka Castle.",
                    "details": "Popular attractions include Universal Studios Japan and Dotonbori.",
                    "imgSrc": "images/osaka.jpg"
                },
                "Alpine Route": {
                    "description": "The Alpine Route is a spectacular route through the Northern Alps.",
                    "details": "Enjoy breathtaking views and unique experiences in the mountains.",
                    "imgSrc": "images/alpine.jpg"
                },
                "Daisetsuzan": {
                    "description": "Daisetsuzan is Hokkaido's largest and wildest national park.",
                    "details": "A haven for outdoor enthusiasts with hiking and wildlife watching.",
                    "imgSrc": "images/daisetsuzan.jpg"
                },
                "Shiretoko National Park": {
                    "description": "Shiretoko National Park is an unspoiled wilderness on the Shiretoko Peninsula.",
                    "details": "Known for its beautiful landscapes and rich biodiversity.",
                    "imgSrc": "images/shiretoko.jpg"
                },
                "Rishiri and Rebun": {
                    "description": "Rishiri and Rebun are small islands near Hokkaido's northern tip.",
                    "details": "Perfect for sightseeing and enjoying nature.",
                    "imgSrc": "images/rishiri_rebun.jpg"
                },
                "Nikko": {
                    "description": "Nikko is the site of Nikko Toshogu, Ieyasu's mausoleum.",
                    "details": "Famous for its historical temples and stunning natural beauty.",
                    "imgSrc": "images/nikko.jpg"
                },
                "Ogasawara Islands": {
                    "description": "The Ogasawara Islands are remote islands 1000 kilometers south of Tokyo.",
                    "details": "Known for their unique ecosystem and beautiful beaches.",
                    "imgSrc": "images/ogasawara_isl.jpg"
                },
                "Mount Fuji": {
                    "description": "Mount Fuji is Japan's most iconic landmark.",
                    "details": "A popular destination for hiking and photography.",
                    "imgSrc": "images/mt_fuji.jpg"
                },
                "Shirakawago & Gokayama": {
                    "description": "This mountainous region is known for its traditional farmhouses.",
                    "details": "A UNESCO World Heritage site that showcases Japan's rural heritage.",
                    "imgSrc": "images/shirakawago.jpg"
                }
            };

            if (placeData[selectedPlace]) {
                document.getElementById('placeTitle').innerText = selectedPlace;
                document.getElementById('placeDescription').innerText = placeData[selectedPlace].description;
                document.getElementById('placeDetailsText').innerText = placeData[selectedPlace].details;
                document.getElementById('placeImage').src = placeData[selectedPlace].imgSrc;

                document.getElementById('addToPlannerBtn').onclick = function() {
                    localStorage.setItem('selectedPlace', selectedPlace);
                    window.location.href = "add_to_planner.php";
                };
            } else {
                document.getElementById('placeTitle').innerText = "Place Not Found";
                document.getElementById('placeDescription').innerText = "We couldn't find the place you're looking for. Please try again.";
                document.getElementById('addToPlannerBtn').style.display = "none";
            }
        }

        window.onload = loadPlaceDetails;
    </script>

    <hr>

</body>
</html>
