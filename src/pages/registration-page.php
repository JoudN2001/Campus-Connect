<?php
// 1. Include your database connection and models
require_once '../../config/db.php';
require_once '../../includes/events-model.php';

$success_message = "";
$submitted_data = [];

// 2. Retrieve dynamic events data for the select dropdown
$eventsList = getEventsData($conn);

// 3. Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Sanitize form data
    $full_name = htmlspecialchars($_POST['full-name'] ?? '');
    $student_id = htmlspecialchars($_POST['student-id'] ?? '');
    $university_email = htmlspecialchars($_POST['university-email'] ?? '');
    $additional_comments = htmlspecialchars($_POST['additional-comments'] ?? '');

    // Handle the multiple select array for events
    $events = $_POST['event-selection'] ?? [];
    $events_string = htmlspecialchars(implode(", ", $events));

    // 4. DATABASE INSERTION LOGIC
    // Using the columns defined in your setup.php for the registrations table
    $date_applied = date('Y-m-d H:i:s');
    $status = 'Pending';
    $avatar = 'https://i.pravatar.cc/150?img=' . rand(1, 70); // Random avatar to match your dummy data style

    $sql = "INSERT INTO registrations (student_name, event_name, date_applied, status, avatar) VALUES (?, ?, ?, ?, ?)";
    
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssss", $full_name, $events_string, $date_applied, $status, $avatar);
        
        if (mysqli_stmt_execute($stmt)) {
            // Set the success message and store data to echo back to the user
            $success_message = "Message sent! Your registration has been successfully received.";
            
            // Store fields to echo below the form
            $submitted_data = [
                'Full Name' => $full_name,
                'Student ID' => $student_id,
                'Email' => $university_email,
                'Events Selected' => $events_string,
                'Comments' => $additional_comments
            ];
        } else {
            $success_message = "Error: Could not complete registration.";
        }
        mysqli_stmt_close($stmt);
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../stylesheet/normaliz.css" />
    <link rel="stylesheet" href="../stylesheet/global.css" />
    <link rel="stylesheet" href="../stylesheet/registration-page.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    />
    <title>Registration</title>
    <style>
      .success-banner {
        background-color: #d4edda;
        color: #155724;
        padding: 20px;
        margin-top: 30px;
        border-radius: 8px;
        border: 1px solid #c3e6cb;
      }
      .success-banner h3 { margin-top: 0; display: flex; align-items: center; gap: 8px; }
      .success-banner ul { list-style-type: none; padding: 0; margin-top: 15px; }
      .success-banner li { margin-bottom: 8px; font-size: 14px; }
    </style>
  </head>
<body>
    <header class="header">
      <a href="./home-page.php" class="logo">
        <h1>CampusConnect</h1>
      </a>
        
      <nav>
        <ul class="nav-links">
          <li><a href="./home-page.php">Home</a></li>
          <li><a href="./events-page.php">Events</a></li>
          <li><a href="./registration-page.php" class="active">Registration</a></li>
          <li><a href="./contact-page.php">Contact</a></li>
        </ul>
      </nav>

      <div class="nav-btns">
        <button class="profile-btn" aria-label="User Profile">
          <a href="./admin/dashboard.php">
            <span class="material-symbols-outlined">account_circle</span>
          </a>
        </button>
        <button class="sign-in-btn">
          <a href="./admin/dashboard.php">Sign In</a>
        </button>
      </div>
    </header>
    
    <main>
      <section class="registration-card">
        <h2>Event Registration</h2>
        <p class="subtitle">Fill out the form below to secure your spot at upcoming campus events.</p>

        <form action="" method="POST">
          <div class="form-group">
            <label for="full-name">Full Name</label>
            <input type="text" id="full-name" name="full-name" placeholder="John Doe" required />
          </div>

          <div class="form-group">
            <label for="student-id">Student ID (8 digits)</label>
            <input type="text" id="student-id" name="student-id"  placeholder="12345678" required />
          </div>

          <div class="form-group">
            <label for="university-email">University Email</label>
            <input type="email" id="university-email" name="university-email" placeholder="john.doe@gmail.com" required />
          </div>

          <div class="form-group">
            <label for="event-selection">Event Selection</label>
            <select id="event-selection" name="event-selection[]" multiple required>
              <?php if (!empty($eventsList)): ?>
                <?php foreach ($eventsList as $event): ?>
                  <option value="<?php echo htmlspecialchars($event['title']); ?>">
                    <?php echo htmlspecialchars($event['title']); ?>
                  </option>
                <?php endforeach; ?>
              <?php else: ?>
                <option value="" disabled>No events currently available</option>
              <?php endif; ?>
            </select>
            <small class="help-text">Hold Ctrl/Cmd to select multiple events.</small>
          </div>

          <div class="form-group">
            <label for="additional-comments">Additional Comments</label>
            <textarea id="additional-comments" name="additional-comments" placeholder="Dietary requirements, accessibility needs, etc."></textarea>
          </div>

          <div class="form-actions">
            <button type="submit" class="submit-btn">Submit Registration</button>
            <button type="reset" class="reset-btn">Reset Form</button>
          </div>
        </form>

        <?php if (!empty($success_message) && !empty($submitted_data)): ?>
          <div class="success-banner">
            <h3><span class="material-symbols-outlined">check_circle</span> <?php echo $success_message; ?></h3>
            <hr style="border-top: 1px solid #c3e6cb; margin: 15px 0;">
            <h4>Your Confirmed Details:</h4>
            <ul>
              <?php foreach ($submitted_data as $key => $value): ?>
                <li><strong><?php echo $key; ?>:</strong> <?php echo !empty($value) ? $value : '<em>None</em>'; ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>

      </section>
    </main>
    
    <footer class="footer">
      <div class="footer-left">
        <h2 class="footer-logo">CampusConnect</h2>
        <p>&copy; 2026 CampusConnect University. All rights reserved.</p>
      </div>
      <nav class="footer-nav">
        <ul>
          <li><a href="#">Privacy Policy</a></li>
          <li><a href="#">Terms of Service</a></li>
          <li><a href="#">Campus Map</a></li>
          <li><a href="#">Directory</a></li>
        </ul>
      </nav>
    </footer>
    
  </body>
</html>