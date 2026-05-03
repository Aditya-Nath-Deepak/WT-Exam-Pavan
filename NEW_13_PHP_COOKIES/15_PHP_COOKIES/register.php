<?php
require 'config.php';

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

$errors=[];

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

     if (empty($username) || empty($email) || empty($password)) {
        $errors[] = "All fields are required!";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format!";
    }

    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters!";
    }

    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT id FROM users WHERE username=? OR email=?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $errors[] = "Username or Email already exists!";
        }
    }

    if (empty($errors)) {

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($stmt->execute()) {
            echo "<p style='color:green;'>Registration successful! <a href='login.php'>Login</a></p>";
        } else {
            echo "<p style='color:red;'>Something went wrong!</p>";
        }
    }

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body { font-family: Arial; text-align: center; }
        form { margin-top: 50px; }
        input { padding: 10px; margin: 5px; width: 250px; }
        button { padding: 10px 20px; }
        .error { color: red; }
    </style>
</head>
<body>

<h2>Register</h2>


<?php
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<p class='error'>$error</p>";
    }
}
?>

<form method="POST">
    <input type="text" name="username" placeholder="Username"><br>
    <input type="email" name="email" placeholder="Email"><br>
    <input type="password" name="password" placeholder="Password"><br>
    <button type="submit">Register</button>
</form>
<p>Already have an account? <a href="login.php">Login here</a></p>
</body>
</html>