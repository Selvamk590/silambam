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

// Handle form submission to add achievement
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['studentName']) && isset($_POST['achievementTitle']) && isset($_POST['achievementDate']) && isset($_POST['achievementDetails'])) {
    $studentName = $_POST['studentName'];
    $achievementTitle = $_POST['achievementTitle'];
    $achievementDate = $_POST['achievementDate'];
    $achievementDetails = $_POST['achievementDetails'];

    // Insert achievement into the database
    $sql = "INSERT INTO achievements (student_name, achievement_title, achievement_date, achievement_details) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssss", $studentName, $achievementTitle, $achievementDate, $achievementDetails);
        $stmt->execute();
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

// Handle form submission to delete achievement
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteAchievement']) && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Delete achievement from the database
    $sql = "DELETE FROM achievements WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
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
    <script src="achievements.js" defer></script>
    <style>
        /* Footer */
.footer {
    background-color: #4CAF50; /* Green background for Footer */
    color: #fff;
    text-align: center;
    padding: 15px;
    position: relative; /* Change to relative */
    width: 100%;
}

        </style>
</head>
<body class="achievements-page">

    <header class="custom-header">
        <div class="header-content">
            <img src="https://i.imgur.com/vEotMmY.jpeg" alt="Silambam" class="round-logo">
            <nav>
                <ul>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="attendance.php">Attendance</a></li>
                    <li><a href="levels.php">Levels</a></li>
                    <li><a href="payment.php">Payment</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container">
        <h2>Record Achievements</h2>
        <form id="achievementForm" method="post">
            <label for="studentName">Student Name:</label>
            <input type="text" id="studentName" name="studentName" required>

            <label for="achievementTitle">Achievement Title:</label>
            <input type="text" id="achievementTitle" name="achievementTitle" required>

            <label for="achievementDate">Date:</label>
            <input type="date" id="achievementDate" name="achievementDate" required>

            <label for="achievementDetails">Details:</label>
            <textarea id="achievementDetails" name="achievementDetails" rows="4" required></textarea>

            <button type="submit">Add Achievement</button>
        </form>

        <h3>Achievements List</h3>
        <ul id="achievementsList">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<li>
                            <strong>' . htmlspecialchars($row['student_name']) . '</strong>
                            <p><em>' . htmlspecialchars($row['achievement_title']) . '</em> on ' . htmlspecialchars($row['achievement_date']) . '</p>
                            <p>' . htmlspecialchars($row['achievement_details']) . '</p>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="id" value="' . htmlspecialchars($row['id']) . '">
                                <button type="submit" name="deleteAchievement" class="delete-button">Delete</button>
                            </form>
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
