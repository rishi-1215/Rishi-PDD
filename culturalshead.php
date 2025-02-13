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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedCandidate = $_POST['vote'] ?? null;

    if ($selectedCandidate) {
        // Update the votes for the selected candidate
        $sql = "UPDATE candidates SET votes = votes + 1 WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $selectedCandidate);

        if ($stmt->execute()) {
            echo "
            <script>
                alert('Your vote has been successfully submitted. Thank you!');
                setTimeout(function() {
                    window.location.href = 'index.html';
                }, 2000); // Redirect after 2 seconds
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

// Fetch Culturals Head candidates
$sql = "SELECT id, candidate_name, candidate_symbol FROM candidates WHERE position = 'culturalshead'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Culturals Head</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #74ebd5, #acb6e5); /* Gradient blue background */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #ffff;
            flex-direction: column;
        }

        /* Header Styling */
        .header {
            width: 100%;
            background: linear-gradient(135deg, #A7C7E7, #B5D8E9); /* Soft light blue gradient */
            color: #333;
            text-align: center;
            padding: 20px;
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 30px; /* Gap between header and container */
            position: relative; /* This is important for positioning the logout button */
        }

        /* Logout Button */
        .logout-btn {
            position: absolute;
            right: 20px; /* Position the button at the right */
            top: 50%;
            transform: translateY(-50%); /* Center it vertically */
            padding: 8px 15px;
            background-color: #ADD8E6; /* Light Blue */
            color: black;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .logout-btn:hover {
            background-color: #87CEEB; /* Lighter Blue when hovered */
        }

        .container {
            background-color: white;
            padding: 20px;
            width: 500px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.6);
        }
        .container h1 {
            text-align: center;
            font-size: 26px;
            margin-bottom: 20px;
            text-transform: none;
            color: black;
        }

        .voting-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            color: #333;
            border-radius: 5px;
            overflow: hidden;
        }

        .voting-table th, .voting-table td {
            border: 1px solid #aaa;
            padding: 10px;
            text-align: center;
        }

        .voting-table th {
            background-color: #1E90FF;
            color: white;
            font-weight: bold;
            text-transform:none;
        }

        .symbol-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .symbol-image {
            width: 50px;
            height: 50px;
            object-fit: contain;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center; /* Centers the button horizontally */
        }

        .submit-button {
            margin-top: 20px;
            padding: 12px 20px;
            font-size: 18px;
            font-weight: bold;
            color: #ffff;
            background: #4169E1; /* Steel Blue */
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .submit-button:disabled {
            background-color: #555;
            cursor: not-allowed;
        }

        /* Footer styling */
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

        @media (max-width: 600px) {
            .container {
                width: 90%;
                padding: 15px;
            }

            .voting-table th, .voting-table td {
                font-size: 0.9rem;
                padding: 8px;
            }

            .symbol-image {
                width: 40px;
                height: 40px;
            }

            .submit-button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header">
        VOTECONNECT
        <!-- Logout Button -->
        <a href="index.html" class="logout-btn">Logout</a>
    </div>

    <div class="container">
        <h1>Culturals Head</h1>
        <form method="post">
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
                                <td class='symbol-container'>
                                    <img src='{$row['candidate_symbol']}' alt='{$row['candidate_name']} Symbol' class='symbol-image'>
                                </td>
                                <td>
                                    <input type='radio' name='vote' value='{$row['id']}' required>
                                </td>
                            </tr>
                            ";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No candidates available</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <button type="submit" class="submit-button">Submit</button>
        </form>
    </div>

    <!-- Footer Section -->
    <div class="footer">
        <p>VoteConnect 2024® - All Rights Reserved.</p>
    </div>

</body>
</html>
