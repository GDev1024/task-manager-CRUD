document.addEventListener('DOMContentLoaded', () => {
    // Toggle task status 
    const toggles = document.querySelectorAll('.status-toggle');
    toggles.forEach(toggle => {
        toggle.addEventListener('change', function() {
            const taskId = this.dataset.id;
            const status = this.checked ? 'completed' : 'pending';
            
            fetch(`update_status.php?id=${taskId}&status=${status}`)
                .then(res => res.text())
                .then(data => console.log('Status updated'));
        });
    });

    // Welcome screen animation
    const welcome = document.getElementById('welcome-animation');
    if (welcome) {
        setTimeout(() => { welcome.style.display = 'none'; }, 2500);
    }

    // Calendar 
    const calendarEl = document.getElementById('calendar');
    if (calendarEl) {
        const calendarEvents = window.calendarEvents || [];
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            height: 400,
            events: calendarEvents,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            }
        });
        calendar.render();
    }
});
