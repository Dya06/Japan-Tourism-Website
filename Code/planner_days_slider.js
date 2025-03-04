function generateDays(startDate, endDate) {
    const daysSlider = document.getElementById('daysSlider');
    daysSlider.innerHTML = '';

    if (startDate && endDate) {
        const start = new Date(startDate);
        const end = new Date(endDate);
        const daysCount = (end - start) / (1000 * 3600 * 24);

        for (let i = 0; i <= daysCount; i++) {
            const currentDay = new Date(start);
            currentDay.setDate(currentDay.getDate() + i);

            const dayTitle = `${currentDay.toISOString().split('T')[0]} (${currentDay.toLocaleString('en-US', { weekday: 'long' })})`;

            const dayContainer = document.createElement('div');
            dayContainer.classList.add('day-container');
            
            dayContainer.dataset.day = currentDay.toISOString().split('T')[0]; 
            dayContainer.classList.add('planner-day');

            dayContainer.innerHTML = `
                <h3>${dayTitle}</h3>
                <div class="attraction-container"></div>
                <button class="add-card-btn" onclick="addCard('${currentDay.toISOString().split('T')[0]}')">+ New Attraction</button>`;

            daysSlider.appendChild(dayContainer);
        }

        loadSavedAttractions(); 
    }
}

function loadSavedAttractions() {
    const savedAttractions = JSON.parse(localStorage.getItem('plannerAttractions') || '{}');

    Object.keys(savedAttractions).forEach(date => {
        const dayBox = document.querySelector(`.planner-day[data-day="${date}"]`);
        if (dayBox) {
            const attractionContainer = dayBox.querySelector('.attraction-container');
            attractionContainer.innerHTML = ''; 

            const uniqueAttractions = []; 
            savedAttractions[date].forEach(attraction => {
                const existsInUI = uniqueAttractions.some(addedAttraction =>
                    addedAttraction.place === attraction.place &&
                    addedAttraction.startTime === attraction.startTime &&
                    addedAttraction.endTime === attraction.endTime
                );

                if (!existsInUI) {
                    uniqueAttractions.push(attraction);
                    renderAttractions(dayBox, attraction);
                }
            });
        }
    });
}


function renderAttractions(dayBox, attraction) {
    const attractionContainer = dayBox.querySelector('.attraction-container');
    const newCard = document.createElement('div');
    newCard.classList.add('attraction-card');

    const attractionImage = attractionData[attraction.place]?.imageUrl || 'images/missing.jpg';
    newCard.style.backgroundImage = `url('${attractionImage}')`;
    newCard.style.backgroundSize = 'cover';
    newCard.style.backgroundPosition = 'center';

    newCard.setAttribute('data-place', attraction.place);
    newCard.setAttribute('data-start-time', attraction.startTime);
    newCard.setAttribute('data-end-time', attraction.endTime);
    newCard.setAttribute('data-description', attractionData[attraction.place]?.description);
    newCard.setAttribute('data-region', attractionData[attraction.place]?.region);
    newCard.setAttribute('data-rating', attractionData[attraction.place]?.rating);
    newCard.setAttribute('data-season', attractionData[attraction.place]?.season);
    newCard.setAttribute('data-type', attractionData[attraction.place]?.type);
    newCard.setAttribute('data-difficulty', attractionData[attraction.place]?.difficulty);
    newCard.setAttribute('data-image', attractionImage);

    newCard.innerHTML = `
        <div class="attraction-details">
            <p><strong>Place:</strong> ${attraction.place}</p>
            <p><strong>Start Time:</strong> ${attraction.startTime}</p>
            <p><strong>End Time:</strong> ${attraction.endTime}</p>
        </div>
        <button class="delete-btn">Delete</button>
    `;

    newCard.addEventListener('click', function() {
        openAttractionDetails(newCard);
        openAttractionDetailsPopup();
    });

    const deleteBtn = newCard.querySelector('.delete-btn');
    deleteBtn.addEventListener('click', function(event) {
        event.stopPropagation(); 
        deleteAttraction(dayBox.dataset.day, attraction.place, attraction.startTime, attraction.endTime);
        newCard.remove();
    });

    attractionContainer.appendChild(newCard);
}

function deleteAttraction(date, place, startTime, endTime) {
    let plannerAttractions = JSON.parse(localStorage.getItem('plannerAttractions') || '{}');

    if (plannerAttractions[date]) {
        plannerAttractions[date] = plannerAttractions[date].filter(attraction => 
            !(attraction.place === place && attraction.startTime === startTime && attraction.endTime === endTime)
        );

        localStorage.setItem('plannerAttractions', JSON.stringify(plannerAttractions));

        loadSavedAttractions();
    }
}

function addCard(day) {
    isAddingAttractionCard = true;
    localStorage.setItem('selectedDay', day);
    window.location.href = 'search.php';
}

window.addEventListener('beforeunload', function() {
    if (!isAddingAttractionCard) {
        localStorage.removeItem('selectedDay');
    }
});
