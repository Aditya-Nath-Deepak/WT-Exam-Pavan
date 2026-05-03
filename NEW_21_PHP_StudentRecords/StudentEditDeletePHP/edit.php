<?php
require_once 'config.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = intval($_GET['id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $course = $conn->real_escape_string($_POST['course']);
    
    $stmt = $conn->prepare("UPDATE students SET name=?, email=?, course=? WHERE id=?");
    $stmt->bind_param("sssi", $name, $email, $course, $id);
    
    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    }
    $stmt->close();
}

$stmt = $conn->prepare("SELECT * FROM students WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

if (!$student) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student - <?php echo htmlspecialchars($student['name']); ?></title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container edit-container">
        <header>
            <h1>Edit Student</h1>
            <p>Update information for <?php echo htmlspecialchars($student['name']); ?></p>
        </header>

        <main>
            <section class="card">
                <form method="POST" class="edit-form">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="name" value="<?php echo htmlspecialchars($student['name']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Course</label>
                        <input type="text" name="course" value="<?php echo htmlspecialchars($student['course']); ?>" required>
                    </div>
                    <div class="form-actions">
                        <a href="index.php" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Student</button>
                    </div>
                </form>
            </section>
        </main>
    </div>
</body>
</html>
