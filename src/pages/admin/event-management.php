<?php
require_once '../../../config/db.php';
require_once '../../../includes/events-model.php';

// Action On Event
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $id = (int)$_POST['event_id'];
    if ($_POST['action'] === 'delete') {
        mysqli_query($conn, "DELETE FROM events WHERE id = $id");
    }
    header("Location: events-management.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<pre>";
    print_r($_POST); 
    echo "</pre>";
    
    exit(); 
}

// Pagination
$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Search + Filter
$status_filter = isset($_GET['status']) ? $_GET['status'] : 'all';
$search_query = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

// Filter & Search Query
$where_sql = "WHERE 1=1";
if ($status_filter !== 'all') {
    $where_sql .= " AND status = '$status_filter'";
}
if ($search_query !== '') {
    $where_sql .= " AND (title LIKE '%$search_query%' OR location LIKE '%$search_query%' OR category LIKE '%$search_query%')";
}

// Pagination
$total_items = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM events $where_sql"))['total'];
$total_pages = ceil($total_items / $limit);

$data_query = "SELECT * FROM events $where_sql ORDER BY event_date DESC LIMIT $limit OFFSET $offset";
$events = mysqli_fetch_all(mysqli_query($conn, $data_query), MYSQLI_ASSOC);

$active_events_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM events WHERE status = 'Active'"))['count'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- GOOGLE ICONS -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- CSS EXTERNAL FILES -->
    <link rel="stylesheet" href="../../stylesheet/normaliz.css">
    <link rel="stylesheet" href="../../stylesheet/global.css">
    <link rel="stylesheet" href="../../stylesheet/admin-pages.css">
    <title>Admin</title>
</head>

