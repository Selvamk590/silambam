document.addEventListener("DOMContentLoaded", function () {
    setDefaultDate();
});

function setDefaultDate() {
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('attendanceDate').value = today;
}

function updateSummary() {
    const checkboxes = document.querySelectorAll('.status-checkbox');
    let totalStudents = checkboxes.length;
    let totalPresent = Array.from(checkboxes).filter(checkbox => checkbox.checked).length;
    let totalAbsent = totalStudents - totalPresent;

    document.getElementById('totalStudents').textContent = totalStudents;
    document.getElementById('totalPresent').textContent = totalPresent;
    document.getElementById('totalAbsent').textContent = totalAbsent;
}

function submitAttendance() {
    const attendanceDate = document.getElementById('attendanceDate').value;
    const totalStudents = document.querySelectorAll('.status-checkbox').length;

    document.querySelectorAll('.status-checkbox').forEach(checkbox => {
        const studentId = checkbox.id.split('-')[1]; // Extract student ID
        const status = checkbox.checked ? 'present' : 'absent';

        fetch('save_attendance.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ studentRoll: studentId, attendanceDate, status })
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            // Handle success or error messages here
        })
        .catch(error => console.error('Error:', error));
    });

    // Display results after submission
    document.getElementById('attendanceDateResult').textContent = attendanceDate;
    document.getElementById('attendanceTotalStudents').textContent = totalStudents;
    document.getElementById('resultSection').style.display = 'block';
}
