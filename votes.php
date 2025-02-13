<?php
// Database connection
$servername = "localhost";
$username = "root";  // Your database username
$password = "";      // Your database password
$dbname = "school";  // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch candidate votes
$sql = "SELECT candidate_name, candidate_position, votes FROM votes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Votes</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      color: #333;
      padding: 20px;
    }

    h1 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin: 20px auto;
      max-width: 600px;
    }

    table th, table td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: center;
    }

    table th {
      background-color: #333;
      color: white;
      text-transform: uppercase;
    }

    table tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    .back-link {
      display: block;
      margin: 20px auto;
      text-align: center;
      color: #00bfff;
      text-decoration: none;
      font-size: 1.2rem;
      font-weight: bold;
    }

    .back-link:hover {
      color: #005f99;
    }
  </style>
</head>
<body>
  <h1>Voting Results</h1>

  <table>
    <thead>
      <tr>
        <th>Candidate Name</th>
        <th>Position</th>
        <th>Votes</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Check if any results were returned from the database
      if ($result->num_rows > 0) {
          // Output each row of the results
          while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . htmlspecialchars($row['candidate_name']) . "</td>";
              echo "<td>" . htmlspecialchars($row['candidate_position']) . "</td>";
              echo "<td>" . htmlspecialchars($row['votes']) . "</td>";
              echo "</tr>";
          }
      } else {
          echo "<tr><td colspan='3'>No votes recorded yet.</td></tr>";
      }
      ?>
    </tbody>
  </table>

  <a href="admin_panel.html" class="back-link">Back to Admin Panel</a>

</body>
</html>

<?php
// Close database connection
$conn->close();
?>