<body>
    <header>
        <h3>Welcome back, Admin</h3>
        <h1 class="title">Event Management</h1>
        <p class="descreption">Manage and curate upcoming university activities.</p>
    </header>
    <!-- SIDE MENU -->
    <div class="side-menu">
        <!-- HEADER -->
        <div class="header">
            <h2 class="title"><a href="./adim-page.php">Admin Console</a></h2>
            <p class="descreption">UNIVERSITY EVENT PLATFORM</p>
        </div>
        <!-- ===== HEADER ===== -->
        <!-- NAVIGATION LINKS -->
        <nav>
            <ul class="nav-links">
                <li>
                    <a class="link" href="./dashboard.php">
                        <span class="material-symbols-outlined"> dashboard</span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a class="link active" href="./event-management.php">
                        <span class="material-symbols-outlined"> event </span>
                        <span>Event Management</span>
                    </a>
                </li>
                <li>
                    <a class="link" href="./registrations.php">
                        <span class="material-symbols-outlined">how_to_reg</span>
                        <span>Registrations</span>
                    </a>
                </li>
                <li>
                    <a class="link" href="./users.php">
                        <span class="material-symbols-outlined">group</span>
                        <span>Users</span>
                    </a>
                </li>
                <li>
                    <a class="link" href="./setting.php">
                        <span class="material-symbols-outlined">settings</span>
                        <span>System Setting</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- ===== NAVIGATION LINKS ===== -->
        <!-- PROFILE PHOTO -->
        <div class="profile">
            <div class="profile-image">
                <span class="profile-letter">S</span>
            </div>
            <div class="name-role">
                <h4 class="name">Dr. Somia Abufakher </h4>
                <p class="role">Dean of Student</p>
            </div>
        </div>
        <!-- ===== PROFILE PHOTO ===== -->
    </div>
    <!-- ===== SIDE MENU ===== -->

    <main>
        <!-- SUMMARY CARDS -->
        <section class="trend-cards">
            <div class="card">
                <span class="icon material-symbols-outlined">event_available</span>
                <p class="label">Active Events</p>
                <h1 class="value"><?= $active_events_count ?></h1>
            </div>

        </section>
        <!-- ===== SUMMARY CARDS ===== -->
        <!-- EVENTS TABLE -->
        <section class="event-management recent-registrations">
            <div class="search-filter">
                <form action="events-management.php" method="GET">
                    <div class="group">
                        <span class="icon material-symbols-outlined">search</span>
                        <input name="search" value="<?= htmlspecialchars($search_query) ?>" placeholder="Search by student name..." type="search" class="input">
                        <input type="hidden" name="status" value="<?= $status_filter ?>">
                    </div>
                </form>
                <div class="filters">
                    <a href="?status=all&search=<?= urlencode($search_query) ?>" class="filter <?= $status_filter === 'all' ? 'active' : '' ?>">All</a>
                    <a href="?status=Upcoming&search=<?= urlencode($search_query) ?>" class="filter <?= $status_filter === 'Upcoming' ? 'active' : '' ?>">Upcoming</a>
                    <a href="?status=Active&search=<?= urlencode($search_query) ?>" class="filter <?= $status_filter === 'Active' ? 'active' : '' ?>">Active</a>
                    <a href="?status=Completed&search=<?= urlencode($search_query) ?>" class="filter <?= $status_filter === 'Completed' ? 'active' : '' ?>">Completed</a>
                    <a href="?status=Cancelled&search=<?= urlencode($search_query) ?>" class="filter <?= $status_filter === 'Cancelled' ? 'active' : '' ?>">Cancelled</a>
                </div>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>EVENT DETAILS</th>
                            <th>SCHEDULE</th>
                            <th>ATTENDANCE</th>
                            <th>STATUS</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tbody>
                        <?php if (empty($events)): ?>
                            <tr>
                                <td colspan="5">No events found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($events as $event): ?>
                                <tr>
                                    <td>
                                        <div class="student-profile">
                                            <img src="<?= $event['image'] ?>" alt="<?= $event['title'] ?>" class="event-thumbnail" />
                                            <div class="info-stack">
                                                <span class="name"><?= $event['title'] ?></span>
                                                <span class="sub-text"><?= $event['location'] ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="info-stack">
                                            <span class="main-text"><?= date('j F Y', strtotime($event['event_date'])) ?></span>
                                            <span class="sub-text"><?= $event['start_time'] ?> - <?= $event['end_time'] ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="info-stack">
                                            <span class="main-text"><?= $event['registered'] ?> / <?= $event['capacity'] ?></span>
                                            <span class="sub-text"><?= ($event['capacity'] > 0) ? round(($event['registered'] / $event['capacity']) * 100) : 0 ?>% Full</span>
                                        </div>
                                    </td>
                                    <td>
                                        <?php
                                        $statusClass = 'pending';
                                        if ($event['status'] === 'Active') $statusClass = 'approved';
                                        if ($event['status'] === 'Cancelled') $statusClass = 'rejected';
                                        if ($event['status'] === 'Completed') $statusClass = 'offline';
                                        ?>
                                        <span class="status-badge <?= $statusClass ?>"><?= $event['status'] ?></span>
                                    </td>
                                    <td>
                                        <form method="POST" class="action-buttons icon-only">
                                            <input type="hidden" name="event_id" value="<?= $event['id'] ?>">
                                            <span class="material-symbols-outlined action-icon edit-btn" title="Edit">edit</span>
                                            <span class="material-symbols-outlined action-icon view-btn" title="View">visibility</span>
                                            <button type="submit" name="action" value="delete" class="material-symbols-outlined action-icon rejected" style="border:none; background:none;" title="Delete">delete</button>
                                        </form>
                                    </td>
                                </tr> <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                    </tbody>
                </table>
                <div class="table-footer">
                    <?php
                    $start_num = ($total_items == 0) ? 0 : $offset + 1;
                    $end_num = min($offset + $limit, $total_items);
                    ?>
                    <p class="pagination-num">Showing <strong><?= $start_num ?></strong> to <strong><?= $end_num ?></strong> of <strong><?= $total_items ?></strong> events</p>

                    <div class="pagination">
                        <?php if ($page > 1): ?>
                            <a href="?page=<?= $page - 1 ?>&status=<?= $status_filter ?>&search=<?= $search_query ?>" class="btn btn-outline">Previous</a>
                        <?php else: ?>
                            <button class="btn btn-outline" disabled style="opacity: 0.5; cursor: not-allowed;">Previous</button>
                        <?php endif; ?>

                        <?php if ($page < $total_pages): ?>
                            <a href="?page=<?= $page + 1 ?>&status=<?= $status_filter ?>&search=<?= $search_query ?>" class="btn btn-primary">Next</a>
                        <?php else: ?>
                            <button class="btn btn-primary" disabled style="opacity: 0.5; cursor: not-allowed;">Next</button>
                        <?php endif; ?>
                    </div>
                </div>
        </section>
        <!-- ===== EVENTS TABLE ===== -->
        <!-- ADD EVENT FORM -->
        <form method="post" class="add-event">
            <div class="form-grid">

                <div class="input-group full-width">
                    <label class="label" for="event-title">Event Title</label>
                    <input autocomplete="off" name="event-title" id="event-title" class="input" type="text"
                        placeholder="e.g. Global AI & Ethics Symposium">
                </div>

                <div class="input-group full-width">
                    <label class="label" for="event-venue">Venue / Location</label>
                    <input autocomplete="off" name="event-venue" id="event-venue" class="input" type="text"
                        placeholder="e.g. Great Hall">
                </div>

                <div class="input-group">
                    <label class="label" for="event-date">Date</label>
                    <input autocomplete="off" name="event-date" id="event-date" class="input" type="date">
                </div>

                <div class="input-group">
                    <label class="label" for="event-capacity">Max Capacity</label>
                    <input autocomplete="off" name="event-capacity" id="event-capacity" class="input" type="number"
                        placeholder="e.g. 500">
                </div>

                <div class="input-group">
                    <label class="label" for="event-start-time">Start Time</label>
                    <input autocomplete="off" name="event-start-time" id="event-start-time" class="input" type="time">
                </div>

                <div class="input-group">
                    <label class="label" for="event-end-time">End Time</label>
                    <input autocomplete="off" name="event-end-time" id="event-end-time" class="input" type="time">
                </div>

                <div class="input-group full-width">
                    <label class="label" for="event-category">Category</label>
                    <select autocomplete="off" name="event-category" id="event-category" class="input role-dropdown">
                        <option value="academic">Academic</option>
                        <option value="social">Social</option>
                        <option value="sports">Sports</option>
                        <option value="technology">Technology</option>
                    </select>
                </div>

                <div class="input-group full-width">
                    <label class="label" for="event-description">Description</label>
                    <textarea autocomplete="off" name="event-description" id="event-description" class="input textarea"
                        placeholder="Provide event details..."></textarea>
                </div>
            </div>

            <div class="form-actions">
                <button type="reset" class="btn btn-outline">Clear All</button>
                <button type="submit" class="btn btn-primary">Save Event</button>
            </div>
        </form>
        <!-- ===== ADD EVENT FORM ===== -->
    </main>

    <footer>
        <div>
            <h4>CampusConnect</h4>
            <p>© 2026 CampusConnect University.</p>
        </div>
    </footer>
</body>

</html>