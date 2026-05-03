<?php
session_start(); 

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && $action == 'login') {
    
    $name = htmlspecialchars(trim($_POST['name']));
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Error: Invalid email format. Please go back and try again.");
    }

    if ($password === "password123") {
        
        setcookie("username", $name, time() + (86400 * 30), "/");

        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $name;

        header("Location: dashboard.php");
        exit;
    } else {
        echo "Invalid password. (Hint: use 'password123')";
    }
} else {
    echo "Invalid request method.";
}
?>