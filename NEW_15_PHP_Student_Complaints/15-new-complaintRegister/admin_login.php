<?php
session_start();
$conn = new mysqli("localhost", "root", "your_password", "your_database_name");

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $res = $conn->query("SELECT * FROM admins WHERE username='$user' AND password='$pass'");
    if ($res->num_rows > 0) {
        $_SESSION['admin_logged'] = true;
        header("Location: admin_dashboard.php");
    } else { $error = "Admin login failed"; }
}
?>
<!DOCTYPE html>
<html>
<head><title>Admin Login</title><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="card">
        <h2>Admin Portal</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Admin Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login" style="background:#2c3e50">Login as Admin</button>
        </form>
    </div>
</body>
</html>