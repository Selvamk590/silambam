<?php
// Database connection (replace with your own connection details)
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
$sql = "SELECT name, url FROM levels";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="level-item">';
        echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
        echo '<iframe src="' . htmlspecialchars($row['url']) . '" frameborder="0" allowfullscreen></iframe>';
        echo '</div>';
    }
} else {
    echo 'No levels found';
}

// Close connection
$conn->close();
?>
