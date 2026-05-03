<?php
session_start();

$user_id = "Student_User";
$tracker_file = 'session_tracker.json';

// 1. Remove the session from the JSON file to free the slot immediately
if (file_exists($tracker_file)) {
    $data = json_decode(file_get_contents($tracker_file), true);
    $current_sid = session_id();

    if (isset($data[$user_id][$current_sid])) {
        unset($data[$user_id][$current_sid]);
        file_put_contents($tracker_file, json_encode($data));
    }
}

// 2. Destroy the browser's session
session_unset();
session_destroy();

// 3. Redirect back to index with a success message
header("Location: index.php?logged_out=1");
exit;