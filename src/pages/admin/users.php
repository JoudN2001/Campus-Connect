<?php
require_once '../../../config/db.php';

// 1. Action: Toggle User Status (Active/Offline)
// 1. Action: Update User Role
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_role'])) {
    $id = (int)$_POST['user_id'];
    $new_role = mysqli_real_escape_string($conn, $_POST['role']);

    $update_query = "UPDATE users SET role = '$new_role' WHERE id = $id";
    mysqli_query($conn, $update_query);

    header("Location: users.php?" . $_SERVER['QUERY_STRING']);
    exit();
}

// 2. Pagination Setup
$limit = 5;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// 3. Filters & Search Setup
$role_filter = isset($_GET['role']) ? $_GET['role'] : 'all';
$search_query = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

$where_sql = "WHERE 1=1";

if ($role_filter !== 'all') {
    if ($role_filter === 'admin') {
        $where_sql .= " AND role IN ('Administrator', 'Moderator')";
    } else {
        $role_val = mysqli_real_escape_string($conn, $role_filter);
        $where_sql .= " AND role = '$role_val'";
    }
}

if ($search_query !== '') {
    $where_sql .= " AND (full_name LIKE '%$search_query%' OR email LIKE '%$search_query%')";
}

// 5. Pagination Queries
$count_query = "SELECT COUNT(*) AS total FROM users $where_sql";
$total_items = mysqli_fetch_assoc(mysqli_query($conn, $count_query))['total'];
$total_pages = ceil($total_items / $limit);

$data_query = "SELECT * FROM users $where_sql ORDER BY id DESC LIMIT $limit OFFSET $offset";
$users = mysqli_fetch_all(mysqli_query($conn, $data_query), MYSQLI_ASSOC);

// Count total users 
$total_users_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM users"))['count'];
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
        <h1 class="title">User Directory</h1>
        <p class="descreption">Manage university accounts, roles, and access.</p>
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
                    <a class="link" href="./registrations.php">
                        <span class="material-symbols-outlined">how_to_reg</span>
                        <span>Registrations</span>
                    </a>
                </li>
                <li>
                    <a class="link active" href="./users.php">
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
                <p class="label">Total Users</p>
                <h1 id="total-users" class="value"><?= $total_users_count ?></h1>
            </div>

        </section>
        <!-- ===== SUMMARY CARDS ===== -->
        <!-- USERS TABLE -->
        <section class="recent-registrations">
            <!-- SEARCH + FILTERATION -->
            <div class="search-filter">
                <form action="">
                    <div class="group">
                        <span class="icon material-symbols-outlined">search</span>
                        <input placeholder="Search by student name or email..." type="search" class="input">
                    </div>
                </form>
                <div class="filters">
                    <a href="?role=all" class="filter <?= $role_filter === 'all' ? 'active' : '' ?>">All</a>
                    <a href="?role=student" class="filter <?= $role_filter === 'student' ? 'active' : '' ?>">Students</a>
                    <a href="?role=faculty" class="filter <?= $role_filter === 'faculty' ? 'active' : '' ?>">Faculty</a>
                    <a href="?role=admin" class="filter <?= $role_filter === 'admin' ? 'active' : '' ?>">Admins</a>
                </div>
            </div>
            <!-- ===== SEARCH + FILTERATION ===== -->

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>USER</th>
                            <th>LAST LOGIN</th>
                            <th>STATUS</th>
                            <th>ROLE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($users)): ?>
                            <tr>
                                <td colspan="5">No registrations found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td>
                                        <div class="student-profile">
                                            <img src="<?= $user['avatar'] ?>" alt="<?= $user['full_name'] ?>">
                                            <div class="info-stack">
                                                <span class="name"><?= $user['full_name'] ?></span>
                                                <span class="sub-text"><?= $user['email'] ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="info-stack">
                                            <span class="main-text"><?= $user['last_login_time'] ?></span>
                                            <span class="sub-text"><?= $user['last_login_method'] ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="status-badge <?= $user['status'] === 'Active' ? 'approved' : 'offline' ?>">
                                            <?= $user['status'] ?>
                                        </span>
                                    </td>
                                    <td>
                                        <form method="POST">
                                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                            <select name="role" class="role-dropdown" onchange="this.form.submit()">
                                                <option value="Administrator" <?= $user['role'] === 'Administrator' ? 'selected' : '' ?>>Administrator</option>
                                                <option value="Moderator" <?= $user['role'] === 'Moderator' ? 'selected' : '' ?>>Moderator</option>
                                                <option value="Faculty" <?= $user['role'] === 'Faculty' ? 'selected' : '' ?>>Faculty</option>
                                                <option value="Student" <?= $user['role'] === 'Student' ? 'selected' : '' ?>>Student</option>
                                            </select>
                                            <input type="hidden" name="update_role" value="1">
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
                            <a href="?page=<?= $page - 1 ?>&role=<?= $role_filter ?>&search=<?= $search_query ?>" class="btn btn-outline">Previous</a>
                        <?php else: ?>
                            <button class="btn btn-outline" disabled style="opacity: 0.5; cursor: not-allowed;">Previous</button>
                        <?php endif; ?>

                        <?php if ($page < $total_pages): ?>
                            <a href="?page=<?= $page + 1 ?>&role=<?= $role_filter ?>&search=<?= $search_query ?>" class="btn btn-primary">Next</a>
                        <?php else: ?>
                            <button class="btn btn-primary" disabled style="opacity: 0.5; cursor: not-allowed;">Next</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- ===== USERS TABLE ===== -->
    </main>
    <footer>
        <div>
            <h4>CampusConnect</h4>
            <p>© 2026 CampusConnect University.</p>
        </div>
    </footer>
</body>

</html>