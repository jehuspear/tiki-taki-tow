<?php
    session_start();
    require_once "database.php"; //CONNECTION IN DATABASE
    if(!isset($_SESSION["users"]))
    {
        // header("Location: welcome.php");
        $userName = "Guest";
        $loginPlayerId = "NULL";

    }else{
      // require_once "database.php";
      // get session variables
      $loginPlayerId = $_SESSION["sess-playerId"];  
  
      // Getting the Player Information at the Database
      $queryGetUser = "SELECT * FROM players_info_tbl WHERE player_ID = '$loginPlayerId' ";
  
      // $runQuery = mysqli_query($con, $queryGetUser);
      // $arrayUserDetails = mysqli_fetch_assoc($runQuery);
  
      $result = mysqli_query($conn, $queryGetUser);
      $playerDetails = mysqli_fetch_array($result, MYSQLI_ASSOC);
  
      $userName = $playerDetails["Username"];
      $lastName = $playerDetails["Last_Name"];
      $firstName = $playerDetails["First_Name"];
    }

    // Retrieve game results from the database, limiting to 10 rows and sorting by datetime in descending order
    $queryGetGameResults = "SELECT * FROM tiki_taki_tow_db.scoreboard_ai_tbl ORDER BY Match_history_ID DESC LIMIT 10";
    $gameResults = mysqli_query($conn, $queryGetGameResults);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="images/logo-tab.png">
  
  <!-- FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap" rel="stylesheet">

  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  
  
  <!-- EXTERNAL CSS -->
  <link href="Style.css" rel="stylesheet" type="text/css" /> 

  <!-- INTERNAL CSS -->
  <style>
    table {
        width: 100%;
       margin-bottom: 30px;
    }
    th, td {
        padding: 8px;
        text-align: center;
        border-bottom: 1px solid #ddd;
        font-size: 1vw;
    }
  
</style>

  <title>Tiki Taki Tow</title>
</head>
<body>

<!-- View in Cosole the PHP Session Variables -->
<script>
  var userName = "<?php echo $userName; ?>";
  var playerID = "<?php echo $loginPlayerId; ?>";

  // Now you can use these JavaScript variables in your JavaScript code
  console.log("Player ID is " + playerID);
  console.log("Player Name is " + userName);
</script>

<!-- THE NAVIGATION BAR  SIDE -->
<nav class="navbar navbar-expand-lg fixed-top" style="background: #1d2d44; color: #f0ebd8; ">
  
        <div class="container-fluid">
            
            <!-- Player/Guest Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav" >
                <ul class="navbar-nav ms-auto" >
                
                    <li class="nav-item dropdown" >
                        <a class="nav-link dropdown-toggle" style="color: #f0ebd8; font-size:30px;" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Hello, <?php echo $userName?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="logout.php">LOG OUT</a></li>
                            <li><a class="dropdown-item" id="music" onclick="music()">Music Off</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<!-- END OF NAV BAR -->

<br><br><br><br>

<!-- LOGO PIC -->
<!-- <div class="image-container" onclick="location.reload()" title="Homepage" style="cursor:pointer" draggable="false">
    <img src="images/TTTLogo.png" id="logo" draggable="false">
</div> -->

<!-- SHOW SCOREBOARD HERE -->
<h2>SCOREBOARD:</h2>

<table>
  <thead>
    <tr>
      <th>Newest - Oldest</th>
      <th>Date and Time</th>
      <th>Player Name</th>
      <th>Opponent Name</th>
      <th>Score</th>
      <th>Winner</th>
    </tr>
  </thead>
  <tbody>
  <?php 

      $line_counter = 0;
      // Iterate over the retrieved game results and display them in the table
      while ($row = mysqli_fetch_assoc($gameResults)) {
          $line_counter = $line_counter + 1;

          echo "<tr>";
          echo "<td>" . $line_counter . "</td>";
          echo "<td>" . $row['Match_Date'] . "</td>";
          echo "<td>" . $row['Username'] . "</td>";
          echo "<td>" . $row['Opponent_Name'] . "</td>";
          echo "<td>" . $row['Score'] . "</td>";
          echo "<td>" . $row['Winner_Name'] . "</td>";
          echo "</tr>";
      }

    ?>
  </tbody>
</table>


<!-- BACK BUTTON -->
<div class="d-flex justify-content-center"><a href="home.php" class="btn" id="back">Back</a> </div>

    <!-- Footer -->
    <footer class="text-center">
    <div class="container">
      <h6 style="text-align: center; margin-top: 30px;" id="group">&copy ALL RIGHTS RESERVED<br>GROUP HALATA</h6>
    </div>
  </footer>
  <!-- End of Footer -->



  <script src="javascript.js"></script>

</body>
</html>


