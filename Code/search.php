<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unveiled Japan - Search</title>
    <link rel="stylesheet" href="header_style.css">
    <link rel="stylesheet" href="search_style.css">
    <script src="search.js" defer></script>
</head>
<body>

    <?php include 'header.html'; ?>

    
    <div class="title">
        <h1>Find Your One & Only</h1>
    </div>

    <div class="bg2">
        <h1>Discover Attractions</h1>
        <div id="search-section">
            <input type="text" id="searchbar" placeholder="Search for attractions..." />
            <div class="filters">
                <select id="region">
                    <option value="any">Region: Any</option>
                    <option value="hokkaido">Hokkaido</option>
                    <option value="kanto">Kanto</option>
                    <option value="chubu">Chubu</option>
                </select>

                <select id="sort-by-rating">
                    <option value="popular">Sort By: Most Popular</option>
                    <option value="rating">Sort By: Highest Rating</option>
                </select>
                
                <select id="season">
                    <option value="any">Season: Any</option>
                    <option value="spring">Spring</option>
                    <option value="summer">Summer</option>
                    <option value="autumn">Autumn</option>
                    <option value="winter">Winter</option>
                </select>

                <select id="activity-type">
                    <option value="any">Activity Type: Any</option>
                    <option value="sightseeing">Sightseeing</option>
                    <option value="hiking">Hiking</option>
                    <option value="historical">Historical</option>
                    <option value="festivals">Festivals</option>
                    <option value="shopping">Shopping</option>
                    <option value="food">Food & Drink</option>
                </select>

                <select id="difficulty">
                    <option value="any">Accessibility: Any</option>
                    <option value="easy">Easy</option>
                    <option value="moderate">Moderate</option>
                    <option value="challenging">Challenging</option>
                </select>
            </div>
        </div>

        <h2>Search Results</h2>
        <div id="results">
        </div>

        <h2>Trending Attractions</h2>
        <div id="trending">
        </div>
    </div>

    <hr>
    
</body>
</html>
