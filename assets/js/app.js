document.addEventListener('DOMContentLoaded', () => {
    // Calendar
    const calendarEl = document.getElementById('calendar');
    if(calendarEl){
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            height: 400,
            events: window.calendarEvents,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            }
        });
        calendar.render();
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const welcome = document.getElementById('welcome-animation');

    if (welcome) {
        // Add fade-out class AFTER 2 seconds
        setTimeout(() => {
            welcome.classList.add('fade-out');
        }, 2000);

        // Remove the welcome div completely after fade-out animation ends
        setTimeout(() => {
            welcome.remove();
        }, 3000);
    }
});

