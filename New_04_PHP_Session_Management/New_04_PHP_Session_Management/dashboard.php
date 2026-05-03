<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

$cookie_user = isset($_COOKIE['username']) ? $_COOKIE['username'] : 'Guest';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome to your Dashboard!</h2>
    
    <p><strong>Session Name:</strong> <?php echo htmlspecialchars($_SESSION['name']); ?></p>
    <p><strong>Session Email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
    
    <p><strong>Cookie Memory:</strong> We remember your username is <?php echo htmlspecialchars($cookie_user); ?></p>

    <br>
    <a href="logout.php">Logout</a>
</body>
</html>