<?php
session_start();

// Initialize the airplane grid (10 rows, 4 seats per row: A, B, C, D)
$rows = 10;
$cols = ['A', 'B', 'C', 'D'];

// Initialize booked seats in the session if not already set
if (!isset($_SESSION['booked_seats'])) {
    $_SESSION['booked_seats'] = [];
}

// Handle Seat Booking
$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['book_seat'])) {
        $selected_seat = $_POST['book_seat'];
        
        if (!in_array($selected_seat, $_SESSION['booked_seats'])) {
            $_SESSION['booked_seats'][] = $selected_seat;
            $message = "Seat $selected_seat successfully booked!";
        }
    }

    // Handle Reset
    if (isset($_POST['reset'])) {
        $_SESSION['booked_seats'] = [];
        $message = "All bookings have been cleared.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Airplane Seat Booking</title>
    <style>
        body { font-family: sans-serif; background: #f4f4f9; text-align: center; }
        .airplane-map { 
            display: inline-block; 
            background: #fff; 
            padding: 20px; 
            border-radius: 50px 50px 10px 10px; 
            border: 2px solid #ccc;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .row { display: flex; justify-content: center; margin-bottom: 5px; }
        .seat {
            width: 40px;
            height: 40px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.2s;
        }
        .available { background-color: #2ecc71; color: white; }
        .available:hover { background-color: #27ae60; transform: scale(1.1); }
        .booked { background-color: #e74c3c; color: white; cursor: not-allowed; }
        .aisle { width: 30px; }
        .status-msg { color: #2980b9; font-weight: bold; margin-bottom: 20px; }
        .reset-btn { margin-top: 20px; padding: 10px 20px; background: #34495e; color: #fff; border: none; cursor: pointer; border-radius: 5px; }
    </style>
</head>
<body>

    <h1>Airplane Seating Chart</h1>
    
    <?php if ($message): ?>
        <p class="status-msg"><?php echo $message; ?></p>
    <?php endif; ?>

    <div class="airplane-map">
        <form method="POST">
            <?php for ($i = 1; $i <= $rows; $i++): ?>
                <div class="row">
                    <?php foreach ($cols as $index => $col): 
                        $seatID = $i . $col;
                        $isBooked = in_array($seatID, $_SESSION['booked_seats']);
                        
                        // Add an aisle between column B and C
                        if ($index === 2) echo '<div class="aisle"></div>';
                    ?>
                        <button type="submit" 
                                name="book_seat" 
                                value="<?php echo $seatID; ?>" 
                                class="seat <?php echo $isBooked ? 'booked' : 'available'; ?>"
                                <?php echo $isBooked ? 'disabled' : ''; ?>>
                            <?php echo $seatID; ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            <?php endfor; ?>
            
            <br>
            <button type="submit" name="reset" class="reset-btn">Reset All Bookings</button>
        </form>
    </div>

    <p>
        <strong>Total Booked:</strong> <?php echo count($_SESSION['booked_seats']); ?> / <?php echo $rows * count($cols); ?>
    </p>

</body>
</html>