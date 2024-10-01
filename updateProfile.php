<?php
session_start(); // Start the session

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

// Handle form submission for updating user data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_SESSION['student_id']; // Ensure student_id is available in the session
    $new_username = $_POST['username'];
    $new_password = $_POST['password'];

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update user data
    $stmt = $conn->prepare("UPDATE students SET username = ?, password = ? WHERE student_id = ?");
    $stmt->bind_param("ssi", $new_username, $hashed_password, $student_id);

    if ($stmt->execute()) {
        $success_message = "Profile updated successfully.";
    } else {
        $error_message = "Error updating profile: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile | Silambam Academy</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <div class="update-container">
        <h2>Update Profile</h2>
        <form action="updateProfile.php" method="POST">
            <input type="text" name="username" placeholder="Enter New Username" required>
            <input type="password" name="password" placeholder="Enter New Password" required>
            <button type="submit">Update</button>
        </form>
        <?php if (isset($success_message)): ?>
            <p class="success-message"><?php echo htmlspecialchars($success_message); ?></p>
        <?php elseif (isset($error_message)): ?>
            <p class="error-message"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
