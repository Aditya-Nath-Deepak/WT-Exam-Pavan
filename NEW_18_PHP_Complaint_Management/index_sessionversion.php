<?php
session_start();

// Initialize session storage
if (!isset($_SESSION['complaints'])) {
    $_SESSION['complaints'] = [];
}

// ADD COMPLAINT
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $complaint = [
        'id' => count($_SESSION['complaints']) + 1,
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'organization' => $_POST['organization'],
        'text' => $_POST['complaint'],
        'status' => 'Pending'
    ];

    $_SESSION['complaints'][] = $complaint;
}

// UPDATE STATUS
if (isset($_GET['complete'])) {
    $id = $_GET['complete'];

    foreach ($_SESSION['complaints'] as &$c) {
        if ($c['id'] == $id) {
            $c['status'] = 'Completed';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Complaint System (Session Based)</title>
    <style>
        body { font-family: Arial; background:#f4f6f9; padding:20px; }
        .container { width: 500px; margin:auto; background:#fff; padding:20px; border-radius:8px; }
        input, select, textarea { width:100%; padding:10px; margin:10px 0; }
        button { padding:10px; background:#007bff; color:#fff; border:none; }
        table { width:100%; margin-top:20px; border-collapse: collapse; }
        td, th { padding:10px; border:1px solid #ddd; }
        th { background:#007bff; color:#fff; }
        a { color:green; text-decoration:none; }
    </style>
</head>

<body>

<div class="container">

<h2>Register Complaint</h2>

<form method="POST">
    <input type="text" name="name" placeholder="Your Name" required>
    <input type="email" name="email" placeholder="Email" required>

    <select name="organization">
        <option>PMC</option>
        <option>PMT</option>
        <option>Other</option>
    </select>

    <textarea name="complaint" placeholder="Enter complaint" required></textarea>

    <button type="submit" name="add">Submit</button>
</form>

<hr>

<h2>All Complaints</h2>

<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Organization</th>
    <th>Complaint</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php foreach ($_SESSION['complaints'] as $c): ?>
<tr>
    <td><?= $c['id'] ?></td>
    <td><?= $c['name'] ?></td>
    <td><?= $c['organization'] ?></td>
    <td><?= $c['text'] ?></td>
    <td><?= $c['status'] ?></td>
    <td>
        <?php if ($c['status'] == 'Pending'): ?>
            <a href="?complete=<?= $c['id'] ?>" onclick="return confirm('Mark as completed?')">
                Mark Completed
            </a>
        <?php else: ?>
            Completed
        <?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>

</table>

</div>

</body>
</html>