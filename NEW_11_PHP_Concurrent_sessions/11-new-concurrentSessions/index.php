<?php
// Set session timeout to 5 minutes
ini_set('session.gc_maxlifetime', 300);
ini_set('session.cookie_lifetime', 300);
session_start();

$user_id = "Student_User";
$tracker_file = 'session_tracker.json';
$max_sessions = 3;
$now = time();

// --- 1. HANDLE LOGIN SUBMISSION ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $_SESSION['is_logged_in'] = true;
    header("Location: index.php");
    exit;
}

// --- 2. SHOW LOGIN SCREEN ---
if (!isset($_SESSION['is_logged_in'])) {
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Login - Portal</title>
        <style>
            body { font-family: 'Segoe UI', sans-serif; background: #e0e5ec; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
            .card { background: white; width: 350px; padding: 40px; border-radius: 12px; box-shadow: 0 10px 20px rgba(0,0,0,0.05); text-align: center; }
            button { background: #007bff; color: white; border: none; padding: 12px; width: 100%; border-radius: 6px; font-size: 16px; cursor: pointer; transition: 0.3s; }
            button:hover { background: #0056b3; }
            .msg { color: #28a745; margin-bottom: 15px; font-size: 14px; }
        </style>
    </head>
    <body>
        <div class="card">
            <h2>Student Portal</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 25px;">Please log in to continue.</p>
            <?php if(isset($_GET['logged_out'])) echo "<div class='msg'>Successfully logged out. Slot freed!</div>"; ?>
            <form method="POST">
                <button type="submit" name="login" value="1">Login as <?php echo $user_id; ?></button>
            </form>
        </div>
    </body>
    </html>
<?php
    exit;
}

// --- 3. CONCURRENT SESSION LOGIC ---
$data = file_exists($tracker_file) ? json_decode(file_get_contents($tracker_file), true) : [];
$user_sessions = isset($data[$user_id]) ? $data[$user_id] : [];

// Prune expired sessions (older than 5 mins)
foreach ($user_sessions as $sid => $last_act) {
    if ($now - $last_act > 300) unset($user_sessions[$sid]);
}

$current_sid = session_id();
$is_denied = false;

// Check if current session is new
if (!isset($user_sessions[$current_sid])) {
    if (count($user_sessions) >= $max_sessions) {
        $is_denied = true;
        // Destroy their session so they are forced back to login screen
        session_unset();
        session_destroy();
    } else {
        $user_sessions[$current_sid] = $now; // Grant access
    }
} else {
    $user_sessions[$current_sid] = $now; // Update timestamp
}

// Save active sessions back to file (if not denied)
if (!$is_denied) {
    $data[$user_id] = $user_sessions;
    file_put_contents($tracker_file, json_encode($data));
}

// --- 4. SHOW DENIED SCREEN ---
if ($is_denied) {
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Access Denied</title>
        <style>
            body { font-family: 'Segoe UI', sans-serif; background: #2c3e50; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
            .card { background: white; width: 350px; padding: 40px; border-radius: 12px; text-align: center; border-top: 6px solid #e74c3c; }
            h2 { color: #e74c3c; margin-top: 0; }
            a { display: inline-block; background: #e74c3c; color: white; text-decoration: none; padding: 10px 20px; border-radius: 6px; margin-top: 15px; }
        </style>
    </head>
    <body>
        <div class="card">
            <h2>🚫 Max Sessions Reached</h2>
            <p>You already have <strong>3 active sessions</strong> open.</p>
            <p style="font-size: 13px; color: #666;">Please log out from another browser to free up a slot.</p>
            <a href="index.php">Back to Login</a>
        </div>
    </body>
    </html>
<?php
    exit;
}

// --- 5. SHOW DASHBOARD ---
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f6f9; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .dashboard { background: white; width: 400px; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); text-align: center; border-top: 6px solid #2ecc71; }
        .count { font-size: 1.5em; color: #27ae60; font-weight: bold; margin: 20px 0; background: #eafaf1; padding: 10px; border-radius: 8px; }
        .logout-btn { background: #e74c3c; color: white; border: none; padding: 12px; width: 100%; border-radius: 6px; font-size: 16px; cursor: pointer; transition: 0.3s; }
        .logout-btn:hover { background: #c0392b; }
    </style>
</head>
<body>
    <div class="dashboard">
        <h1 style="color: #2c3e50; margin-top: 0;">Welcome Back!</h1>
        <p>User ID: <strong><?php echo $user_id; ?></strong></p>
        <div class="count">Active Sessions: <?php echo count($user_sessions); ?> / 3</div>
        <form action="logout.php" method="POST">
            <button type="submit" class="logout-btn">Secure Logout</button>
        </form>
    </div>
</body>
</html>