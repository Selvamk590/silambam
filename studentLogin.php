<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details
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

    // Get username and password from POST request
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute query to fetch student details
    $stmt = $conn->prepare("SELECT * FROM students WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a matching student was found
    if ($result->num_rows > 0) {
        // Fetch student data
        $student = $result->fetch_assoc();
        // Store student data in session
        $_SESSION['student_id'] = $student['student_id'];
        $_SESSION['name'] = $student['name'];

        // Redirect to the dashboard
        header("Location: studentDashboard.php");
        exit();
    } else {
        // Invalid login
        $error = "Invalid username or password.";
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login - Silambam Class Attendance Portal</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="loginHome.css">
</head>
<body>
    <header class="custom-header">
        <div class="header-content">
            <img src="https://i.imgur.com/vEotMmY.jpeg" alt="Golden" class="round-logo">
            <nav>
                <ul>
                    <li><a href="#" id="home-link">Home</a></li>
                    <li><a href="#" id="profile-link">Profile</a></li>
                    <li><a href="#" id="attendance-link">Attendance</a></li>
                    <li><a href="#" id="achievements-link">Achievements</a></li>
                    <li><a href="#" id="levels-link">Levels</a></li>
                    <li><a href="#" id="payment-link">Payment</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section id="login-page" class="page">
            <div class="container login-container">
                <h2>Student Login</h2>
                <form action="studentLogin.php" method="POST">
                    <input type="text" id="username-input" class="login-input" name="username" placeholder="Username" required />
                    <input type="password" id="password-input" class="login-input" name="password" placeholder="Password" required />
                    <button type="submit" id="login-btn" class="login-btn">Login</button>
                </form>
                <p id="error-message" class="error-message">
                
                </p>
            </div>
        </section>
    </main>

    <footer class="custom-footer">
        <p>&copy; 2024 Silambam Academy. All rights reserved.</p>
    </footer>
</body>
</html>
