<?php
include '../database_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['vote'])) {
        $candidate_id = $_POST['vote'];

        // Insert vote into votes table
        $stmt = $conn->prepare("INSERT INTO votes (candidate_id) VALUES (?)");
        $stmt->bind_param("i", $candidate_id);

        if ($stmt->execute()) {
            // Redirect to headgirl.php after success
            header("Location: ../headgirl.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "No vote selected!";
    }
}

$conn->close();
?>
