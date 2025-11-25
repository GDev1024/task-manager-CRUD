// Simple toggle task status without page reload (Optional)
document.addEventListener('DOMContentLoaded', () => {
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
});

// Welcome screen fade in effect
document.addEventListener('DOMContentLoaded', () => {
    const welcome = document.getElementById('welcome-animation');
    if(welcome){
        setTimeout(() => { welcome.style.display = 'none'; }, 2500);
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const welcome = document.getElementById('welcome-animation');
    if(welcome){
        setTimeout(() => { welcome.style.display = 'none'; }, 2500);
    }

    // Initialize calendar
    const calendarEl = document.getElementById('calendar');
    if(calendarEl){
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            height: 400,
            events: <?php echo $calendarEventsJSON; ?>,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            }
        });
        calendar.render();
    }
});
