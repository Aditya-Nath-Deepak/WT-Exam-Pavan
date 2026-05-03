<?php
include 'db.php';

if (!isset($_GET['id'])) {
    die("Invalid request");
}

$id = $_GET['id'];

$stmt = $conn->prepare("UPDATE complaints SET status='Completed' WHERE id=?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: view.php");
} else {
    echo "Error updating status";
}

$conn->close();
?>