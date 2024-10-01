<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "silambam_academy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$month = date('Y-m'); // Get current month
$attendanceData = [];

$sql = "SELECT student_id, COUNT(*) as total_classes, 
               SUM(CASE WHEN status='present' THEN 1 ELSE 0 END) as total_present 
        FROM attendance 
        WHERE DATE_FORMAT(attendance_date, '%Y-%m') = ?
        GROUP BY student_id";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $month);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $percentage = ($row['total_present'] / $row['total_classes']) * 100;
    $attendanceData[$row['student_id']] = [
        'total_classes' => $row['total_classes'],
        'total_present' => $row['total_present'],
        'percentage' => round($percentage, 2)
    ];
}

$stmt->close();
$conn->close();

// Output the data (you can format this as needed)
header('Content-Type: application/json');
echo json_encode($attendanceData);
?>
