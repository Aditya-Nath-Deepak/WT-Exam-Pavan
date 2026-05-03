<?php
// Initialize variables to prevent errors on first load
$bill_amount = '';
$units_consumed = '';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the input and sanitize it
    $units_consumed = filter_input(INPUT_POST, 'units', FILTER_VALIDATE_FLOAT);

    if ($units_consumed !== false && $units_consumed >= 0) {
        $bill_amount = calculate_bill($units_consumed);
    } else {
        $bill_amount = "Invalid Input! Please enter a valid number of units.";
    }
}

// Function to calculate the electricity bill based on tiered pricing
function calculate_bill($units) {
    $tier1_rate = 3.50; // First 50 units
    $tier2_rate = 4.00; // Next 100 units
    $tier3_rate = 5.20; // Next 100 units
    $tier4_rate = 6.50; // Above 250 units

    $bill = 0.0;

    if ($units <= 50) {
        $bill = $units * $tier1_rate;
    } 
    else if ($units <= 150) {
        $tier1_cost = 50 * $tier1_rate;
        $remaining_units = $units - 50;
        $bill = $tier1_cost + ($remaining_units * $tier2_rate);
    } 
    else if ($units <= 250) {
        $tier1_cost = 50 * $tier1_rate;
        $tier2_cost = 100 * $tier2_rate;
        $remaining_units = $units - 150;
        $bill = $tier1_cost + $tier2_cost + ($remaining_units * $tier3_rate);
    } 
    else {
        $tier1_cost = 50 * $tier1_rate;
        $tier2_cost = 100 * $tier2_rate;
        $tier3_cost = 100 * $tier3_rate;
        $remaining_units = $units - 250;
        $bill = $tier1_cost + $tier2_cost + $tier3_cost + ($remaining_units * $tier4_rate);
    }

    // Return the formatted number to 2 decimal places
    return number_format((float)$bill, 2, '.', '');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electricity Bill Calculator</title>
    <!-- Bootstrap CSS for responsive design -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Electricity Bill Calculator</h4>
                </div>
                <div class="card-body p-4">
                    
                    <!-- HTML Form -->
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="mb-3">
                            <label for="units" class="form-label">Total Units Consumed:</label>
                            <input type="number" step="any" class="form-control" name="units" id="units" placeholder="e.g. 120" value="<?php echo htmlspecialchars($units_consumed); ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Calculate Bill</button>
                    </form>

                    <!-- PHP Result Display Area -->
                    <?php if ($bill_amount !== ''): ?>
                        <div class="mt-4 alert <?php echo is_numeric($bill_amount) ? 'alert-success' : 'alert-danger'; ?>" role="alert">
                            <?php if (is_numeric($bill_amount)): ?>
                                <h5 class="alert-heading">Calculation Result</h5>
                                <p class="mb-0">Units Consumed: <strong><?php echo $units_consumed; ?></strong></p>
                                <hr>
                                <p class="mb-0 fs-5">Total Bill: <strong>Rs. <?php echo $bill_amount; ?></strong></p>
                            <?php else: ?>
                                <!-- Error message display -->
                                <?php echo $bill_amount; ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>