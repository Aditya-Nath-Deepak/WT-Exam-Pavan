<?php
// session_start MUST be the very first thing in the file
session_start();

// Database Connection
$conn = new mysqli("localhost", "root", "your_password", "your_database_name");

// Check for connection errors
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

$error = "";

if (isset($_POST['login'])) {
    // Basic sanitization
    $user = $conn->real_escape_string($_POST['username']);
    $pass = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT * FROM students WHERE username='$user' AND password='$pass'";
    $res = $conn->query($sql);

    if ($res && $res->num_rows > 0) {
        $row = $res->fetch_assoc();
        
        // Regenerate ID for security and set session
        session_regenerate_id();
        $_SESSION['student_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        
        // Redirect and STOP script execution
        header("Location: complaint.php");
        exit; 
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="card">
        <h2>Student Login</h2>
        <?php if($error) echo "<p class='error-msg'>$error</p>"; ?>
        <form method="POST" action="index.php">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
        <p style="margin-top:15px; font-size:13px;">
            New student? <a href="register.php">Register here</a>
        </p>
        <p style="margin-top:15px; font-size:13px;">
            Admin? <a href="admin_login.php">Login here</a>
        </p>
    </div>
</body>
</html>