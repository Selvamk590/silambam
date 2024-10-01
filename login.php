<?php
// Database connection settings
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

// Get the data from the login form
$user = $_POST['username'];
$pass = $_POST['password'];

// Prepare and execute SQL statement
$sql = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
$sql->bind_param("ss", $user, $pass);
$sql->execute();
$result = $sql->get_result();

// Check if login is successful
if ($result->num_rows > 0) {
    // Login successful, redirect to dashboard
    header("Location: ./dashboard.php");
    exit();
} else {
    // Login failed, show error message
    echo "Invalid username or password.";
}

// Close the connection
$conn->close();
?>
