<?php
include 'db_connection.php'; // Include your DB connection file

$position = $_GET['position']; // Get position from query parameter
$stmt = $conn->prepare("SELECT name, symbol_path FROM candidates WHERE position = ?");
$stmt->bind_param("s", $position);
$stmt->execute();
$result = $stmt->get_result();

$candidates = [];
while ($row = $result->fetch_assoc()) {
    $candidates[] = $row;
}

echo json_encode($candidates);
?>
