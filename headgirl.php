<?php
// Database configuration
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'school';

// Establish database connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle vote submission
    $selectedCandidate = $_POST['vote'] ?? null;

    if ($selectedCandidate) {
        // Update the votes for the selected candidate
        $sql = "UPDATE candidates SET votes = votes + 1 WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $selectedCandidate);

        if ($stmt->execute()) {
            echo "
            <script>
                alert('Vote successfully submitted!');
                window.location.href = 'sportshead.php'; // Redirect to the next voting page
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Error submitting your vote. Please try again.');
                window.history.back();
            </script>
            ";
        }

        $stmt->close();
    } else {
        echo "
        <script>
            alert('No candidate selected. Please select a candidate to vote.');
            window.history.back();
        </script>
        ";
    }
    $conn->close();
    exit;
}

// Fetch Head Girl candidates
$sql = "SELECT id, candidate_name, candidate_symbol FROM candidates WHERE position = 'headgirl'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Head Girl Voting</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #74ebd5, #acb6e5); /* Gradient blue background */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #ffffff;
            flex-direction: column;
        }

        /* Header Styles */
        .header {
            width: 100%;
            background: linear-gradient(135deg, #A7C7E7, #B5D8E9); /* Soft light blue gradient */
            color: #333;
            text-align: center;
            padding: 20px;
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 30px; /* Gap between header and container */
        }

        .container {
            background: white;
            border-radius: 12px;
            padding: 25px 30px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
            max-width: 600px;
            width: 90%;
            text-align: center;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: black; /* Gold for elegance */
        }

        .logo-container img {
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
        }

        .voting-table {
            width: 100%;
            margin-top: 15px;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
        }

        .voting-table th, .voting-table td {
            padding: 15px;
            text-align: center;
            font-size: 16px;
            border-bottom: 1px solid #ddd;
        }

        .voting-table th {
            background: #1E90FF; /* Deep Sky Blue for headers */
            color: #black;
            font-weight: bold;
        }

        .voting-table td {
            color: black;
        }

        .symbol-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }

        .submit-button {
            margin-top: 20px;
            padding: 12px 20px;
            font-size: 18px;
            font-weight: bold;
            color:ffff ;
            background:#4169E1; /* Steel Blue */
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .footer {
      width: 100%;
      background: linear-gradient(135deg, #A7C7E7, #B5D8E9); /* Soft light blue gradient */
      color: #333;
      text-align: center;
      padding: 30px;
      font-size: 1rem;
      font-weight: bold;
      margin-top: auto; /* Pushes the footer to the bottom */
    }

        /* Responsive Styles */
        @media (max-width: 768px) {
            h1 {
                font-size: 1.6rem;
            }

            .voting-table th, .voting-table td {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        VOTECONNECT
    </div>

    <div class="container">
        <h1>Head Girl </h1>

        <form action="" method="post">
            <table class="voting-table">
                <thead>
                    <tr>
                        <th>Candidate Name</th>
                        <th>Symbol</th>
                        <th>Vote</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "
                            <tr>
                                <td>{$row['candidate_name']}</td>
                                <td><img src='{$row['candidate_symbol']}' alt='{$row['candidate_name']} Symbol' class='symbol-image'></td>
                                <td><input type='radio' name='vote' value='{$row['id']}' required></td>
                            </tr>
                            ";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No candidates found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <button type="submit" class="submit-button">Submit</button>
        </form>
    </div>

    <!-- Footer Section -->
    <div class="footer">
        <p> VoteConnect 2024® - All Rights Reserved.</p>
    </div>
</body>
</html> 