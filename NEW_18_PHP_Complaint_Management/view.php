<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>All Complaints</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
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

<?php
$result = $conn->query("SELECT * FROM complaints ORDER BY id DESC");

while($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['organization']}</td>
            <td>{$row['complaint']}</td>
            <td>{$row['status']}</td>
            <td>";

    if ($row['status'] == 'Pending') {
        echo "<a href='update.php?id={$row['id']}' 
                onclick=\"return confirm('Mark as completed?')\">
                Mark Completed
              </a>";
    } else {
        echo "Completed";
    }

    echo "</td></tr>";
}
?>

    </table>

    <br>
    <a href="index.php">Back</a>
</div>

</body>
</html>