<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  <style>
    /* General Styles */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Arial', sans-serif;
      background: url('uploads/candidates.jpg') no-repeat center center fixed;
      background-size: cover;
      color: #333;
    }

    /* Navbar Styles */
    .navbar {
      background: linear-gradient(135deg, #A7C7E7, #B5D8E9);
      color: black;
      padding: 10px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .navbar h1 {
      margin: 0;
      font-size: 2rem;
      font-weight: bold;
      text-align: center;
      flex: 1;
      margin-left: 50px;
    }

    .navbar .right {
      display: flex;
      gap: 20px;
    }

    .navbar a {
      color: black;
      text-decoration: none;
      padding: 8px 15px;
      border-radius: 5px;
      transition: background-color 0.3s ease;
      font-weight: bold;
    }

    .navbar a:hover {
      background-color: #007bff;
    }

    /* Main Container */
    .container {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: calc(100vh - 60px);
      padding: 20px;
    }

    /* Form Styles */
    form {
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
      margin-bottom: 20px;
    }

    form h2 {
      margin-bottom: 20px;
      font-size: 1.5rem;
      color: #004085;
    }

    form label {
      font-weight: bold;
      display: block;
      margin-bottom: 8px;
      color: #333;
    }

    form input,
    form select,
    form button {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 1rem;
    }

    form input:focus,
    form select:focus {
      outline: none;
      border-color: #007bff;
    }

    form button {
      background-color: #004085;
      color: #fff;
      font-size: 1rem;
      font-weight: bold;
      cursor: pointer;
      border: none;
      transition: background-color 0.3s ease;
    }

    form button:hover {
      background-color: #007bff;
    }

    /* Footer Styles */
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

    .footer a {
      color: #007bff;
      text-decoration: none;
    }

    .footer a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="navbar">
    <h1>VOTECONNECT</h1>
    <div class="right">
      <a href="admin.html">Home</a>
      <a href="candidate.php">Candidates</a>
      <a href="view_votes.php">View Votes</a>
    </div>
  </div>

  <div class="container">
    <!-- Add Candidate Form -->
    <form action="" method="post" enctype="multipart/form-data">
      <h2>Add New Candidate</h2>
      <label for="candidateName">Candidate Name:</label>
      <input type="text" id="candidateName" name="candidateName" required>

      <label for="candidatePosition">Position:</label>
      <select id="candidatePosition" name="candidatePosition" required>
        <option value="" disabled selected>Select Position</option>
        <option value="headboy">Head Boy</option>
        <option value="headgirl">Head Girl</option>
        <option value="sportshead">Sports Head</option>
        <option value="culturalshead">Culturals Head</option>
      </select>

      <label for="candidateSymbol">Candidate Symbol (Image):</label>
      <input type="file" id="candidateSymbol" name="candidateSymbol" accept="image/*" required>

      <button type="submit" name="addCandidate">Add Candidate</button>
    </form>

    <!-- Delete Candidate Form -->
    <form action="" method="post">
      <h2>Delete Candidate(s)</h2>
      <label for="candidateList">Select Candidates:</label>
      <select id="candidateList" name="candidateList[]" multiple required>
        <?php
        include 'backend/db_connection.php'; // Database connection
        $sql = "SELECT id, candidate_name, position FROM candidates";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "'>" . $row['candidate_name'] . " (" . $row['position'] . ")</option>";
          }
        } else {
          echo "<option value='' disabled>No candidates available</option>";
        }
        ?>
      </select>
      <button type="submit" name="deleteCandidate">Delete Selected Candidates</button>
    </form>
  </div>

  <div class="footer">
    VoteConnect 2024® - All Rights Reserved | <a href="about.html">About Us</a>
  </div>

  <?php
  if (isset($_POST['addCandidate'])) {
    $name = $_POST['candidateName'];
    $position = $_POST['candidatePosition'];
    $symbol = $_FILES['candidateSymbol']['name'];
    $symbolTmp = $_FILES['candidateSymbol']['tmp_name'];
    $uploadPath = "uploads/" . basename($symbol);

    if (move_uploaded_file($symbolTmp, $uploadPath)) {
      $sql = "INSERT INTO candidates (candidate_name, candidate_symbol, position) VALUES ('$name', '$uploadPath', '$position')";
      if ($conn->query($sql)) {
        echo "<script>alert('Candidate added successfully!');</script>";
      } else {
        echo "<script>alert('Error adding candidate.');</script>";
      }
    }
  }

  if (isset($_POST['deleteCandidate'])) {
    $ids = $_POST['candidateList'];
    foreach ($ids as $id) {
      $sql = "DELETE FROM candidates WHERE id=$id";
      if (!$conn->query($sql)) {
        echo "<script>alert('Error deleting candidate with ID: $id');</script>";
      }
    }
    echo "<script>alert('Selected candidates deleted successfully!');</script>";
  }

  $conn->close();
  ?>
</body>
</html>
