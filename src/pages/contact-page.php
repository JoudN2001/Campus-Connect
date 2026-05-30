<?php 
require_once '../../config/db.php';
require_once '../../includes/events-model.php';

$messageStatus = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['full_name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Logic to save to DB or send email would go here
    $messageStatus = "Thank you, " . $name . "! Your message has been sent.";
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
    <link rel="stylesheet" href="../stylesheet/normaliz.css" />
    <link rel="stylesheet" href="../stylesheet/global.css" />
    <link rel="stylesheet" href="../stylesheet/contact-page.css" />
    <title>Contact</title>
  </head>

  <body>
    <header class="header">
      <a href="./home-page.php">
        <h1>Campus<span>Connect</span></h1>
      </a>
      <nav>
        <ul class="nav-links">
          <li><a href="./home-page.php">Home</a></li>
          <li><a href="./events-page.php">Events</a></li>
          <li><a href="./registration-page.php">Registration</a></li>
          <li><a href="./contact-page.php">Contact</a></li>
        </ul>
      </nav>
      <div class="nav-btns">
        <button><a href="./admin-page.php" style="color:white; text-decoration:none;">Sign In</a></button>
      </div>
    </header>

    <div class="img">
      <h1>Let's Connect.</h1>
      <p>If you have any questions or would like to get in touch, please feel free to reach out to us using the form below.</p>
    </div>

    <div class="contact-container">
      <div class="contact-form">
        <div class="form-header">
          <h1>Send us a Message</h1>
          <p>Our team will get back to you as soon as possible.</p>
        </div>

        <form method="POST" action="">
          <div class="name-email-group">
            <div class="name-area">
              <label for="full-name">Full Name</label>
              <input type="text" id="full-name" name="full_name" required />
            </div>
            <div class="email-area">
              <label for="email">Email</label>
              <input type="email" id="email" name="email" required />
            </div>
          </div>

          <label for="subject">Subject</label>
          <select id="subject" name="subject">
            <option value="general">General Inquiry</option>
            <option value="events">Events</option>
            <option value="registration">Registration</option>
          </select>

          <label for="message">Message</label>
          <textarea id="message" name="message" required></textarea>

          <div class="form-btns">
            <button type="submit" class="submit-btn">Send Message</button>
            <button type="reset" class="clear-btn">Clear Form</button>
          </div>
        </form>
        
        <?php if (!empty($messageStatus)): ?>
            <p style="color: green; margin-top: 20px; font-weight: bold;"><?php echo $messageStatus; ?></p>
        <?php endif; ?>
      </div>

      <div class="info-container">
        <h1>Get in Touch</h1>
        <address class="address">
          <span class="material-symbols-outlined">location_on</span>
          <div class="addr-content">
            <h2>University Address</h2>
            <p>Jordan, Amman</p>
          </div>
        </address>

        <address class="phone">
          <span class="material-symbols-outlined">call</span>
          <div class="addr-content">
            <h2>Phone Support</h2>
            <p><a href="tel:+962782939517">+962 782 939 517</a></p>
          </div>
        </address>

        <div class="map">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3383.107666334865!2d35.929197281901125!3d32.01219710693435!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151b6037d70a02f5%3A0x422b60b0d9a86253!2sThe%20World%20Islamic%20Sciences%20and%20Education%20University!5e0!3m2!1sen!2sjo!4v1780176012886!5m2!1sen!2sjo" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>        </div>
      </div>
    </div>

    <div class="footer-container">
      <footer>
        <div class="left-footer">
          <div class="logo">CampusConnect</div>
          <p class="date">© 2026 CampusConnect. All rights reserved.</p>
        </div>

        <nav>
          <ul class="nav-links">
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms of Service</a></li>
            <li><a href="#">Campus Map</a></li>
            <li><a href="#">Directory</a></li>
          </ul>
        </nav>
      </footer>
    </div>
  </body>
</html>