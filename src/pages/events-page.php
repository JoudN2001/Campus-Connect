<?php
require_once '../../config/db.php';
require_once '../../includes/events-model.php';

// Fetch data from your database model
$allEvents = getEventsData($conn);

// Initialize variables to prevent undefined warnings
$search = '';
$currentFilter = 'All';

// Search/filter logic
if (!empty($_GET['search'])) {
  $search = strtolower(trim($_GET['search']));
  $allEvents = array_filter($allEvents, fn($event) =>
    strpos(strtolower($event['title']), $search) !== false // Using 'title' from your DB
  );
}

if (!empty($_GET['filter'])) {
  $currentFilter = $_GET['filter'];
  if ($currentFilter != "All") {
    $allEvents = array_filter($allEvents, fn($event) =>
      $event['category'] == $currentFilter
    );
  }
}
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
    <link rel="stylesheet" href="../stylesheet/normaliz.css" />
    <link rel="stylesheet" href="../stylesheet/global.css" />
    <link rel="stylesheet" href="../stylesheet/events-page.css" />
    <title>Events</title>
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
        <button><a href="./admin/dashboard.php"> Sign In </a></button>
        <button>
          <a href="./admin-page.php">
            <span class="material-symbols-outlined"> account_circle </span>
          </a>
        </button>
      </div>
      </header>

    <div>
      <div class="advertising-card">
        <span class="title"> Events Highlights </span>
        <span>
          <h1>How to Participate in Campus Events</h1>
        </span>
        <span>
          <p>
            Join us to participate in exciting campus events and activities !
          </p>
        </span>
        <div>
          <button><a href="./events-page.php"> Reserve Now </a></button>
        </div>
      </div>
    </div>
    <div class="search-container">
      <div class="search-form">
        <form class="search-bar" method="get" action="events-page.php">
          <input type="search" name="search" placeholder="Search events by name" value="<?php echo htmlspecialchars($search); ?>" /> <br />
          <br />
          <button type="submit" class="search-btn">Search</button>
          
          <?php if($currentFilter !== 'All'): ?>
            <input type="hidden" name="filter" value="<?php echo htmlspecialchars($currentFilter); ?>">
          <?php endif; ?>
        </form>
      </div>

      <div class="filter-buttons">
        <a href="?filter=All<?php echo !empty($search) ? '&search='.urlencode($search) : ''; ?>"><button>All</button></a>
        <a href="?filter=Academic<?php echo !empty($search) ? '&search='.urlencode($search) : ''; ?>"><button>Academic</button></a>
        <a href="?filter=Technology<?php echo !empty($search) ? '&search='.urlencode($search) : ''; ?>"><button>Technology</button></a>
        <a href="?filter=Social<?php echo !empty($search) ? '&search='.urlencode($search) : ''; ?>"><button>Social</button></a>
        <a href="?filter=Sports<?php echo !empty($search) ? '&search='.urlencode($search) : ''; ?>"><button>Sports</button></a>
      </div>
      </div>
    <div class="events-cards">
      <div class="all-cards">
        <?php if (!empty($allEvents)): ?>
          <?php foreach($allEvents as $index => $event): ?>
            <div class="event-card">
              <img src="<?php echo htmlspecialchars($event['image'] ?? ''); ?>" alt="Event Image" />
              <span class="event-tag"><?php echo htmlspecialchars($event['category'] ?? ''); ?></span>
              <h3 class="event-title"><?php echo htmlspecialchars($event['title'] ?? ''); ?></h3>
              <p class="event-description"><?php echo htmlspecialchars($event['description'] ?? ''); ?></p>
              
              <a href="./registration-page.php?id=<?php echo htmlspecialchars($event['id'] ?? $index); ?>">
                <button class="event-button">Register now</button>
              </a>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
           <p style="text-align:center; width:100%; margin-top: 2rem;">No events found matching your criteria.</p>
        <?php endif; ?>
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