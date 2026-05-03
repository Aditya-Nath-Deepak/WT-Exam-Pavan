<?php
session_start();
if (!isset($_SESSION['admin_logged'])) header("Location: admin_login.php");
$conn = new mysqli("localhost", "root", "your_password", "your_database_name");
$res = $conn->query("SELECT c.*, s.username FROM complaints c JOIN students s ON c.student_id = s.id");
?>
<!DOCTYPE html>
<html>
<head><title>Admin Dashboard</title><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="container">
        <h2>All Student Complaints</h2>
        <table border="1" width="100%">
            <tr><th>ID</th><th>Student</th><th>Subject</th><th>Description</th><th>Date</th></tr>
            <?php while($row = $res->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['username'] ?></td>
                <td><?= $row['subject'] ?></td>
                <td><?= $row['description'] ?></td>
                <td><?= $row['created_at'] ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
        <br><a href="logout.php">Logout</a>
    </div>
</body>
</html>