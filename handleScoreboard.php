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

<!--AJAX DATA HANDLING-->
<?php
   
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

    // Manually Autoincrementing the match_id
    // Getting the  Information of Scoreboard at the Database
    $querylast_match_ID = "SELECT * FROM scoreboard_ai_tbl WHERE match_history_ID = (SELECT MAX(match_history_ID) FROM scoreboard_ai_tbl)";
    $result = mysqli_query($conn, $querylast_match_ID);

    $match_Details = mysqli_fetch_array($result, MYSQLI_ASSOC);
    // Putting the last value of the match_history_ID into a variable and then increment it.
    $old_match_history_ID = $match_Details["match_history_ID"];
    $Username = $match_Details["Username"];
    echo "OLD ID: " + $old_match_history_ID;
 
    $new_match_history_ID = $old_match_history_ID + 1;
    echo "NEW ID: " + $new_match_history_ID;
    // Insert data into the database
    
    // Define the SQL query
    $sql = "INSERT INTO scoreboard_ai_tbl (match_history_ID, player_ID, Username, Opponent_Name, Match_Date, Score, Winner_Name) VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Initialize a statement object
    $stmt = mysqli_stmt_init($conn);

    // Prepare the SQL statement
    if (mysqli_stmt_prepare($stmt, $sql)) {
        // Bind parameters to the statement
        mysqli_stmt_bind_param($stmt, "sssssss", $new_match_history_ID, $player_ID, $playerName, $opponentName, $currentDateTime, $score, $winnerName);

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

    // Close the statement and database connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
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
