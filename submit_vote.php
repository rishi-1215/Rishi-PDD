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

    $candidateId = intval($_POST['vote']);

    // Example: Increment vote count (you might need to create a votes table for better tracking)
    $sql = "UPDATE candidates SET votes = votes + 1 WHERE id = $candidateId";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('Vote successfully submitted!');
        window.location.href = '../headgirl.php';
    </script>";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
