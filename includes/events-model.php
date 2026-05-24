<?php
include_once __DIR__ . '/../config/db.php';
function getEventsData($conn){
    $sql = "SELECT * FROM events";
    $result = mysqli_query($conn, $sql);

    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}