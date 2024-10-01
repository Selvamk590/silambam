<?php
session_start();

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "silambam_academy";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Get the JSON input
$data = json_decode(file_get_contents("php://input"), true);

// Ensure all necessary fields are set
if (!isset($data['studentRoll']) || !isset($data['attendanceDate']) || !isset($data['status'])) {
    echo json_encode(["error" => "Missing required fields"]);
    exit;
}

// Sanitize inputs
$student_id = $conn->real_escape_string($data['studentRoll']);
$attendance_date = $conn->real_escape_string($data['attendanceDate']);
$status = $conn->real_escape_string($data['status']);

// Prepare the SQL statement to insert attendance record
$stmt = $conn->prepare("INSERT INTO attendance (student_id, attendance_date, status) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $student_id, $attendance_date, $status);

// Execute the statement and check for success
if ($stmt->execute()) {
    echo json_encode(["message" => "Attendance saved successfully"]);
} else {
    echo json_encode(["error" => "Error saving attendance: " . $stmt->error]);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
