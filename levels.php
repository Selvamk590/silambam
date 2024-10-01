<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Silambam Levels</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="levels.css"> <!-- Link to your CSS -->
</head>
<body>
    <header class="custom-header">
        <div class="header-content">
            <img src="https://i.imgur.com/vEotMmY.jpeg" alt="Silambam" class="round-logo">
            <nav>
                <ul>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="attendance.php">Attendance</a></li>
                    <li><a href="achievements.php">Achievements</a></li>
                    <li><a href="levels.php">Levels</a></li>
                    <li><a href="payment.php">Payment</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container">
        <section class="silambam-section">
            <div class="silambam-container">
                <h1>Silambam Techniques</h1>
                <!-- Form to add new levels -->
                <form action="save_level.php" method="POST" class="level-form">
    <label for="level-name">Level Name:</label>
    <input type="text" id="level-name" name="level_name" placeholder="Enter Level Name" required>
    
    <label for="level-url">YouTube URL:</label>
    <input type="url" id="level-url" name="level_url" placeholder="Enter YouTube URL" required>
    
    <button type="submit" class="add-level-btn">Add Level</button>
</form>


                <?php
                // Database connection
                $conn = new mysqli("localhost", "root", "", "silambam_academy");

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // SQL query to retrieve levels
                $sql = "SELECT id, name, url FROM levels";
                $result = $conn->query($sql);

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
                        // Delete button
                        echo '<form action="delete_level.php" method="POST" style="display:inline;">
                                <input type="hidden" name="level_id" value="' . $id . '">
                                <button type="submit" class="delete-btn">Delete</button>
                              </form>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No levels found</p>';
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
