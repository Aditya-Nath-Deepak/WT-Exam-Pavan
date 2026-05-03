<?php
session_start();

// If session is NOT set, kick them back to login
if (!isset($_SESSION['student_id'])) {
    header("Location: index.php");
    exit;
}

$conn = new mysqli("localhost", "root", "your_password", "your_database_name");
$msg = "";

if (isset($_POST['submit'])) {
    $sid = $_SESSION['student_id'];
    $sub = $conn->real_escape_string($_POST['subject']);
    $desc = $conn->real_escape_string($_POST['description']);

    $sql = "INSERT INTO complaints (student_id, subject, description) VALUES ('$sid', '$sub', '$desc')";
    
    if ($conn->query($sql)) {
        $msg = "Complaint submitted successfully!";
    } else {
        $msg = "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>File a Complaint</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="card">
        <h2>Submit Complaint</h2>
        <p style="font-size: 0.9em; color: #666;">Logged in as: <strong><?php echo $_SESSION['username']; ?></strong></p>
        
        <?php if($msg) echo "<p class='success-msg'>$msg</p>"; ?>
        
        <form method="POST" action="complaint.php">
            <input type="text" name="subject" placeholder="Subject (e.g. Hostel, Exams)" required>
            <textarea name="description" placeholder="Provide detailed information..." rows="5" required></textarea>
            <button type="submit" name="submit">Submit Complaint</button>
        </form>
        
        <hr style="border:0; border-top:1px solid #eee; margin:20px 0;">
        <a href="logout.php" class="logout-link">Logout</a>
    </div>
</body>
</html>