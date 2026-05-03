<?php
$conn = new mysqli('localhost', 'root', '', 'attendance');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['register'])) {
        $name = $_POST['name'];
        $roll = $_POST['roll'];
        $conn->query("INSERT INTO students(name, roll) VALUES ('$name', '$roll')");
    }

    elseif (isset($_POST['attendance'])) {
        if (isset($_POST['present'])) {
            foreach ($_POST['present'] as $id) {
            $check = $conn->query("SELECT * FROM attendance 
            WHERE student_id = $id AND date = CURDATE()");

            if ($check->num_rows == 0) {
                $conn->query("INSERT INTO attendance(student_id, date) VALUES ($id, CURDATE())");
            }
          }
            echo "Attendance marked!";
        }
    }
}

$students = $conn->query("SELECT * FROM students");

$report = $conn->query("SELECT students.roll, students.name, attendance.date
FROM attendance
JOIN students ON attendance.student_id = students.id");
?>

<!DOCTYPE html>
<html>
   <head>
        <title>Attendance System</title>
   </head>
    <body>
            <h1>Attendance Management System</h1>
                <h2>Student Registration</h2>
                <form method="POST">
                    Name: <input name="name" required><br><br>
                    Roll No: <input name="roll" required><br><br>
                    <button name="register" type="submit">Register</button>
                </form>

                 <hr>

            <h2>Teacher Attendance Panel</h2>
                <form method="POST">
                    <?php while($row = $students->fetch_assoc()): ?>
                    <input type="checkbox" name="present[]" value="<?= $row['id'] ?>">
                    <?= $row['roll'] ?> - <?= $row['name'] ?><br>
                    <?php endwhile; ?>
                    <br>
                    <button name="attendance" type="submit">Submit Attendance</button>
                </form>

            <hr>
            <h2>Attendance Report</h2>
                <?php while($row = $report->fetch_assoc()): ?>
                <?= $row['roll'] ?> - <?= $row['name'] ?> - <?= $row['date'] ?><br>
                    <?php endwhile; ?>
    </body>
</html>