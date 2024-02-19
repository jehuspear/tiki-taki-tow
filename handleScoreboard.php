<?php
    session_start();
    require_once "database.php"; // Include your database connection script
    
    // Retrieve data from the POST request
    $player_ID = $_POST['player_ID'];
    $playerName = $_POST['playerName'];
    $opponentName = $_POST['opponentName'];
    $playerScore = $_POST['playerScore'];
    $opponentScore = $_POST['opponentScore'];
    $winnerName = $_POST['winnerName'];
    // DATE TIME
    date_default_timezone_set('Asia/Manila');

    $currentDateTime = date("m-d-Y g:i:s A");
    // SCORE
    $score = "$playerScore - $opponentScore";

    // Insert data into the database
    
    
    // Define the SQL query
    $sql = "INSERT INTO scoreboard_ai_tbl (player_ID, Username, Opponent_Name, Match_Date, Score, Winner_Name) VALUES (?, ?, ?, ?, ?, ?)";

    // Initialize a statement object
    $stmt = mysqli_stmt_init($conn);

    // Prepare the SQL statement
    if (mysqli_stmt_prepare($stmt, $sql)) {
        // Bind parameters to the statement
        mysqli_stmt_bind_param($stmt, "ssssss", $player_ID, $playerName, $opponentName, $currentDateTime, $score, $winnerName);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Check if the query executed successfully
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "<div class='d-flex justify-content-center alert alert-success'> GAME HAS BEEN RECORDED IN DATABASE </div>";
        } else {
            echo "<div class='d-flex justify-content-center alert alert-danger'> Failed to record the game in the database </div>";
        }
    } else {
        echo "<div class='d-flex justify-content-center alert alert-danger'> Error: " . mysqli_error($conn) . "</div>";
    }

    // // Close the statement and database connection
    // mysqli_stmt_close($stmt);
    // mysqli_close($conn);
    echo "Hello WORLD";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample Form</title>
</head>
<body>
    <h1>Sample Form</h1>
</body>
</html>
