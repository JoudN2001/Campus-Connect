<?php
include_once __DIR__ . '/../config/db.php';
function getUsersData($conn){
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);

    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}