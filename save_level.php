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

// Get form data
$level_name = $_POST['level_name'];
$level_url = $_POST['level_url'];

// SQL query to insert data into levels table
$sql = "INSERT INTO levels (name, url) VALUES ('$level_name', '$level_url')";

if ($conn->query($sql) === TRUE) {
    echo "New level added successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();

// Redirect back to the levels page
header("Location: levels.php");
exit();
?>
