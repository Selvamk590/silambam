<?php
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "silambam_academy";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch student names
$sql = "SELECT name, student_id FROM students";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Page - Silambam Class</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="attendance.css">
</head>
<body>
    <header class="custom-header">
        <div class="header-content">
            <img src="https://i.imgur.com/vEotMmY.jpeg" alt="Silambam" class="round-logo">
            <nav>
                <ul>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="achievements.php">Achievements</a></li>
                    <li><a href="levels.php">Levels</a></li>
                    <li><a href="payment.php">Payment</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <h2>Mark Attendance</h2>
        <label for="attendanceDate">Attendance Date:</label>
        <input type="date" id="attendanceDate" required>

        <h3>Class: Silambam</h3>

        <ul id="studentsList">
            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<li>' . htmlspecialchars($row['name']) . ' (ID: ' . htmlspecialchars($row['student_id']) . ')';
                    echo '<input type="checkbox" id="present-' . htmlspecialchars($row['student_id']) . '" class="status-checkbox"></li>';
                }
            } else {
                echo '<li>No students found.</li>';
            }
            ?>
        </ul>

        <div id="summarySection">
            <h3>Summary</h3>
            <p>Total Students: <span id="totalStudents">0</span></p>
            <p>Total Present: <span id="totalPresent">0</span></p>
            <p>Total Absent: <span id="totalAbsent">0</span></p>
        </div>

        <button onclick="submitAttendance()">Submit Attendance</button>

        <div id="resultSection" style="display: none;">
            <h3>Attendance Result</h3>
            <p>Date: <span id="attendanceDateResult"></span></p>
            <p>Class: Silambam</p>
            <p>Total Students: <span id="attendanceTotalStudents"></span></p>
            <p>Present: <span id="attendancePresent"></span></p>
            <p>Absent: <span id="attendanceAbsent"></span></p>
        </div>
    </div>
    <footer class="footer">
    <p>&copy; 2024 Silambam Academy. All rights reserved.</p>
  </footer>

    <script src="attendance.js"></script>
</body>
</html>

<?php
$conn->close();
?>
