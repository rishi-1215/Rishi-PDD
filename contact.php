<?php
// Database connection
$servername = "localhost";
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "school";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Define variables and initialize with empty values
$name = $email = $message = "";
$thankYouMessage = $errorMessage = "";

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Prepare and bind the SQL query to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    // Execute the query and check if it was successful
    if ($stmt->execute()) {
        // Set the flag for thank you message
        $thankYouMessage = "Thank you for reaching out! We’ll get back to you soon.";
    } else {
        $errorMessage = "There was an error submitting your message.";
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us - VoteConnect</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Montserrat:wght@500;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #f4f7fc;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 700px;
      margin: 50px auto;
      padding: 25px;
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
      text-align: center;
      position: relative;
    }

    .container::before {
      content: "";
      position: absolute;
      top: -10px;
      left: -10px;
      right: -10px;
      bottom: -10px;
      background: skyblue;
      z-index: -1;
      border-radius: 20px;
    }

    h1 {
      font-size: 2rem;
      color: #333;
      font-weight: 700;
      margin-bottom: 20px;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
      text-align: left;
    }

    label {
      font-size: 14px;
      font-weight: 600;
      color: #333;
    }

    input, textarea {
      padding: 12px;
      font-size: 14px;
      border: 2px solid #ccc;
      border-radius: 8px;
      transition: all 0.3s ease;
    }

    input:focus, textarea:focus {
      border-color: #ff6b6b;
      box-shadow: 0 0 10px rgba(255, 107, 107, 0.5);
      outline: none;
    }

    textarea {
      resize: none;
    }

    button {
      padding: 12px;
      background-color: #73e4d7;
      color: #fff;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    button:hover {
      background-color: #00d9ff;
      transform: scale(1.05);
    }

    .thank-you-message {
      display: none;
      color: #4caf50;
      font-size: 18px;
      font-weight: 600;
      margin-top: 20px;
    }

    .footer {
      background: linear-gradient(135deg, #A7C7E7, #B5D8E9);
      color: #333;
      text-align: center;
      padding: 20px;
      font-size: 1rem;
      font-weight: bold;
      margin-top: 30px;
    }

    .footer a {
      color: #000;
      text-decoration: none;
    }

    .footer a:hover {
      text-decoration: underline;
    }

    .error-message {
      color: red;
      font-weight: bold;
      margin-top: 10px;
    }

    @media (max-width: 768px) {
      .container {
        margin: 20px auto;
        padding: 15px;
      }

      h1 {
        font-size: 1.8rem;
      }

      input, textarea, button {
        font-size: 14px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Get In Touch</h1>

    <?php if ($thankYouMessage): ?>
      <div id="thankYouMessage" class="thank-you-message">
        <?php echo $thankYouMessage; ?>
      </div>
    <?php endif; ?>

    <?php if ($errorMessage): ?>
      <div class="error-message">
        <?php echo $errorMessage; ?>
      </div>
    <?php endif; ?>

    <!-- Contact Form -->
    <form id="contactForm" method="POST" action="contact.php" onsubmit="return validateEmail();">
      <label for="name">Your Name</label>
      <input type="text" id="name" name="name" placeholder="Enter your name" required value="<?php echo htmlspecialchars($name); ?>">

      <label for="email">Your Email</label>
      <input type="email" id="email" name="email" placeholder="Enter your email" required value="<?php echo htmlspecialchars($email); ?>">

      <label for="message">Message</label>
      <textarea id="message" name="message" rows="5" placeholder="Type your message here..." required><?php echo htmlspecialchars($message); ?></textarea>

      <button type="submit">Send Message</button>
    </form>
  </div>

  <div class="footer">
    VoteConnect 2024® - All Rights Reserved | <a href="about.html">About Us</a>
  </div>

  <script>
    function validateEmail() {
      var email = document.getElementById('email').value;
      var errorMessage = document.querySelector('.error-message');

      // Check if email ends with @gmail.com
      if (!email.endsWith('@gmail.com')) {
        errorMessage.innerHTML = "Please enter a valid Gmail address.";
        return false;
      }
      return true;
    }

    function showThankYouMessage() {
      const form = document.getElementById('contactForm');
      const thankYouMessage = document.getElementById('thankYouMessage');
      thankYouMessage.style.display = 'block';
      form.style.display = 'none';

      setTimeout(function() {
        window.location.href = 'index.html'; // Redirect to index.html after 2 seconds
      }, 2000);
    }
  </script>
</body>
</html>
