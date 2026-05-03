<?php
require 'config.php';

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <style>
        body { text-align: center; font-family: Arial; margin-top: 100px; }
        a { display: block; margin: 10px; font-size: 18px; }
    </style>
</head>
<body>

<h2>Welcome to Login System</h2>

<a href="login.php">🔐 Login</a>
<a href="register.php">📝 Register</a>

</body>
</html>