<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['student_id'])) {
    header("Location: studentLogin.php"); // Redirect to login if not logged in
    exit();
}

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

// Fetch student details if needed
$student_id = $_SESSION['student_id'];
$stmt = $conn->prepare("SELECT * FROM students WHERE student_id=?");
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Silambam Class Attendance Portal & Academy</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="studentDashboard.css">
</head>
<body>
    <header class="custom-header">
        <div class="header-content">
            <img src="https://i.imgur.com/vEotMmY.jpeg" alt="Silambam" class="round-logo">
            <nav>
                <ul>
                <li><a href="studentDashboard.php">Dashboard</a></li>
                    <li><a href="studentProfile.php">Profile</a></li>
                    <li><a href="studentAttendance.php" id="studentAttendance-link">Attendance</a></li>
                    <li><a href="studentAchievements.php" id="studentAchievements-link">Achievements</a></li>
                    <li><a href="studentLevels.php" id="studentLevels-link">Levels</a></li>
                    <li><a href="studentPayment.php" id="studentPayment-link">Payment</a></li>
                    <li><a href="logout.php" id="logout-link">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <h1>Welcome to Your Dashboard, <?php echo htmlspecialchars($student['name']); ?>!</h1>
        <div class="dashboard-grid">
            <a href="studentAttendance.php" class="dashboard-item">
                <i class="fas fa-calendar-check"></i>
                <h3>Attendance</h3>
            </a>
            <a href="studentProfile.php" class="dashboard-item">
                <i class="fas fa-user"></i>
                <h3>Profile</h3>
            </a>
            <a href="studentLevels.php" class="dashboard-item">
                <i class="fas fa-trophy"></i>
                <h3>Levels</h3>
            </a>
            <a href="studentAchievements.php" class="dashboard-item">
                <i class="fas fa-star"></i>
                <h3>Achievements</h3>
            </a>
            <a href="studentPayment.php" class="dashboard-item">
                <i class="fas fa-credit-card"></i>
                <h3>Payment</h3>
            </a>
            <a href="logout.php" class="dashboard-item">
                <i class="fas fa-sign-out-alt"></i>
                <h3>Logout</h3>
            </a>
        </div>
    </main>

    <footer class="footer">
        <p>&copy; 2023 Silambam Academy. All rights reserved.</p>
    </footer>

    <script src="https://kit.fontawesome.com/your-font-awesome-key.js" crossorigin="anonymous"></script>
</body>
</html>
