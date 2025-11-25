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
window.addEventListener('load', () => {
    setTimeout(() => {
        const welcome = document.getElementById('welcome');
        const main = document.getElementById('main-content');

        welcome.style.transition = 'opacity 0.8s ease';
        welcome.style.opacity = 0;

        setTimeout(() => {
            welcome.style.display = 'none';
            main.style.display = 'block';
            main.style.opacity = 0;
            main.style.transition = 'opacity 0.8s ease';
            setTimeout(() => { main.style.opacity = 1; }, 50);
        }, 800);
    }, 2000);
});
