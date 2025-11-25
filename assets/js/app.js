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

    // Welcome animation
    const welcome = document.getElementById('welcome-animation');
    if(welcome){
        setTimeout(()=>{ welcome.style.display='none'; }, 2500);
    }
});
