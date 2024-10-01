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

// Fetch student details
$student_id = $_SESSION['student_id'];
$stmt = $conn->prepare("SELECT * FROM students WHERE student_id=?");
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

$stmt->close();
$conn->close();

// Check if student data was found
if (!$student) {
    echo "No student details found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile - Silambam Class Attendance Portal</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="studentProfile.css">
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
        <h1>Student Profile</h1>
        <div class="profile-details">
            <div class="profile-header">
                <img src="https://i.imgur.com/vEotMmY.jpeg" alt="Profile Picture" class="profile-picture">
                <strong><?php echo htmlspecialchars($student['name']); ?></strong>
            </div>
            <div class="profile-info">
                <div class="info-row">
                    <label>Name:</label>
                    <span><?php echo htmlspecialchars($student['name']); ?></span>
                </div>
                <div class="info-row">
                    <label>Age:</label>
                    <span><?php echo htmlspecialchars($student['age']); ?></span>
                </div>
                <div class="info-row">
                    <label>DOB:</label>
                    <span><?php echo htmlspecialchars($student['dob']); ?></span>
                </div>
                <div class="info-row">
                    <label>Aadhar:</label>
                    <span><?php echo htmlspecialchars($student['adhar']); ?></span>
                </div>
                <div class="info-row">
                    <label>Father's Name:</label>
                    <span><?php echo htmlspecialchars($student['father_name']); ?></span>
                </div>
                <div class="info-row">
                    <label>Mother's Name:</label>
                    <span><?php echo htmlspecialchars($student['mother_name']); ?></span>
                </div>
                <div class="info-row">
                    <label>Contact:</label>
                    <span><?php echo htmlspecialchars($student['contact']); ?></span>
                </div>
                <div class="info-row">
                    <label>Address:</label>
                    <span><?php echo htmlspecialchars($student['address']); ?></span>
                </div>
                <div class="info-row">
                    <label>School Name:</label>
                    <span><?php echo htmlspecialchars($student['school_name']); ?></span>
                </div>
                <div class="info-row">
                    <label>Standard:</label>
                    <span><?php echo htmlspecialchars($student['standard']); ?></span>
                </div>
                <div class="info-row">
                    <label>Section:</label>
                    <span><?php echo htmlspecialchars($student['section']); ?></span>
                </div>
                <div class="info-row">
                    <label>Student ID:</label>
                    <span><?php echo htmlspecialchars($student['student_id']); ?></span>
                </div>
                <div class="info-row">
                    <label>Blood Group:</label>
                    <span><?php echo htmlspecialchars($student['blood_group']); ?></span>
                </div>
                <div class="info-row">
                    <label>Username:</label>
                    <span><?php echo htmlspecialchars($student['username']); ?></span>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2023 Silambam Academy. All rights reserved.</p>
    </footer>

</body>
</html>
