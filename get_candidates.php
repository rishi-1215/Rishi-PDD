<?php
include 'db_connection.php'; // Include DB connection

$position = $_GET['position']; // Get position from query parameters

// Fetch candidates for the specified position
$stmt = $conn->prepare("SELECT name, symbol_path FROM headboy");
$stmt->execute();
$result = $stmt->get_result();

$candidates = [];
while ($row = $result->fetch_assoc()) {
    $candidates[] = $row;
}

echo json_encode($candidates);
?>
