<?php
require_once '../../../config/db.php';
require_once '../../../includes/functions.php';

// Approve & Reject Register
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && isset($_POST['reg_id'])) {
        $id = (int)$_POST['reg_id'];
        $new_status = $_POST['action'] === 'approve' ? 'Approved' : 'Rejected';

        $update_query = "UPDATE registrations SET status = '$new_status' WHERE id = $id";
        mysqli_query($conn, $update_query);

        header("Location: registrations.php?" . $_SERVER['QUERY_STRING']);
        exit();
    }
}

// Pagination
$limit = 5;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Filters
$status_filter = isset($_GET['status']) ? $_GET['status'] : 'all';
$search_query = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

// Search
$where_sql = "WHERE 1=1";
if ($status_filter !== 'all') {
    $where_sql .= " AND status = '$status_filter'";
}
if ($search_query !== '') {
    $where_sql .= " AND (student_name LIKE '%$search_query%' OR event_name LIKE '%$search_query%')";
}

// Pagination
$count_query = "SELECT COUNT(*) AS total FROM registrations $where_sql";
$total_items = mysqli_fetch_assoc(mysqli_query($conn, $count_query))['total'];
$total_pages = ceil($total_items / $limit);

// Filter & Search Query
$data_query = "SELECT * FROM registrations $where_sql ORDER BY date_applied DESC LIMIT $limit OFFSET $offset";
$registrations = mysqli_fetch_all(mysqli_query($conn, $data_query), MYSQLI_ASSOC);

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
        <h1 class="title">Registration Requests</h1>
        <p class="descreption">Review and manage pending registrations for upcoming university events. Approvals will
            trigger automated confirmation emails to attendees.</p>
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
                    <a class="link" href="./event-management.php">
                        <span class="material-symbols-outlined"> event </span>
                        <span>Event Management</span>
                    </a>
                </li>
                <li>
                    <a class="link active" href="./registrations.php">
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
                <span class="icon material-symbols-outlined">group</span>
                <p class="label">Total Registrations</p>
                <h1 class="value"><?= $pending_approvals_count ?></h1>
            </div>
            <div class="card">
                <span class="icon material-symbols-outlined">pending_actions</span>
                <p class="label">Pending Approvals</p>
                <h1 class="value"><?= $total_registrations_count ?></h1>
            </div>
            <div class="card">
                <span class="icon material-symbols-outlined">calendar_check</span>
                <p class="label">Approved</p>
                <h1 class="value"><?= $active_events_count ?></h1>
            </div>
        </section>
        <!-- ===== SUMMARY CARDS ===== -->
        <!-- REGESTRATION STUDENT TABLE -->
        <section class="recent-registrations">
            <!-- SEARCH + FILTERATION -->
            <div class="search-filter">
                <form action="registrations.php" method="GET">
                    <div class="group">
                        <span class="icon material-symbols-outlined">search</span>
                        <input name="search" value="<?= htmlspecialchars($search_query) ?>" placeholder="Search by student name..." type="search" class="input">
                        <input type="hidden" name="status" value="<?= $status_filter ?>">
                    </div>
                </form>

                <div class="filters">
                    <a href="?status=all&search=<?= $search_query ?>" class="filter <?= $status_filter === 'all' ? 'active' : '' ?>">All Events</a>
                    <a href="?status=Pending&search=<?= $search_query ?>" class="filter <?= $status_filter === 'Pending' ? 'active' : '' ?>">Pending</a>
                    <a href="?status=Approved&search=<?= $search_query ?>" class="filter <?= $status_filter === 'Approved' ? 'active' : '' ?>">Approved</a>
                    <a href="?status=Rejected&search=<?= $search_query ?>" class="filter <?= $status_filter === 'Rejected' ? 'active' : '' ?>">Rejected</a>
                </div>
            </div>
            <!-- ===== SEARCH + FILTERATION ===== -->

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
                        <?php if (empty($registrations)): ?>
                            <tr>
                                <td colspan="5">No registrations found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($registrations as $reg): ?>
                                <?php
                                $statusClass = 'pending';
                                if ($reg['status'] === 'Approved') $statusClass = 'approved';
                                if ($reg['status'] === 'Rejected') $statusClass = 'rejected';
                                ?>
                                <tr>
                                    <td>
                                        <div class="student-profile">
                                            <img src="<?= $reg['avatar'] ?>" alt="avatar">
                                            <span class="name"><?= $reg['student_name'] ?></span>
                                        </div>
                                    </td>
                                    <td><?= $reg['event_name'] ?></td>
                                    <td class="date-text"><?= formatTimeAgo($reg['date_applied']) ?></td>
                                    <td><span class="status-badge <?= $statusClass ?>"><?= $reg['status'] ?></span></td>
                                    <td>
                                        <form method="POST" style="display:inline;">
                                            <input type="hidden" name="reg_id" value="<?= $reg['id'] ?>">
                                            <div class="action-buttons icon-only">
                                                <button type="submit" name="action" value="approve" class="material-symbols-outlined action-icon approved" style="border:none; background:none;" title="Approve">check</button>
                                                <button type="submit" name="action" value="reject" class="material-symbols-outlined action-icon rejected" style="border:none; background:none;" title="Reject">close</button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
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
        <!-- ===== REGESTRATION STUDENT TABLE ===== -->
    </main>
    <footer>
        <div>
            <h4>CampusConnect</h4>
            <p>© 2026 CampusConnect University.</p>
        </div>
    </footer>
</body>

</html>