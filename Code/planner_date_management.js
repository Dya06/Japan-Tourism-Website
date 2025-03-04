let isAddingAttractionCard = false; 

const today = new Date().toISOString().split('T')[0];
document.getElementById('startDate').min = today;
document.getElementById('endDate').min = today;

window.onload = function() {
    const savedStartDate = localStorage.getItem('startDate');
    const savedEndDate = localStorage.getItem('endDate');

    if (savedStartDate) {
        document.getElementById('startDate').value = savedStartDate;
    }
    if (savedEndDate) {
        document.getElementById('endDate').value = savedEndDate;
    }

    if (savedStartDate && savedEndDate) {
        generateDays(savedStartDate, savedEndDate);
    }

    const chosenAttraction = JSON.parse(localStorage.getItem('chosenAttraction'));
    const userSelectedDate = localStorage.getItem('userSelectedDate');

    if (chosenAttraction && userSelectedDate) {
        const dayBox = document.querySelector(`.planner-day[data-day="${userSelectedDate}"]`);

        if (dayBox) {
            renderAttractions(dayBox, chosenAttraction);

            localStorage.removeItem('chosenAttraction');
            localStorage.removeItem('userSelectedDate');
            localStorage.removeItem('activityStartTime');
            localStorage.removeItem('activityEndTime');
        }
    }
};

document.getElementById('startDate').addEventListener('change', function() {
    const startDateValue = this.value;
    document.getElementById('endDate').min = startDateValue;
    localStorage.setItem('startDate', startDateValue);

    const endDateValue = document.getElementById('endDate').value;

    if (endDateValue && new Date(startDateValue) > new Date(endDateValue)) {
        document.getElementById('endDate').value = '';
    }

    generateDays(startDateValue, endDateValue);
});

document.getElementById('endDate').addEventListener('change', function() {
    const endDateValue = this.value;
    const startDateValue = document.getElementById('startDate').value;

    if (new Date(endDateValue) < new Date(startDateValue)) {
        alert("End date must be the same or after the start date.");
        this.value = ''; 
    } else {
        localStorage.setItem('endDate', endDateValue);
        generateDays(startDateValue, endDateValue);
    }
});
