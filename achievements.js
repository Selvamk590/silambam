document.addEventListener('DOMContentLoaded', function() {
    // Form submission handling
    const form = document.getElementById('achievementForm');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const studentName = document.getElementById('studentName').value;
        const achievementTitle = document.getElementById('achievementTitle').value;
        const achievementDate = document.getElementById('achievementDate').value;
        const achievementDetails = document.getElementById('achievementDetails').value;

        // Perform AJAX request to submit form data
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'achievements.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            if (xhr.status === 200) {
                // Reload the page to update the list of achievements
                window.location.reload();
            } else {
                alert('An error occurred. Please try again.');
            }
        };

        const params = `studentName=${encodeURIComponent(studentName)}&achievementTitle=${encodeURIComponent(achievementTitle)}&achievementDate=${encodeURIComponent(achievementDate)}&achievementDetails=${encodeURIComponent(achievementDetails)}`;
        xhr.send(params);
    });

    // Delete button handling
    const deleteButtons = document.querySelectorAll('.delete-button');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            const id = this.previousElementSibling.value;

            // Perform AJAX request to delete achievement
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'achievements.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Reload the page to update the list of achievements
                    window.location.reload();
                } else {
                    alert('An error occurred. Please try again.');
                }
            };

            const params = `deleteAchievement=true&id=${encodeURIComponent(id)}`;
            xhr.send(params);
        });
    });
});
