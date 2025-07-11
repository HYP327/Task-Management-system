document.addEventListener('DOMContentLoaded', function() {
    // Simple confirmation for delete actions
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to delete this task?')) {
                e.preventDefault();
            }
        });
    });
    
    // AJAX for marking tasks as complete
    document.querySelectorAll('.status-toggle').forEach(toggle => {
        toggle.addEventListener('change', function() {
            const taskId = this.dataset.taskId;
            const newStatus = this.value;
            
            fetch(`update_status.php?id=${taskId}&status=${newStatus}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Error updating task status');
                    }
                });
        });
    });
});