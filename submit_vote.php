<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'school';

    $conn = new mysqli($host, $user, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Ensure vote is passed safely
    if (isset($_POST['vote'])) {
        $candidateId = intval($_POST['vote']);

        // Update vote count
        $sql = "UPDATE candidates SET votes = votes + 1 WHERE id = $candidateId";

        if ($conn->query($sql) === TRUE) {
            // Redirect to headgirl.php with success flag
            header("Location: ../headgirl.php?success=1");
            exit();
        } else {
            // Redirect with error flag
            header("Location: ../headgirl.php?error=" . urlencode($conn->error));
            exit();
        }
    } else {
        // If no candidate selected
        header("Location: ../headgirl.php?error=" . urlencode("No candidate selected."));
        exit();
    }

    $conn->close();
}
?>
