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
                alert('Vote successfully submitted!');
                window.location.href = 'culturalshead.php'; // Redirect to the next voting page
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

// Fetch Sports Head candidates
$sql = "SELECT id, candidate_name, candidate_symbol FROM candidates WHERE position = 'sportshead'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vote for Sports Head</title>
  <style>
    /* General styles */
    body {
      font-family: Arial, sans-serif;
      background-size: cover;
      background-image: linear-gradient(to right, #74ebd5, #acb6e5);
      background-position: center;
      background-repeat: no-repeat;
      color: #ffffff;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
      flex-direction: column;
    }

    /* Header styling */
  /* Header styling */
.header {
  width: 100%;
  text-align: center;
  padding: 20px;
  font-size: 2rem;
  font-weight: bold;
  color: #333; /* Solid color */
  background: none; /* Removed gradient */
  margin-bottom: 30px; /* Added margin for spacing */
}

/* Sports Head Title Styling */
h1 {
  font-size: 2rem; /* Increase font size for better visibility */
  font-weight: bold;
  color: #333; /* Ensure color is set */
  margin-bottom: 20px; /* Add space below the title */
  text-align: center;
}
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


    /* Voting container */
    .voting-container {
      width: 80%;
      max-width: 600px;
      background-color: white; 
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
      text-align: center;
      margin-bottom: 40px;
    }

    /* Voting table */
    .voting-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
      background-color: #f9f9f9;
      color: #000;
      border-radius: 5px;
      overflow: hidden;
    }

    .voting-table th, .voting-table td {
      border: 1px solid #ccc;
      padding: 15px;
      text-align: center;
    }

    .voting-table th {
      background: #1E90FF;
      color: white;
      font-size: 1rem;
    }

    .voting-table td {
      font-size: 0.9rem;
    }

    .symbol-image {
      width: 50px;
      height: 50px;
      object-fit: contain;
    }

    /* Submit button */
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

    /* Footer styling */
    .footer {
      width: 100%;
      background: linear-gradient(135deg, #A7C7E7, #B5D8E9); 
      color: #333;
      text-align: center;
      padding: 30px;
      font-size: 1rem;
      font-weight: bold;
      margin-top: auto;
    }

    /* Responsive design */
    @media (max-width: 600px) {
      .voting-container {
        width: 90%;
        padding: 15px;
      }
      .header {
        font-size: 1.5rem;
      }
      .voting-table th, .voting-table td {
        font-size: 0.8rem;
      }
      .symbol-image {
        width: 40px;
        height: 40px;
      }
      .submit-button {
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>
<div class="header">
    VOTECONNECT
</div>
<div class="voting-container">
    <h1>Sports Head</h1>
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
                    <td><img src='{$row['candidate_symbol']}' alt='{$row['candidate_name']} Symbol' class='symbol-image'></td>
                    <td><input type='radio' name='vote' value='{$row['id']}' required></td>
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
