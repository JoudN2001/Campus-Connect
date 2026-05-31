<?php
// Include your existing database connection and events model
require_once '../../config/db.php';
require_once '../../includes/events-model.php';


$allEvents = getEventsData($conn);


$featuredEvents = array_slice($allEvents, 0, 3);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    />

    <link rel="stylesheet" href="../stylesheet/global.css" />
    <link rel="stylesheet" href="../stylesheet/home-page.css" />

    <title>Home | CampusConnect</title>
  </head>

  <body>
    <header class="header">
      <a href="./home-page.php" class="logo-link">
        <h1>CampusConnect</h1>
      </a>

      <nav>
        <ul class="nav-links">
          <li><a href="./home-page.php" class="active">Home</a></li>
          <li><a href="./events-page.php">Events</a></li>
          <li><a href="./registration-page.php">Registration</a></li>
          <li><a href="./contact-page.php">Contact</a></li>
        </ul>
      </nav>

      <div class="nav-btns">
        <a href="./admin/dashboard.php" class="profile-btn">
          <span class="material-symbols-outlined"> account_circle </span>
        </a>
        <a href="./admin/dashboard.php" class="sign-in-btn">Sign In</a>
      </div>
    </header> 

    <section class="hero">
      <div class="container hero-content">
        <h1>Connect with<br>Your <span>Campus</span><br>Community</h1>
        <p>
          Your gateway to scholarly pursuits, professional<br>networks, and the
          vibrant heartbeat of university life.
        </p>
        <div class="hero-buttons">
          <a href="./events-page.php" class="btn btn-primary">Browse Events</a>
          <a href="./events-page.php" class="btn btn-outline">View Calendar</a>
        </div>
      </div>
    </section>

    <section class="about">
      <div class="container about-grid">
        <div class="about-card">
          <div class="icon-wrapper">
            <span class="material-symbols-outlined">search</span>
          </div>
          <h3>Discover</h3>
          <p>
            Explore a curated selection of academic forums, workshops, and
            social gatherings tailored to your interests.
          </p>
        </div>

        <div class="about-card feature-highlight">
          <div class="icon-wrapper">
            <span class="material-symbols-outlined">edit_calendar</span>
          </div>
          <h3>Register</h3>
          <p>
            Seamlessly secure your spot at exclusive university events with our
            streamlined verification system.
          </p>
        </div>

        <div class="about-card">
          <div class="icon-wrapper">
            <span class="material-symbols-outlined">groups</span>
          </div>
          <h3>Connect</h3>
          <p>
            Build lasting relationships with peers, alumni, and faculty through
            collaborative networking sessions.
          </p>
        </div>
      </div>
    </section>

    <section class="services section-padding">
      <div class="container">
        <div class="section-header">
          <div class="header-titles">
            <span class="overline">Curation</span>
            <h2>Featured Events</h2>
          </div>
          <a href="./events-page.php" class="see-all-link">
            See All Events <span class="material-symbols-outlined">arrow_forward</span>
          </a>
        </div>

        <div class="services-grid">
          <?php if (!empty($featuredEvents)): ?>
            <?php foreach ($featuredEvents as $event): ?>
              <article class="service-card">
                <div class="service-image-container">
                  <span class="service-category"><?php echo htmlspecialchars($event['category']); ?></span>
                  <img
                    src="<?php echo htmlspecialchars($event['image']); ?>"
                    alt="<?php echo htmlspecialchars($event['title']); ?>"
                    class="service-image"
                  />
                </div>
                <div class="service-content">
                  <div class="service-date">
                    <span class="material-symbols-outlined" style="font-size: 16px;">calendar_today</span> 
                    <?php echo date('M d, Y', strtotime($event['event_date'])); ?>
                  </div>
                  <h3><?php echo htmlspecialchars($event['title']); ?></h3>
                  <p>
                    <?php 
                    // Limit description length for a cleaner card layout
                    $description = htmlspecialchars($event['description']);
                    echo strlen($description) > 100 ? substr($description, 0, 100) . '...' : $description; 
                    ?>
                  </p>
                  <button
                    class="service-btn"
                    onclick="window.location.href = './registration-page.php?id=<?php echo $event['id']; ?>'"
                  >
                    Learn More
                  </button>
                </div>
              </article>
            <?php endforeach; ?>
          <?php else: ?>
            <p>No featured events available at the moment.</p>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <section class="contact section-padding">
      <div class="container">
        <div class="contact-wrapper">
          <div class="contact-info">
            <h3>Join the Community</h3>
            <p>
              Stay updated with the latest campus events, academic
              opportunities, and student life highlights.
            </p>
          </div>
          <div class="contact-form">
            <form method="POST" action="">
              <input
                type="email"
                id="email"
                name="email"
                class="form-control"
                placeholder="Your University Email"
                autocomplete="email"
                required
              />
              <button type="submit" class="btn-subscribe">Subscribe</button>
            </form>
          </div>
        </div>
      </div>
    </section>

    <footer class="footer">
      <div class="container footer-container">
        <div class="footer-left">
          <h2 class="footer-logo">CampusConnect</h2>
          <p class="footer-copyright">
            &copy; 2026 CampusConnect University. All rights reserved.
          </p>
        </div>

        <div class="footer-right">
          <ul class="footer-links">
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms of Service</a></li>
            <li><a href="#">Campus Map</a></li>
            <li><a href="#">Directory</a></li>
          </ul>
        </div>
      </div>
    </footer>
  </body>
</html>