<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the Composer autoloader
if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
    die('Error: autoload.php not found. Please run composer install.');
}

require __DIR__ . '/vendor/autoload.php';

use Razorpay\Api\Api;

// Your Razorpay API credentials
$keyId = 'rzp_test_dcLOn6AbHCRR4o'; // Replace with your actual key
$keySecret = 'YEMin330Y1dO7FXrQ5xpfkKA'; // Replace with your actual secret

$api = new Api($keyId, $keySecret);

// Check if payment is being processed
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['amount'])) {
    // Convert amount to paise and ensure it's a string
    $amount = (string)($_POST['amount'] * 100); // Convert to paise and ensure it's a string
    $currency = 'INR'; // Set currency

    // Create an order
    $orderData = [
        'receipt' => rand(1000, 9999), // Unique receipt ID
        'amount' => $amount, // Amount as string in paise
        'currency' => $currency,
    ];

    try {
        $order = $api->order->create($orderData);
        echo json_encode($order); // Return order details as JSON for JavaScript to handle
        exit; // Stop further execution
    } catch (Exception $e) {
        error_log("Error creating order: " . $e->getMessage());
        echo json_encode(['error' => $e->getMessage()]);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Portal - Silambam Academy</title>
    <link rel="stylesheet" href="./payment.css">
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
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section id="payment-section" class="container">
            <h2>Payment Portal</h2>
            <div class="payment-form">
                <form id="paymentForm" method="POST">
                    <label for="studentName">Student Name:</label>
                    <input type="text" id="studentName" name="studentName" required>

                    <label for="paymentAmount">Payment Amount (in ₹):</label>
                    <input type="number" id="paymentAmount" name="amount" required>

                    <label for="paymentMonth">Payment for Month:</label>
                    <select id="paymentMonth" name="paymentMonth" required>
                        <option value="">Select Month</option>
                        <?php foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month): ?>
                            <option value="<?= $month ?>"><?= $month ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label for="paymentMethod">Payment Method:</label>
                    <select id="paymentMethod" name="paymentMethod" required>
                        <option value="">Select Payment Method</option>
                        <option value="upi">UPI</option>
                        <option value="netbanking">Net Banking</option>
                        <option value="card">Credit/Debit Card</option>
                        <option value="cash">Cash</option>
                        <option value="bank">Bank Transfer</option>
                    </select>

                    <button type="button" onclick="processPayment()">Make Payment</button>
                </form>

                <div id="paymentResult" class="payment-result" style="display: none;">
                    <h3>Payment Receipt</h3>
                    <p>Student Name: <span id="receiptName"></span></p>
                    <p>Amount Paid: ₹<span id="receiptAmount"></span></p>
                    <p>Month: <span id="receiptMonth"></span></p>
                    <p>Payment Method: <span id="receiptMethod"></span></p>
                    <p>Transaction ID: <span id="receiptTransactionId"></span></p>
                    <p>Date: <span id="receiptDate"></span></p>
                </div>
            </div>
        </section>
    </main>

    <footer class="custom-footer">
        <p>&copy; 2023 Silambam Academy. All rights reserved.</p>
    </footer>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        function processPayment() {
            const form = document.getElementById('paymentForm');
            const formData = new FormData(form);

            fetch('payment.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(order => {
                if (order.error) {
                    alert('Error: ' + order.error);
                    return;
                }

                const options = {
                    key: "<?= $keyId ?>", // Your Razorpay Key ID
                    amount: order.amount, // Amount in paise
                    currency: order.currency, // Currency
                    name: "Silambam Academy",
                    description: "Payment for " + document.getElementById('studentName').value,
                    order_id: order.id, // The Razorpay order ID
                    handler: function (response) {
                        document.getElementById('receiptName').innerText = document.getElementById('studentName').value;
                        document.getElementById('receiptAmount').innerText = document.getElementById('paymentAmount').value;
                        document.getElementById('receiptMonth').innerText = document.getElementById('paymentMonth').value;
                        document.getElementById('receiptMethod').innerText = document.getElementById('paymentMethod').value;
                        document.getElementById('receiptTransactionId').innerText = response.razorpay_payment_id;
                        document.getElementById('receiptDate').innerText = new Date().toLocaleString();
                        document.getElementById('paymentResult').style.display = 'block';
                    },
                    prefill: {
                        name: document.getElementById('studentName').value,
                        email: "", // Optional
                        contact: "", // Optional
                    },
                    theme: {
                        color: "#F37254" // Razorpay theme color
                    }
                };

                const rzp = new Razorpay(options);
                rzp.open();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Payment processing failed. Please try again.');
            });
        }
    </script>
</body>
</html>
