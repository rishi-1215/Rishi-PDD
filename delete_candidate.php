<?php
include 'db_connection.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Match the names from the HTML form
    $position = $_POST['candidatePosition'];
    $candidate_name = $_POST['candidateName'];

    // Debug: Log the received values
    error_log("Position: " . $position);
    error_log("Candidate Name: " . $candidate_name);

    if (!empty($position) && !empty($candidate_name)) {
        // SQL query to delete the candidate
        $sql = "DELETE FROM candidates WHERE position = ? AND name = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            error_log("Error preparing statement: " . $conn->error);
            echo "<script>alert('Database error. Please try again.'); window.history.back();</script>";
            exit;
        }

        $stmt->bind_param("ss", $position, $candidate_name);

        if ($stmt->execute()) {
            echo "<script>alert('Candidate deleted successfully!'); window.location.href = '../admin.html';</script>";
        } else {
            error_log("Error executing statement: " . $stmt->error);
            echo "<script>alert('Error deleting candidate. Please try again.'); window.history.back();</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Please fill out all fields.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.history.back();</script>";
}

$conn->close();
?>
