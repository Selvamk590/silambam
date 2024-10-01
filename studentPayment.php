<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Adjust password if necessary
$database = "silambam_academy";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to generate unique transaction ID
function generateTransactionId() {
    return uniqid('txn_'); // Unique transaction ID
}

// Function to create UPI link
function createUpiLink($upiId, $amount, $transactionId) {
    return "upi://pay?pa=$upiId&pn=Your%20Academy%20Name&mc=1234&tid=$transactionId&am=$amount&cu=INR&url=http://localhost/Silambam/pages/studentPayment.php";
}

// Function to validate input
function validateAmount($amount) {
    return filter_var($amount, FILTER_VALIDATE_FLOAT) && $amount > 0;
}

// Function to log transaction
function logTransaction($conn, $transactionId, $amount) {
    $stmt = $conn->prepare("INSERT INTO transactions (transaction_id, amount) VALUES (?, ?)");
    $stmt->bind_param("sd", $transactionId, $amount);
    return $stmt->execute();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $upiId = 'selvamkselvamk590@oksbi'; // Your UPI ID
    $amount = $_POST['amount'];

    // Validate amount
    if (validateAmount($amount)) {
        $transactionId = generateTransactionId(); // Generate a unique transaction ID

        // Log the transaction
        if (logTransaction($conn, $transactionId, $amount)) {
            $upiLink = createUpiLink($upiId, $amount, $transactionId);

            // Redirect to UPI payment link
            header("Location: $upiLink");
            exit();
        } else {
            echo "<script>alert('Transaction logging failed. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('Please enter a valid amount.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Payment</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="achievements.css"> <!-- Link to your CSS file -->
</head>
<body class="achievements-page">

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
        <h2>Make a Payment</h2>
        <form method="POST" action="">
            <label for="amount">Amount (INR):</label>
            <input type="number" name="amount" id="amount" required min="0.01" step="0.01">

            <button type="submit">Pay with UPI</button>
        </form>
    </main>

    <footer class="footer">
        <p>&copy; 2024 Silambam Academy - All Rights Reserved</p>
    </footer>

</body>
</html>

<?php
$conn->close();
?>
