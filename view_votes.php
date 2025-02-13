<?php
// Database connection
$host = 'localhost';
$user = 'root'; // Change to your DB username
$password = ''; // Add your DB password
$database = 'school';

// Establish database connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL queries for each position
$sql_headboy = "
SELECT candidate_name, candidate_symbol, position, SUM(votes) AS total_votes 
FROM candidates 
WHERE position = 'headboy'
GROUP BY candidate_name, candidate_symbol
ORDER BY candidate_name;
";

$sql_headgirl = "
SELECT candidate_name, candidate_symbol, position, SUM(votes) AS total_votes 
FROM candidates 
WHERE position = 'headgirl'
GROUP BY candidate_name, candidate_symbol
ORDER BY candidate_name;
";

$sql_sports_head = "
SELECT candidate_name, candidate_symbol, position, SUM(votes) AS total_votes 
FROM candidates 
WHERE position = 'sportshead'
GROUP BY candidate_name, candidate_symbol
ORDER BY candidate_name;
";

$sql_culturals_head = "
SELECT candidate_name, candidate_symbol, position, SUM(votes) AS total_votes 
FROM candidates 
WHERE position = 'culturalshead'
GROUP BY candidate_name, candidate_symbol
ORDER BY candidate_name;
";

// Execute the queries
$result_headboy = $conn->query($sql_headboy);
$result_headgirl = $conn->query($sql_headgirl);
$result_sports_head = $conn->query($sql_sports_head);
$result_culturals_head = $conn->query($sql_culturals_head);

// Fetch data for each position
$data_headboy = $result_headboy->fetch_all(MYSQLI_ASSOC);
$data_headgirl = $result_headgirl->fetch_all(MYSQLI_ASSOC);
$data_sports_head = $result_sports_head->fetch_all(MYSQLI_ASSOC);
$data_culturals_head = $result_culturals_head->fetch_all(MYSQLI_ASSOC);

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote Results</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #42a5f5, #1e88e5);
            margin: 0;
            padding: 0;
            height: 100%;
            color: #333;
        }

        .container {
    background-color: rgba(255, 255, 255, 0.95);
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
    max-width: 900px;
    margin: 40px auto;
    text-align: center;
    position: relative; /* Needed for pseudo-elements */
}

.container::before, .container::after {
    content: '';
    position: absolute;
    background: url('uploads/result.png') no-repeat;
    background-size: 100px 100px; /* Increased size */
    width: 100px; /* Match the size of the image */
    height: 100px;
    opacity: 0.8; /* Optional: Slight transparency for subtlety */
}

.container::before {
    top: -40px; /* Adjust for larger size */
    left: -40px;
}

.container::after {
    bottom: -40px; /* Adjust for larger size */
    right: -40px;
}


        h1 {
            font-size: 2.5em;
            color: #007bff;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 1.8em;
            margin-bottom: 15px;
            color: #333;
        }

        .results {
            margin-top: 30px;
        }

        table {
            width: 100%;
            margin-bottom: 40px;
            border-radius: 8px;
            overflow: hidden;
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        th, td {
            padding: 15px;
            text-align: center;
            border: none;
            font-size: 1.1em;
        }

        th {
            background-color: #007bff;
            color: white;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .votes {
            color: #4caf50;
            font-weight: 600;
        }

        button {
    background-color: #007bff;
    color: white;
    padding: 10px 20px; /* Reduced padding */
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 1em; /* Reduced font size */
    transition: background-color 0.3s ease;
    width: auto; /* Allow the button to adjust to its content */
    margin-top: 20px; /* Reduced margin-top */
}

button:hover {
    background-color: #0056b3;
}


        img {
            height: 40px;
            width: auto;
            vertical-align: middle;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .container {
                width: 90%;
                padding: 20px;
            }

            h1 {
                font-size: 2em;
            }

            table {
                font-size: 1em;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 1.6em;
            }

            h2 {
                font-size: 1.4em;
            }

            table {
                font-size: 0.9em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Election Results</h1>

        <div class="results">
            <!-- Headboy Results -->
            <h2>Headboy</h2>
            <table>
                <tr>
                    <th>Candidate Name</th>
                    <th>Candidate Symbol</th>
                    <th>Total Votes</th>
                </tr>
                <?php
                if (!empty($data_headboy)) {
                    foreach ($data_headboy as $item) {
                        echo "
                        <tr>
                            <td>{$item['candidate_name']}</td>
                            <td><img src='{$item['candidate_symbol']}' alt='Symbol'></td>
                            <td class='votes'>{$item['total_votes']} Votes</td>
                        </tr>
                        ";
                    }
                } else {
                    echo "<tr><td colspan='3'>No results found for Headboy</td></tr>";
                }
                ?>
            </table>

            <!-- Headgirl Results -->
            <h2>Headgirl</h2>
            <table>
                <tr>
                    <th>Candidate Name</th>
                    <th>Candidate Symbol</th>
                    <th>Total Votes</th>
                </tr>
                <?php
                if (!empty($data_headgirl)) {
                    foreach ($data_headgirl as $item) {
                        echo "
                        <tr>
                            <td>{$item['candidate_name']}</td>
                            <td><img src='{$item['candidate_symbol']}' alt='Symbol'></td>
                            <td class='votes'>{$item['total_votes']} Votes</td>
                        </tr>
                        ";
                    }
                } else {
                    echo "<tr><td colspan='3'>No results found for Headgirl</td></tr>";
                }
                ?>
            </table>

            <!-- Sports Head Results -->
            <h2>Sports Head</h2>
            <table>
                <tr>
                    <th>Candidate Name</th>
                    <th>Candidate Symbol</th>
                    <th>Total Votes</th>
                </tr>
                <?php
                if (!empty($data_sports_head)) {
                    foreach ($data_sports_head as $item) {
                        echo "
                        <tr>
                            <td>{$item['candidate_name']}</td>
                            <td><img src='{$item['candidate_symbol']}' alt='Symbol'></td>
                            <td class='votes'>{$item['total_votes']} Votes</td>
                        </tr>
                        ";
                    }
                } else {
                    echo "<tr><td colspan='3'>No results found for Sports Head</td></tr>";
                }
                ?>
            </table>

            <!-- Culturals Head Results -->
            <h2>Culturals Head</h2>
            <table>
                <tr>
                    <th>Candidate Name</th>
                    <th>Candidate Symbol</th>
                    <th>Total Votes</th>
                </tr>
                <?php
                if (!empty($data_culturals_head)) {
                    foreach ($data_culturals_head as $item) {
                        echo "
                        <tr>
                            <td>{$item['candidate_name']}</td>
                            <td><img src='{$item['candidate_symbol']}' alt='Symbol'></td>
                            <td class='votes'>{$item['total_votes']} Votes</td>
                        </tr>
                        ";
                    }
                } else {
                    echo "<tr><td colspan='3'>No results found for Culturals Head</td></tr>";
                }
                ?>
            </table>
        </div>

        <button onclick="window.location.href = 'admin.html';">Back to homepage</button>
    </div>
</body>
</html>
