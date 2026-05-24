<?php
require_once '../config/db.php';
require_once 'dummy_data.php';

echo "<h2>System Setup Started...</h2>";

// CREATE TABLES
$queries = [
    "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        full_name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        avatar VARCHAR(500),
        last_login_time DATETIME,
        last_login_method VARCHAR(50),
        status VARCHAR(50) DEFAULT 'Offline',
        role VARCHAR(50) NOT NULL
    )",
    "CREATE TABLE IF NOT EXISTS events (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        category VARCHAR(100) NOT NULL,
        event_date DATE NOT NULL,
        start_time TIME NOT NULL,
        end_time TIME NOT NULL,
        location VARCHAR(255) NOT NULL,
        description TEXT,
        image VARCHAR(500),
        capacity INT NOT NULL,
        registered INT DEFAULT 0,
        status VARCHAR(50) DEFAULT 'Upcoming'
    )",
    "CREATE TABLE IF NOT EXISTS registrations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        student_name VARCHAR(255) NOT NULL,
        event_name VARCHAR(255) NOT NULL,
        date_applied DATETIME NOT NULL,
        status VARCHAR(50) DEFAULT 'Pending',
        avatar VARCHAR(500)
    )"
];

foreach ($queries as $query) {
    mysqli_query($conn, $query);
}
echo "Tables created successfully.<br>";


// USERS
$check = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM users"));
if ($check['c'] == 0) {
    foreach ($usersData as $u) {
        $name = mysqli_real_escape_string($conn, $u['full_name']);
        $email = mysqli_real_escape_string($conn, $u['email']);

        mysqli_query($conn, "INSERT INTO users (full_name, email, avatar, last_login_time, last_login_method, status, role) 
                             VALUES ('$name', '$email', '{$u['avatar']}', '{$u['last_login_time']}', '{$u['last_login_method']}', '{$u['status']}', '{$u['role']}')");
    }
    echo "Dummy Users inserted.<br>";
}

// EVENTS
$check = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM events"));
if ($check['c'] == 0) {
    foreach ($eventsData as $e) {
        $title = mysqli_real_escape_string($conn, $e['title']);
        $desc = mysqli_real_escape_string($conn, $e['description']);

        mysqli_query($conn, "INSERT INTO events (title, category, event_date, start_time, end_time, location, description, image, capacity, registered, status) 
                             VALUES ('$title', '{$e['category']}', '{$e['event_date']}', '{$e['start_time']}', '{$e['end_time']}', '{$e['location']}', '$desc', '{$e['image']}', {$e['capacity']}, {$e['registered']}, '{$e['status']}')");
    }
    echo "Dummy Events inserted.<br>";
}

// REGISTRATIONS
$check = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM registrations"));
if ($check['c'] == 0) {
    foreach ($registrationsData as $r) {
        $s_name = mysqli_real_escape_string($conn, $r['student_name']);
        $e_name = mysqli_real_escape_string($conn, $r['event_name']);

        mysqli_query($conn, "INSERT INTO registrations (student_name, event_name, date_applied, status, avatar) 
                             VALUES ('$s_name', '$e_name', '{$r['date_applied']}', '{$r['status']}', '{$r['avatar']}')");
    }
    echo "Dummy Registrations inserted.<br>";
}

echo "<h2>Setup Complete!</h2>";
