<?php
// Database Configuration
$host = "localhost";
$username = "root";
$password = "your_db_password"; // Default for XAMPP
$dbname = "db_name"; // Change to your database name

// 3. Connect PHP with MySQL using mysqli
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

// 4. Insert Records
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sql = "INSERT INTO students (name, email) VALUES ('$name', '$email')";
    if ($conn->query($sql) === TRUE) {
        $message = "Record added successfully!";
    }
}

// 5. Delete Records
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM students WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        $message = "Record deleted!";
    }
}

// 5. Update Records (Simulated by filling the form)
$update_id = "";
$update_name = "";
$update_email = "";
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $res = $conn->query("SELECT * FROM students WHERE id=$id");
    $row = $res->fetch_assoc();
    $update_id = $row['id'];
    $update_name = $row['name'];
    $update_email = $row['email'];
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sql = "UPDATE students SET name='$name', email='$email' WHERE id=$id";
    $conn->query($sql);
    $message = "Record updated!";
    header("Location: index.php"); // Refresh to clear form
}

// 5. Display Records
$result = $conn->query("SELECT * FROM students");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Database CRUD</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f7f6; display: flex; flex-direction: column; align-items: center; padding: 40px; }
        .card { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 600px; margin-bottom: 20px; }
        input { padding: 10px; margin: 5px 0; width: calc(50% - 22px); border: 1px solid #ddd; border-radius: 4px; }
        .full { width: calc(100% - 22px); }
        button { padding: 10px 20px; background: #2ecc71; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .btn-update { background: #3498db; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #34495e; color: white; }
        .actions a { text-decoration: none; margin-right: 10px; font-weight: bold; }
        .del { color: #e74c3c; }
        .edit { color: #3498db; }
        .msg { color: #27ae60; margin-bottom: 15px; font-weight: bold; }
    </style>
</head>
<body>

    <div class="card">
        <h2>Student Management</h2>
        <?php if($message) echo "<p class='msg'>$message</p>"; ?>
        
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $update_id; ?>">
            <input type="text" name="name" placeholder="Name" value="<?php echo $update_name; ?>" required>
            <input type="email" name="email" placeholder="Email" value="<?php echo $update_email; ?>" required>
            <br>
            <?php if($update_id): ?>
                <button type="submit" name="update" class="btn-update">Update Student</button>
            <?php else: ?>
                <button type="submit" name="add">Add Student</button>
            <?php endif; ?>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td class="actions">
                    <a href="index.php?edit=<?php echo $row['id']; ?>" class="edit">Edit</a>
                    <a href="index.php?delete=<?php echo $row['id']; ?>" class="del" onclick="return confirm('Delete this record?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>