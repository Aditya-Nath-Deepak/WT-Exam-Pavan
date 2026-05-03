<?php
session_start();

// Simulated Authorities Database
$authorities = [
    'Plastic' => 'Pune Plastic Recycling Division (PPRD)',
    'Paper' => 'Municipal Paper Waste Management (MPWM)',
    'Other' => 'General Waste Collection Unit'
];

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['waste_type'] ?? 'Other';
    $location = htmlspecialchars($_POST['location']);
    $description = htmlspecialchars($_POST['description']);

    if (!empty($location)) {
        // In a real app, this would be a DB insert
        $assigned_to = $authorities[$type] ?? $authorities['Other'];
        
        $message = "<strong>Success!</strong> Your report for <strong>$type</strong> waste at <strong>$location</strong> has been sent.<br>";
        $message .= "Directed to: <em>$assigned_to</em>";
    } else {
        $message = "<span style='color:red;'>Please provide a location.</span>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Waste Collection System</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f2f5; display: flex; justify-content: center; padding-top: 50px; }
        .container { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 400px; }
        h2 { color: #2e7d32; margin-top: 0; }
        label { display: block; margin: 15px 0 5px; font-weight: bold; }
        input, select, textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { background: #2e7d32; color: white; border: none; padding: 12px; width: 100%; border-radius: 4px; margin-top: 20px; cursor: pointer; font-size: 16px; }
        button:hover { background: #1b5e20; }
        .alert { background: #e8f5e9; border-left: 5px solid #2e7d32; padding: 15px; margin-bottom: 20px; font-size: 14px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Waste Collection Portal</h2>
    
    <?php if ($message): ?>
        <div class="alert"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Waste Material Type</label>
        <select name="waste_type">
            <option value="Plastic">Plastic</option>
            <option value="Paper">Paper</option>
            <option value="Other">Other / Mixed</option>
        </select>

        <label>Pickup Location</label>
        <input type="text" name="location" placeholder="e.g. VIT Pune Campus, Bibwewadi" required>

        <label>Additional Details</label>
        <textarea name="description" rows="3" placeholder="Approx quantity or landmark..."></textarea>

        <button type="submit">Notify Authorities</button>
    </form>
</div>

</body>
</html>