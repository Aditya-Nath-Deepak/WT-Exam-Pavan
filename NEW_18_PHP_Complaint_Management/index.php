<!DOCTYPE html>
<html>
<head>
    <title>Complaint System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Register Complaint</h2>

    <form action="submit.php" method="POST">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Email" required>

        <select name="organization">
            <option value="PMC">PMC</option>
            <option value="PMT">PMT</option>
            <option value="Other">Other</option>
        </select>

        <textarea name="complaint" placeholder="Enter your complaint" required></textarea>

        <button type="submit">Submit Complaint</button>
    </form>

    <br>
    <a href="view.php">View Complaints</a>
</div>

</body>
</html>