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

// Get level ID from POST request
$level_id = $_POST['level_id'];

// SQL query to delete the level
$sql = "DELETE FROM levels WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $level_id);

if ($stmt->execute()) {
    // Redirect back to the levels page after successful deletion
    header("Location: levels.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}

// Close connection
$stmt->close();
$conn->close();
?>
