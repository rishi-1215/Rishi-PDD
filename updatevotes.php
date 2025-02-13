<?php
include 'db_connection.php'; // Include DB connection

// Get the selected candidate's name from the POST request
$data = json_decode(file_get_contents("php://input"), true);
$candidate_name = $data['candidate_name'];

// Prepare and execute the update query
$stmt = $conn->prepare("UPDATE headboy SET votes = votes + 1 WHERE name = ?");
$stmt->bind_param("s", $candidate_name);
if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Vote submitted successfully!"]);
} else {
    echo json_encode(["success" => false, "message" => "Error submitting vote."]);
}
?>
