<?php
// Include database connection and models
require_once '../../../config/db.php';
require_once '../../../includes/events-model.php';
require_once '../../../includes/users-model.php';
require_once '../../../includes/registrations-model.php';
require_once '../../../includes/functions.php';

// Count active events
$active_query = "SELECT COUNT(*) AS count FROM events WHERE status = 'Active'";
$active_result = mysqli_query($conn, $active_query);
$active_events_count = mysqli_fetch_assoc($active_result)['count'];

// Count total registrations
$total_reg_query = "SELECT COUNT(*) AS count FROM registrations";
$total_reg_result = mysqli_query($conn, $total_reg_query);
$total_registrations_count = mysqli_fetch_assoc($total_reg_result)['count'];

// Count pending approvals
$pending_query = "SELECT COUNT(*) AS count FROM registrations WHERE status = 'Pending'";
$pending_result = mysqli_query($conn, $pending_query);
$pending_approvals_count = mysqli_fetch_assoc($pending_result)['count'];

// Fetch all data arrays
$all_events = getEventsData($conn);
$all_users = getUsersData($conn);
$all_registraters = getRegistersData($conn);

// Get the latest event and format its date
$next_event_query = "SELECT * FROM events ORDER BY event_date DESC LIMIT 1";
$next_event_result = mysqli_query($conn, $next_event_query);
$next_event = mysqli_fetch_assoc($next_event_result);
$formatted_date = date('j F Y', strtotime($next_event['event_date']));

// Get 3 random events for featured cards
$random_events = $all_events;
shuffle($random_events);
$featured_events = array_slice($random_events, 0, 3);

// Get the 5 most recent registrations
$recent_query = "SELECT * FROM registrations ORDER BY date_applied DESC LIMIT 5";
$recent_result = mysqli_query($conn, $recent_query);
$recent_registrations = mysqli_fetch_all($recent_result, MYSQLI_ASSOC);
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
        <h1 class="title">Dashboard Overview</h1>
    </header>
    <!-- SIDE MENU -->
    <div class="side-menu">
        <!-- HEADER -->
        <div class="header">
            <h2 class="title"><a href="./adim-page.html">Admin Console</a></h2>
            <p class="descreption">UNIVERSITY EVENT PLATFORM</p>
        </div>
        <!-- ===== HEADER ===== -->
        <!-- NAVIGATION LINKS -->
        <nav>
            <ul class="nav-links">
                <li>
                    <a class="link active" href="./dashboard.php">
                        <span class="material-symbols-outlined"> dashboard</span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a class="link" href="./event-management.php">
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
                <h1 class="value"><?= $active_events_count; ?></h1>
            </div>

            <div class="card">
                <span class="icon material-symbols-outlined">group</span>
                <p class="label">Total Registrations</p>
                <h1 class="value"><?= $total_registrations_count; ?></h1>
            </div>

            <div class="card">
                <span class="icon material-symbols-outlined">pending_actions</span>
                <p class="label">Pending Approvals</p>
                <h1 class="value"><?= $pending_approvals_count; ?></h1>
            </div>
        </section>
        <!-- ===== SUMMARY CARDS ===== -->
        <!-- ACTIVE EVENTS SECTION -->
        <section class="active-events">
            <div class="active-events-label">
                <div class="active-title">
                    <h1 class="title">Active Event Management</h1>
                    <p class="descreption">Moitor and curate the current campus highlights.</p>
                </div>
                <a href="./event-management.html">
                    <span class="material-symbols-outlined">add</span>
                    <span>Add New Event</span>
                </a>
            </div>
            <div class="highlited-events">
                <div class="main-event">
                    <img class="bg-img" src="<?= $next_event['image']; ?>" alt="Featured Event">
                    <div class="event-content">
                        <div class="top-info">
                            <span class="status">Next Major Event</span>
                            <h4 class="event-title"><?= $next_event['title']; ?></h4>
                        </div>
                        <div class="event-info">
                            <div class="info-block">
                                <span class="info-label">DATE</span>
                                <p class="detailes"><?= $formatted_date; ?></p>
                            </div>
                            <div class="info-block">
                                <span class="info-label">VENUE</span>
                                <p class="detailes"><?= $next_event['location']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="selected-events">
                    <?php foreach ($featured_events as $event): ?>

                        <div class="card">
                            <img src="<?= $event['image']; ?>" alt="thumbnail">
                            <div class="detailes">
                                <span class="catagory"><?= $event['category']; ?></span>
                                <h2><?= $event['title']; ?></h2>
                                <p><?= $event['registered']; ?> Registered</p>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>
        </section>
        <!-- ===== ACTIVE EVENTS SECTION ===== -->

        <!-- RECENT STUDENT TABLE -->
        <section class="recent-registrations">
            <h1 class="section-title">Recent Student Registrations</h1>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>STUDENT NAME</th>
                            <th>SELECTED EVENT</th>
                            <th>DATE APPLIED</th>
                            <th>STATUS</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recent_registrations as $reg): ?>
                            <?php
                            $formatedDate = formatTimeAgo($reg['date_applied']);

                            $statusClass = "pending";
                            if ($reg['status'] === "Approved") $statusClass = "approved";
                            if ($reg['status'] === "Rejected") $statusClass = "rejected";
                            ?>
                            <td>
                                <div class="student-profile">
                                    <img
                                        src="${event.image}"
                                        alt="${event.title}"
                                        class="event-thumbnail" />
                                    <div class="info-stack">
                                        <span class="name">${event.title}</span>
                                        <span class="sub-text">${event.location}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="info-stack">
                                    <span class="main-text">${formatedDate}</span>
                                    <span class="sub-text">${event.startTime} - ${event.endTime}</span>
                                </div>
                            </td>
                            <td>
                                <div class="info-stack">
                                    <span class="main-text">${event.registered} / ${event.capacity}</span>
                                    <span class="sub-text">${percent}% Full</span>
                                </div>
                            </td>
                            <td>
                                <span class="status-badge ${statusClass}">${event.status}</span>
                            </td>
                            <td>
                                <div class="action-buttons icon-only">
                                    <span class="material-symbols-outlined action-icon edit-btn" data-id="${event.id}" title="Edit">edit</span>
                                    <span class="material-symbols-outlined action-icon view-btn" data-id="${event.id}" title="View">visibility</span>
                                    <span class="material-symbols-outlined action-icon delete-btn rejected" data-id="${event.id}" title="Delete">delete</span>
                                </div>
                            </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <a href="./registrations.html" class="view-all-link">See More</a>
        </section>
        <!-- ===== RECENT STUDENT TABLE ===== -->
    </main>
    <footer>
        <div>
            <h4>CampusConnect</h4>
            <p>© 2026 CampusConnect University.</p>
        </div>
    </footer>
</body>

</html>