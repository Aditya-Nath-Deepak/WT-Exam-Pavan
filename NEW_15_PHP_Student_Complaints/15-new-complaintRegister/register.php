<?php
session_start();
$conn = new mysqli("localhost", "root", "your_password", "your_database_name");

$message = "";
$error = "";

if (isset($_POST['register'])) {
    $user = $conn->real_escape_string($_POST['username']);
    $pass = $conn->real_escape_string($_POST['password']);

    // Check if username already exists
    $check = $conn->query("SELECT * FROM students WHERE username='$user'");
    
    if ($check->num_rows > 0) {
        $error = "Username already taken! Try another one.";
    } else {
        // Insert new student
        $sql = "INSERT INTO students (username, password) VALUES ('$user', '$pass')";
        if ($conn->query($sql)) {
            $message = "Registration successful! <a href='index.php'>Login here</a>";
        } else {
            $error = "Registration failed: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="card">
        <h2>Student Register</h2>
        <?php 
            if($error) echo "<p style='color:red; font-size:14px;'>$error</p>"; 
            if($message) echo "<p style='color:green; font-size:14px;'>$message</p>"; 
        ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Choose Username" required>
            <input type="password" name="password" placeholder="Choose Password" required>
            <button type="submit" name="register" style="background:#2ecc71">Register</button>
        </form>
        <p style="margin-top:15px; font-size:13px;">
            Already have an account? <a href="index.php">Login here</a>
        </p>
    </div>
</body>
</html>