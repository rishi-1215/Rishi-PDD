<?php
// Database connection
$servername = "localhost";   // Change to your database server
$username = "root";          // Change to your database username
$password = "";              // Change to your database password
$dbname = "school";          // Change to your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if (isset($_POST['submit'])) {
    $candidateName = $_POST['candidateName'];
    $candidatePosition = $_POST['candidatePosition'];

    // Handle the file upload for the symbol
    $uploadDir = "./uploads/";  // Directory to store the uploaded files
    $uploadFile = $uploadDir . basename($_FILES['candidateSymbol']['name']);

    // Check if the file is an image
    $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
    $allowedTypes = array("jpg", "jpeg", "png", "gif");

    if (in_array($imageFileType, $allowedTypes)) {
        // Move the uploaded file to the server
        if (move_uploaded_file($_FILES['candidateSymbol']['tmp_name'], $uploadFile)) {
            // Prepare the SQL query
            $sql = "INSERT INTO candidates (candidate_name, position, candidate_symbol) VALUES (?, ?, ?)";

            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("sss", $candidateName, $candidatePosition, $uploadFile);

                // Execute the query
                if ($stmt->execute()) {
                    echo "Candidate added successfully.";
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading the file.";
        }
    } else {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }
}

$conn->close();
?>
