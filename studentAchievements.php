<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Adjust password if necessary
$database = "silambam_academy";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch achievements from the database
$sql = "SELECT * FROM achievements";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Achievements</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="achievements.css">
</head>
<body class="achievements-page">

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

    <main class="container">
        <h2>Achievements List</h2>
        <ul id="achievementsList">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<li>
                            <strong>' . htmlspecialchars($row['student_name']) . '</strong>
                            <p><em>' . htmlspecialchars($row['achievement_title']) . '</em> on ' . htmlspecialchars($row['achievement_date']) . '</p>
                            <p>' . htmlspecialchars($row['achievement_details']) . '</p>
                        </li>';
                }
            } else {
                echo '<li>No achievements found.</li>';
            }
            ?>
        </ul>
    </main>

    <footer class="footer">
        <p>&copy; 2024 Silambam Academy - All Rights Reserved</p>
    </footer>

</body>
</html>

<?php
$conn->close();
?>
