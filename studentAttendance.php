<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: studentLogin.php");
    exit();
}

// Fetch the student's name and ID from session
$name = isset($_SESSION['name']) ? $_SESSION['name'] : 'Student';
$student_id = $_SESSION['student_id'];

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "silambam_academy";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch attendance data for the logged-in student
$sql = "SELECT COUNT(*) AS total_classes, 
               SUM(CASE WHEN status = 'present' THEN 1 ELSE 0 END) AS total_present 
        FROM attendance 
        WHERE student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result) {
    $row = $result->fetch_assoc();
    $total_classes = $row['total_classes'];
    $total_present = $row['total_present'];
    $percentage = $total_classes > 0 ? ($total_present / $total_classes) * 100 : 0;
} else {
    $total_classes = 0;
    $total_present = 0;
    $percentage = 0; // Default to 0 if query fails
}

// Close connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance for <?php echo htmlspecialchars($name); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="attendance.css">
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

    <main class="container">
        <section class="silambam-section">
            <h2>Attendance for <?php echo htmlspecialchars($name); ?></h2>
            <table>
                <tr>
                    <th>Total Classes</th>
                    <th>Total Present</th>
                    <th>Attendance Percentage</th>
                </tr>
                <tr>
                    <td><?php echo $total_classes; ?></td>
                    <td><?php echo $total_present; ?></td>
                    <td><?php echo number_format($percentage, 2) . '%'; ?></td>
                </tr>
            </table>
        </section>
    </main>

    <footer class="footer">
        <p>&copy; <?php echo date("Y"); ?> Silambam Academy. All rights reserved.</p>
    </footer>
</body>
</html>
