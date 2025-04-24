let currentDate = new Date();
let currentMonth = currentDate.getMonth();
let currentYear = currentDate.getFullYear();

const monthNames = ["January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
];

function initCalendar() {
    document.getElementById('prevMonth').addEventListener('click', () => {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        loadCalendar();
    });

    document.getElementById('nextMonth').addEventListener('click', () => {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        loadCalendar();
    });

    loadCalendar();
}

function loadCalendar() {
    const firstDay = new Date(currentYear, currentMonth, 1);
    const lastDay = new Date(currentYear, currentMonth + 1, 0);
    const startingDay = firstDay.getDay();
    const totalDays = lastDay.getDate();

    document.getElementById('monthDisplay').textContent = 
        `${monthNames[currentMonth]} ${currentYear}`;

    const calendarDays = document.getElementById('calendar');
    calendarDays.innerHTML = '';

    for (let i = 0; i < startingDay; i++) {
        const paddingDay = document.createElement('div');
        paddingDay.classList.add('day', 'padding');
        calendarDays.appendChild(paddingDay);
    }

    for (let day = 1; day <= totalDays; day++) {
        const dayElement = document.createElement('div');
        dayElement.classList.add('day');
        dayElement.textContent = day;

        if (day === new Date().getDate() && 
            currentMonth === new Date().getMonth() && 
            currentYear === new Date().getFullYear()) {
            dayElement.classList.add('today');
        }

        calendarDays.appendChild(dayElement);
    }
}

document.addEventListener('DOMContentLoaded', initCalendar);
