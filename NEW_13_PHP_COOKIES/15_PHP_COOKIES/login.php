<?php
require 'config.php';

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

$errors = [];

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $user = trim($_POST['username']);
    $pass = trim($_POST['password']);

    if (empty($user) || empty($pass)) {
        $errors[] = "All fields are required!";
    }

    if(empty($errors))
   {
    $stmt=$conn->prepare("SELECT id,password FROM users WHERE username=?");
    $stmt->bind_param("s",$user);
    $stmt->execute();
    $result=$stmt->get_result();

    if($row=$result->fetch_assoc())
    {
        if(password_verify($pass,$row['password']))
        {
            session_regenerate_id(true);

            $_SESSION['user_id']=$row['id'];
            $_SESSION['username']=$user;

            if (isset($_POST['remember'])) {
                    setcookie("user_login", $user, time() + (86400 * 30), "/", "", false, true);
                }

            header("Location:dashboard.php");
            exit();
        }
        else
        {
            $errors[] = "Invalid password!";
        }
    }
    else{
       $errors[] = "User not found!";
    }
}
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body { font-family: Arial; text-align: center; }
        form { margin-top: 50px; }
        input { padding: 10px; margin: 5px; width: 250px; }
        button { padding: 10px 20px; }
        .error { color: red; }
    </style>
</head>
<body>

<?php
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<p class='error'>$error</p>";
    }
}
?>

<form method="post">
    <input type="text" name="username" placeholder="Username"
        value="<?php echo $_COOKIE['user_login'] ?? ''; ?>" required><br>

    <input type="password" name="password" placeholder="Password" required><br>

    <label>
        <input type="checkbox" name="remember"> Remember Me
    </label><br>

    <button type="submit">Login</button>
</form>

<p>Don't have an account? <a href="register.php">Register here</a></p>

</body>
</html>