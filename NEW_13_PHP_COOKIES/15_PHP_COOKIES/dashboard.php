<?php
require 'config.php';


if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$username = htmlspecialchars($_SESSION['username']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body { font-family: Arial; text-align: center; }
        .box { margin-top: 50px; }
        a { text-decoration: none; color: blue; }
    </style>
</head>
<body>

<div class="box">
    <h2>Welcome, <?php echo $username; ?> 👋</h2>
    <p>You are successfully logged in.</p>
    <p>
        🍪 Cookie User:
        <?php echo $_COOKIE['user_login'] ?? "No cookie set"; ?>
    </p>

    <br>
    <a href="logout.php">Logout</a>
</div>

</body>
</html>
