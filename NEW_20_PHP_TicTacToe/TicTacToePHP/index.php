<?php
session_start();

// Function to check if there is a winner or a tie
function checkWinner($board) {
    $winning_combos = [
        [0, 1, 2], [3, 4, 5], [6, 7, 8], // Rows
        [0, 3, 6], [1, 4, 7], [2, 5, 8], // Columns
        [0, 4, 8], [2, 4, 6]             // Diagonals
    ];

    foreach ($winning_combos as $combo) {
        if ($board[$combo[0]] !== '' && 
            $board[$combo[0]] === $board[$combo[1]] && 
            $board[$combo[1]] === $board[$combo[2]]) {
            return $board[$combo[0]];
        }
    }

    if (!in_array('', $board)) {
        return 'Tie';
    }

    return null;
}

// Initialize or reset game state
if (!isset($_SESSION['board']) || isset($_GET['reset'])) {
    $_SESSION['board'] = array_fill(0, 9, '');
    $_SESSION['player'] = 'X';
    $_SESSION['winner'] = null;
    
    // Redirect after reset to clear URL parameters
    if (isset($_GET['reset'])) {
        header("Location: index.php");
        exit();
    }
}

// Handle a player's move
if (isset($_GET['move']) && $_SESSION['winner'] === null) {
    $move = intval($_GET['move']);
    
    // Check if the move is valid and the cell is empty
    if ($move >= 0 && $move < 9 && $_SESSION['board'][$move] === '') {
        $_SESSION['board'][$move] = $_SESSION['player'];
        $_SESSION['winner'] = checkWinner($_SESSION['board']);
        
        // Switch player if no winner yet
        if ($_SESSION['winner'] === null) {
            $_SESSION['player'] = $_SESSION['player'] === 'X' ? 'O' : 'X';
        }
    }
    header("Location: index.php");
    exit();
}

$board = $_SESSION['board'];
$winner = $_SESSION['winner'];
$currentPlayer = $_SESSION['player'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Tic-Tac-Toe</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="game-container">
        <header>
            <h1>Tic-Tac-Toe</h1>
            <p class="subtitle">Powered by PHP</p>
        </header>

        <div class="status-panel">
            <?php if ($winner === 'Tie'): ?>
                <div class="status tie">It's a Tie! 🤝</div>
            <?php elseif ($winner !== null): ?>
                <div class="status winner">Player <?php echo $winner; ?> Wins! 🎉</div>
            <?php else: ?>
                <div class="status active">Player <?php echo $currentPlayer; ?>'s Turn</div>
            <?php endif; ?>
        </div>

        <div class="board">
            <?php for ($i = 0; $i < 9; $i++): ?>
                <?php 
                    $cellClass = "cell";
                    $cellContent = $board[$i];
                    if ($cellContent === 'X') $cellClass .= " x-mark";
                    if ($cellContent === 'O') $cellClass .= " o-mark";
                    if ($winner !== null || $cellContent !== '') $cellClass .= " disabled";
                ?>
                <?php if ($cellContent === '' && $winner === null): ?>
                    <a href="?move=<?php echo $i; ?>" class="<?php echo $cellClass; ?>"></a>
                <?php else: ?>
                    <div class="<?php echo $cellClass; ?>"><?php echo $cellContent; ?></div>
                <?php endif; ?>
            <?php endfor; ?>
        </div>

        <div class="controls">
            <a href="?reset=1" class="btn-reset">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
                Restart Game
            </a>
        </div>
    </div>
</body>
</html>
