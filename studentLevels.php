<?php
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

// SQL query to retrieve levels
$sql = "SELECT id, name, url FROM levels";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Levels</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="levels.css"> <!-- Link to your CSS -->
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
                    <li><a href="studentPayment.php" id="studentPayment-link">Payment</a></li>
                    <li><a href="logout.php" id="logout-link">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container">
        <section class="silambam-section">
            <div class="silambam-container">
                <h1>Available Silambam Levels</h1>

                <?php
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $id = htmlspecialchars($row['id']);
                        $name = htmlspecialchars($row['name']);
                        $url = htmlspecialchars($row['url']);

                        // Extract YouTube video ID from URL
                        parse_str(parse_url($url, PHP_URL_QUERY), $query);
                        $video_id = $query['v'] ?? '';

                        echo '<div class="level-item">';
                        echo '<h3>' . $name . '</h3>';
                        if ($video_id) {
                            echo '<iframe src="https://www.youtube.com/embed/' . $video_id . '" frameborder="0" allowfullscreen></iframe>';
                        } else {
                            echo '<p>Invalid YouTube URL</p>';
                        }
                        echo '</div>';
                    }
                } else {
                    echo '<p>No levels available at the moment.</p>';
                }

                // Close connection
                $conn->close();
                ?>
            </div>
        </section>
    </main>

    <footer class="custom-footer">
        <p>&copy; 2024 Silambam Academy. All rights reserved.</p>
    </footer>
</body>
</html>
