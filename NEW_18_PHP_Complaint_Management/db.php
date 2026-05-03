<?php
$conn = new mysqli("localhost", "root", "", "complaint_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>