const attractions = {
    hokkaido: [
        { name: 'Shiretoko National Park', description: 'Unspoiled wilderness on the Shiretoko Peninsula.', rating: 5, season: 'any', type: 'hiking', difficulty: 'easy', image: 'images/shiretoko.jpg' },
        { name: 'Rishiri and Rebun', description: 'Small islands near Hokkaido\'s northern tip.', rating: 4, season: 'summer', type: 'sightseeing', difficulty: 'moderate', image: 'images/rishiri_rebun.jpg' },
        { name: 'Daisetsuzan', description: 'Hokkaido\'s largest and wildest national park.', rating: 5, season: 'autumn', type: 'hiking', difficulty: 'challenging', image: 'images/daisetsuzan.jpg' }
    ],
    kanto: [
        { name: 'Tokyo', description: 'Japan\'s busy capital, known for skyscrapers, shopping, and vibrant nightlife.', rating: 5, season: 'any', type: 'sightseeing', difficulty: 'easy', image: 'images/tokyo.jpg' },
        { name: 'Nikko', description: 'Site of Nikko Toshogu, Ieyasu\'s mausoleum.', rating: 4.5, season: 'spring', type: 'historical', difficulty: 'easy', image: 'images/nikko.jpg' },
        { name: 'Ogasawara Islands', description: 'Remote islands 1000 kilometers south of Tokyo.', rating: 4, season: 'summer', type: 'sightseeing', difficulty: 'moderate', image: 'images/ogasawara_isl.jpg' }
    ],
    chubu: [
        { name: 'Mount Fuji', description: 'The country\'s most iconic landmark.', rating: 5, season: 'summer', type: 'hiking', difficulty: 'challenging', image: 'images/mt_fuji.jpg' },
        { name: 'Alpine Route', description: 'Spectacular route through the Northern Alps.', rating: 4.5, season: 'autumn', type: 'sightseeing', difficulty: 'moderate', image: 'images/alpine.jpg' },
        { name: 'Shirakawago & Gokayama', description: 'Mountainous region known for its farmhouses.', rating: 4, season: 'winter', type: 'cultural', difficulty: 'easy', image: 'images/shirakawago.jpg' }
    ]
};

const trendingAttractions = [
    { name: 'Nara', description: 'Famous for its tame deer and historic temples.', rating: 4.5, image: 'images/nara.jpg' },
    { name: 'Hiroshima', description: 'Known for its historical significance and beautiful gardens.', rating: 4.8, image: 'images/hiroshima.jpg' },
    { name: 'Kyoto', description: 'Known for its classical Buddhist temples, gardens, and traditional wooden houses.', rating: 4.7, image: 'images/kyoto.jpg' },
    { name: 'Osaka', description: 'A large port city known for its commercial centers and attractions like Osaka Castle.', rating: 4.6, image: 'images/osaka.jpg' },
    { name: 'Tokyo', description: 'Japan\'s busy capital, known for skyscrapers, shopping, and vibrant nightlife.', rating: 5, season: 'any', type: 'sightseeing', difficulty: 'easy', image: 'images/tokyo.jpg' }
];

document.getElementById('searchbar').addEventListener('input', updateResults);

function updateResults() {
    const searchTerm = document.getElementById('searchbar').value.toLowerCase(); 
    const region = document.getElementById('region').value;
    const rating = document.getElementById('sort-by-rating').value;
    const season = document.getElementById('season').value;
    const activityType = document.getElementById('activity-type').value;
    const difficulty = document.getElementById('difficulty').value;

    const resultsDiv = document.getElementById('results');
    resultsDiv.innerHTML = ''; 

    const filteredAttractions = (region === 'any' ? Object.values(attractions).flat() : attractions[region] || []).filter(attraction => {
        const meetsSeason = season === 'any' || attraction.season === season;
        const meetsType = activityType === 'any' || attraction.type === activityType;
        const meetsDifficulty = difficulty === 'any' || attraction.difficulty === difficulty;
        const matchesSearch = attraction.name.toLowerCase().includes(searchTerm);

        return meetsSeason && meetsType && meetsDifficulty && matchesSearch;
    });

    if (rating === 'popular') {
        filteredAttractions.sort((a, b) => b.rating - a.rating);
    } else if (rating === 'rating') {
        filteredAttractions.sort((a, b) => b.rating - a.rating); 
    }

    filteredAttractions.forEach(attraction => {
        const resultItem = document.createElement('div');
        resultItem.classList.add('result-item', region);
        resultItem.innerHTML = `
            <img src="${attraction.image}" alt="${attraction.name}" class="attraction-image" />
            <h4>${attraction.name} 
                <span class="rating" style="color: ${getStarColor(attraction.rating)};">★</span>
                <span style="color: black;"> (${attraction.rating}/5)</span>
            </h4>
            <p>${attraction.description}</p>
        `;
        resultItem.onclick = () => redirectToPlace(attraction.name);
        resultsDiv.appendChild(resultItem);
    });
}

function displayTrending() {
    const trendingDiv = document.getElementById('trending');
    trendingDiv.innerHTML = '';

    trendingAttractions.forEach(attraction => {
        const trendingItem = document.createElement('div');
        trendingItem.classList.add('trending-item');
        trendingItem.innerHTML = `
            <img src="${attraction.image}" alt="${attraction.name}" class="trending-image" />
            <h4>${attraction.name} 
                <span class="rating" style="color: ${getStarColor(attraction.rating)};">★</span>
                <span style="color: black;"> (${attraction.rating}/5)</span>
            </h4>
            <p>${attraction.description}</p>
        `;
        trendingItem.onclick = () => redirectToPlace(attraction.name);
        trendingDiv.appendChild(trendingItem);
    });    
}

function getStarColor(rating) {
    if (rating >= 4.5) return 'gold'; 
    else if (rating >= 3.0) return 'orange'; 
    else return 'red';
}

document.getElementById('region').addEventListener('change', updateResults);
document.getElementById('sort-by-rating').addEventListener('change', updateResults);
document.getElementById('season').addEventListener('change', updateResults);
document.getElementById('activity-type').addEventListener('change', updateResults);
document.getElementById('difficulty').addEventListener('change', updateResults);

function redirectToPlace(place) {
    localStorage.setItem('selectedPlace', place);
    window.location.href = 'place.php';
}

updateResults();
displayTrending();

