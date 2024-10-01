<?php
// Include database connection file
include 'db_connection.php';

if (isset($_GET['id'])) {
    $student_id = $_GET['id'];

    // Prepare the delete statement
    $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
    $stmt->bind_param("i", $student_id);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Student deleted successfully.";
        // Redirect to the profile page or any other page
        header("Location: profile.php");
    } else {
        echo "Error deleting student: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "No student ID provided.";
}
?>
