<?php
session_start();

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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $dob = $_POST['dob'];
    $adhar = $_POST['adhar'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $school_name = $_POST['school_name'];
    $standard = $_POST['standard'];
    $section = $_POST['section'];
    $student_id = $_POST['student_id'];
    $blood_group = $_POST['blood_group'];
    $username = $_POST['username'];
    $password = $_POST['password']; // Consider hashing the password

    // Hash the password before storing
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if student ID already exists
    $stmt = $conn->prepare("SELECT * FROM students WHERE student_id = ?");
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Student ID exists, perform update
        $stmt = $conn->prepare("UPDATE students SET name = ?, age = ?, dob = ?, adhar = ?, father_name = ?, mother_name = ?, contact = ?, address = ?, school_name = ?, standard = ?, section = ?, blood_group = ?, username = ?, password = ? WHERE student_id = ?");
        $stmt->bind_param("sissssssssssssi", $name, $age, $dob, $adhar, $father_name, $mother_name, $contact, $address, $school_name, $standard, $section, $blood_group, $username, $hashed_password, $student_id);
    } else {
        // Student ID does not exist, perform insert
        $stmt = $conn->prepare("INSERT INTO students (name, age, dob, adhar, father_name, mother_name, contact, address, school_name, standard, section, student_id, blood_group, username, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sisssssssssssss", $name, $age, $dob, $adhar, $father_name, $mother_name, $contact, $address, $school_name, $standard, $section, $student_id, $blood_group, $username, $hashed_password);
    }

    // Execute the query
    if ($stmt->execute()) {
        echo "Record saved successfully";
    } else {
        echo "Error saving record: " . $conn->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
