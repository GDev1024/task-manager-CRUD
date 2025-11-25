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
