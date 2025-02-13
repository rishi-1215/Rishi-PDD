<?php
header('Content-Type: application/json');

// Database credentials
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'school';

// Connect to the database
$conn = new mysqli($host, $user, $password, $database);

// Check for connection errors
if ($conn->connect_error) {
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

// Fetch feedback data
$sql = "SELECT id, name, email, message, submitted_at FROM contacts ORDER BY submitted_at DESC";
$result = $conn->query($sql);

// Prepare data for JSON response
$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Return data as JSON
echo json_encode($data);

// Close the database connection
$conn->close();
?>
