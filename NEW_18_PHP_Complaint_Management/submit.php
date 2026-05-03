<?php
include 'db.php';

$name = $_POST['name'];
$email = $_POST['email'];
$org = $_POST['organization'];
$complaint = $_POST['complaint'];

$stmt = $conn->prepare("INSERT INTO complaints (name, email, organization, complaint) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $org, $complaint);

if ($stmt->execute()) {
    echo "Complaint submitted successfully!<br>";
    echo "<a href='index.php'>Back</a>";
} else {
    echo "Error: " . $stmt->error;
}

$conn->close();
?>