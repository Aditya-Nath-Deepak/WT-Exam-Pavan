<?php
session_start();

if(!isset($_SESSION['initiatied']))
{
    session_regenerate_id(true);
    $_SESSION['initiated'] = true;
}

$host = 'localhost';
$db   = 'DBUsers';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("DatabaseConnection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>