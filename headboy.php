<?php
// database_config.php
$host = 'localhost';
$user = 'root'; // Change if your DB username is different
$password = ''; // Add your DB password
$database = 'school';

// Establish database connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch candidates
$sql = "SELECT id, candidate_name, position, candidate_symbol FROM candidates WHERE position = 'headboy'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vote for Head Boy</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    body {
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 0;
      background-image: linear-gradient(to right, #74ebd5, #acb6e5);
      color: #333;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      align-items: center;
      min-height: 100vh;
    }

    button {
      background-color: #4caf50;
      color: white;
      padding: 8px 15px;
    }

    .container {
      background: #fff;
      box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.15);
      border-radius: 10px;
      padding: 20px 40px;
      width: 90%;
      max-width: 700px;
      text-align: center;
      margin-top: 30px; /* Added margin-top for the gap */
    }

    h1 {
      font-size: 28px;
      margin-bottom: 20px;
      color: #444;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin: 20px 0;
      background-color: #ffffff;
      border: 1px solid #ddd;
      border-radius: 10px;
      overflow: hidden;
    }

    th,
    td {
      padding: 15px;
      text-align: center;
      border: 1px solid #ddd;
    }

    th {
      background: #1E90FF;
      color: white;
      font-size: 18px;
      text-transform: uppercase;
    }

    td {
      font-size: 16px;
      color: #333;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    tr:hover {
      background-color: #e8f1ff;
    }

    img {
      width: 50px;
      height: 50px;
      border-radius: 5px;
      object-fit: cover;
    }

    button {
      background-color: #4169E1;
      color: black;
      padding: 12px 20px;
      border: none;
      border-radius: 25px;
      font-size: 18px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease;
      margin-top: 20px;
    }

    @media (max-width: 768px) {
      th,
      td {
        font-size: 14px;
        padding: 10px;
      }

      h1 {
        font-size: 22px;
      }
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
    }

    /* Footer Styles */
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

  </style>
</head>

<body>
  <!-- Header -->
  <div class="header">
    VOTECONNECT
  </div>

  <div class="container">
    <h1> Head Boy</h1>
    <form action="backend/submit_vote.php" method="post">
      <table>
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
                  echo "<tr>
                      <td>{$row['candidate_name']}</td>
                      <td><img src='{$row['candidate_symbol']}' alt='{$row['candidate_name']} Symbol'></td>
                      <td><input type='radio' name='vote' value='{$row['id']}' required></td>
                  </tr>";
              }
          } else {
              echo "<tr><td colspan='3'>No candidates available</td></tr>";
          }
          ?>
        </tbody>
      </table>
      <button type="submit">Submit</button>
    </form>
  </div>

  <!-- Footer -->
  <div class="footer">
    VoteConnect 2024® - All Rights Reserved
  </div>

</body>

</html>

<?php
$conn->close();
?>