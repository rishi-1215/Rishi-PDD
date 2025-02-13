<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us - VoteConnect</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Montserrat:wght@500;700&display=swap" rel="stylesheet">
  <style>
    /* Add your existing styles here */
  </style>
</head>
<body>
  <div class="container">
    <div class="icon">🗳️</div>
    <h1>Get In Touch</h1>
    <form id="contactForm" onsubmit="submitForm(event)">
      <label for="name">Your Name</label>
      <input type="text" id="name" name="name" placeholder="Enter your name" required>

      <label for="email">Your Email</label>
      <input type="email" id="email" name="email" placeholder="Enter your email" required>

      <label for="message">Message</label>
      <textarea id="message" name="message" rows="5" placeholder="Type your message here..." required></textarea>

      <button type="submit">Send Message</button>
    </form>
    <div id="thankYouMessage" class="thank-you-message" style="display: none;">
      Thank you for reaching out! We’ll get back to you soon.
    </div>
  </div>

  <div class="footer">
    VoteConnect 2024® - All Rights Reserved | <a href="about.html">About Us</a>
  </div>

  <script>
    function submitForm(event) {
      event.preventDefault();

      const form = document.getElementById('contactForm');
      const formData = new FormData(form);
      
      fetch('submit_contact.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.status === 'success') {
          form.style.display = 'none';
          document.getElementById('thankYouMessage').style.display = 'block';
        } else {
          alert(data.message);
        }
      })
      .catch(error => alert('Error submitting the form.'));
    }
  </script>
</body>
</html>
