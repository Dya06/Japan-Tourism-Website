const attractionData = {
    'Shiretoko National Park': {
        imageUrl: 'images/shiretoko.jpg',
        description: 'Unspoiled wilderness on the Shiretoko Peninsula.',
        region: 'Hokkaido',
        type: 'Hiking',
        difficulty: 'Easy',
        rating: 5,
        season: 'Any'
    },
    'Rishiri and Rebun': {
        imageUrl: 'images/rishiri_rebun.jpg',
        description: 'Small islands near Hokkaido\'s northern tip.',
        region: 'Hokkaido',
        type: 'Sightseeing',
        difficulty: 'Moderate',
        rating: 4,
        season: 'Summer'
    },
    'Daisetsuzan': {
        imageUrl: 'images/daisetsuzan.jpg',
        description: 'Hokkaido\'s largest and wildest national park.',
        region: 'Hokkaido',
        type: 'Hiking',
        difficulty: 'Challenging',
        rating: 5,
        season: 'Autumn'
    },
    'Tokyo': {
        imageUrl: 'images/tokyo.jpg',
        description: 'Japan\'s busy capital, known for skyscrapers, shopping, and vibrant nightlife.',
        region: 'Kanto',
        type: 'Sightseeing',
        difficulty: 'Easy',
        rating: 5,
        season: 'Any'
    },
    'Nikko': {
        imageUrl: 'images/nikko.jpg',
        description: 'Site of Nikko Toshogu, Ieyasu\'s mausoleum.',
        region: 'Kanto',
        type: 'Historical',
        difficulty: 'Easy',
        rating: 4.5,
        season: 'Spring'
    },
    'Ogasawara Islands': {
        imageUrl: 'images/ogasawara_isl.jpg',
        description: 'Remote islands 1000 kilometers south of Tokyo.',
        region: 'Kanto',
        type: 'Sightseeing',
        difficulty: 'Moderate',
        rating: 4,
        season: 'Summer'
    },
    'Mount Fuji': {
        imageUrl: 'images/mt_fuji.jpg',
        description: 'The country\'s most iconic landmark.',
        region: 'Chubu',
        type: 'Hiking',
        difficulty: 'Challenging',
        rating: 5,
        season: 'Summer'
    },
    'Alpine Route': {
        imageUrl: 'images/alpine.jpg',
        description: 'Spectacular route through the Northern Alps.',
        region: 'Chubu',
        type: 'Sightseeing',
        difficulty: 'Moderate',
        rating: 4.5,
        season: 'Autumn'
    },
    'Shirakawago & Gokayama': {
        imageUrl: 'images/shirakawago.jpg',
        description: 'Mountainous region known for its farmhouses.',
        region: 'Chubu',
        type: 'Cultural',
        difficulty: 'Easy',
        rating: 4,
        season: 'Winter'
    },
    'Nara': {
        imageUrl: 'images/nara.jpg',
        description: 'Famous for its tame deer and historic temples.',
        region: 'Nara',
        type: 'Sightseeing',
        difficulty: 'Easy',
        rating: 4.5,
        season: 'Any'
    },
    'Hiroshima': {
        imageUrl: 'images/hiroshima.jpg',
        description: 'Known for its historical significance and beautiful gardens.',
        region: 'Hiroshima',
        type: 'Sightseeing',
        difficulty: 'Easy',
        rating: 4.8,
        season: 'Any'
    },
    'Kyoto': {
        imageUrl: 'images/kyoto.jpg',
        description: 'Known for its classical Buddhist temples, gardens, and traditional wooden houses.',
        region: 'Kyoto',
        type: 'Sightseeing',
        difficulty: 'Easy',
        rating: 4.7,
        season: 'Any'
    },
    'Osaka': {
        imageUrl: 'images/osaka.jpg',
        description: 'A large port city known for its commercial centers and attractions like Osaka Castle.',
        region: 'Osaka',
        type: 'Sightseeing',
        difficulty: 'Easy',
        rating: 4.6,
        season: 'Any'
    }
};

const popup = document.querySelector('.popup');
const mainPopup = document.querySelector('.main-popup');
const closeBtn = document.querySelector('.close-btn');
const popupOverlay = document.querySelector('.popup-overlay');

function openAttractionDetailsPopup() {
    popup.style.display = 'flex';
    mainPopup.style.cssText = 'animation: slide-in 0.5s ease; animation-fill-mode: forwards;';
}

function closeAttractionDetails() {
    mainPopup.style.cssText = 'animation: slide-out 0.5s ease; animation-fill-mode: forwards;';
    setTimeout(() => {
        popup.style.display = 'none';
    }, 500);
}

closeBtn.addEventListener('click', closeAttractionDetails);
popupOverlay.addEventListener('click', closeAttractionDetails);

function populateAttractionDetails(details) {
    document.getElementById('attractionPlace').textContent = details.place || "Unknown place";
    document.getElementById('attractionStartTime').textContent = details.startTime || "Not provided";
    document.getElementById('attractionEndTime').textContent = details.endTime || "Not provided";
    document.getElementById('attractionDescription').textContent = details.description || "No description available";
    document.getElementById('attractionRegion').textContent = details.region || "Region not specified";
    document.getElementById('attractionRating').textContent = details.rating || "No rating";
    document.getElementById('attractionSeason').textContent = details.season || "Season not specified";
    document.getElementById('attractionType').textContent = details.type || "Type not specified";
    document.getElementById('attractionDifficulty').textContent = details.difficulty || "Difficulty not specified";
    document.getElementById('attractionImage').src = details.image || "default-image.jpg";
}

function openAttractionDetails(newCard) {
    const details = {
        place: newCard.getAttribute('data-place'),
        startTime: newCard.getAttribute('data-start-time'),
        endTime: newCard.getAttribute('data-end-time'),
        description: newCard.getAttribute('data-description'),
        region: newCard.getAttribute('data-region'),
        rating: newCard.getAttribute('data-rating'),
        season: newCard.getAttribute('data-season'),
        type: newCard.getAttribute('data-type'),
        difficulty: newCard.getAttribute('data-difficulty'),
        image: newCard.getAttribute('data-image')
    };

    populateAttractionDetails(details);
    
    popup.style.display = 'flex';
    mainPopup.style.cssText = 'animation: slide-in 0.5s ease; animation-fill-mode: forwards;';
}