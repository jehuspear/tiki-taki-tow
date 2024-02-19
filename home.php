<?php
    session_start();
    if(!isset($_SESSION["users"]))
    {
        // header("Location: welcome.php");
        $userName = "Guest";
        $loginPlayerId = "NULL";

    }else{
      require_once "database.php";
      // get session variables
      $loginPlayerId = $_SESSION["sess-playerId"];  
  
      // Getting the Player Information at the Database
      $queryGetUser = "SELECT * FROM players_info_tbl WHERE player_ID = '$loginPlayerId' ";
  
      $result = mysqli_query($conn, $queryGetUser);
      $playerDetails = mysqli_fetch_array($result, MYSQLI_ASSOC);
  
      $userName = $playerDetails["Username"];
      $lastName = $playerDetails["Last_Name"];
      $firstName = $playerDetails["First_Name"];
    }

 

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="images/logo-tab.png">
  <script>
    function redirectToAnotherTab() {
      // Replace 'https://example.com' with the URL you want to redirect to
      var newTabUrl = 'https://tiki-taki-tow.azurewebsites.net/index.php';

      // Open a new tab with the specified URL
      window.open(newTabUrl, 'https://tiki-taki-tow.azurewebsites.net/index.php');
    }
  </script>
</head>
<body>
  <!-- Your existing HTML content -->

  <!-- Add a button or trigger to initiate the redirection -->
  <button onclick="redirectToAnotherTab()">Redirect to Another Tab</button>

  <!-- Add more content as needed -->
</body>
</html>
  <!-- FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap" rel="stylesheet">

  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

  <!-- EXTERNAL CSS -->
  <link href="Style.css" rel="stylesheet" type="text/css" /> 



  <title>Tiki Taki Tow</title>
</head>
<body>
<video autoplay muted loop id="video-bg">
        <source src="Video/Background.mp4" type="video/mp4">
</video>
    
<!-- THE NAVIGATION BAR  SIDE -->
<nav class="navbar navbar-expand-lg fixed-top" style="background: #1d2d44; color: #f0ebd8; ">
  
        <div class="container-fluid">

              <!-- VIEW SCOREBOARD BUTTON -->
            <div class="text-left" style="padding: 10px; margin-bottom: 10px;">
                  <a class="btn strtbtn" href="scoreboard.php" target="_blank" style="color: #f0ebd8; font-size:30px;" >
                  View Scoreboard
                  </a>
            </div>   
            
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
                            <li><a class="dropdown-item" id="music" onclick="music()">Music Off</a></li>
                            <li><a class="dropdown-item" href="logout.php">LOG OUT</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<!-- END OF NAV BAR -->


<br><br><br><br>


<!-- LOGO PIC -->
<div class="image-container" onclick="location.reload()" title="Homepage" style="cursor:pointer" draggable="false">
    <img src="images/TTTLogo.png" id="logo" draggable="false">
</div>

<!-- Select Opponent Page -->
  <form id="select">
    <h2>Select Opponent</h2>
    <label>
      <input type="radio" name="opponent" value="player"> Player
    </label>
    <label>
      <input type="radio" name="opponent" value="ai"> AI
    </label>
    <button type="button" id="okButton" onclick="okGame()">Done</button>
    <h5 style="text-align: center; margin-top: 20px;">MECHANICS:<br>Players take turns putting their marks in empty squares.<br>The first player to get 3 marks in a row<br>(up, down, across, or diagonally) is the winner.</h5>
  </form>

    <!-- SELECT COMPTUTER AI DIFFICULTY  -->
  <form id="difficultyForm" style="display: none;">
    <h2>Select AI Difficulty</h2>
    <label>
      <input type="radio" name="difficulty" value="Easy"> Easy
    </label>
    <label>
      <input type="radio" name="difficulty" value="Difficult"> Difficult
    </label>
    <label>
      <input type="radio" name="difficulty" value="Expert"> Expert
    </label>
    <button type="button" id="startButton" onclick="startGame()" class="strtbtn">Start Game</button>
  </form>
  <div id="Score">
  <h4 id="scores" style="margin: auto;">X - 0  | O - 0 | Draw - 0</h4>
  <div id="playerTurn"></div>
  </div>
    
  <!-- POP UP BOX -->
  <div id="popup" class="popup-container text-center">
    <div class="popup-content">
      <div id="popup-message"></div> <!--Message in the pop up box-->
      <button onclick="closePopup()">OK</button>
    </div>
  </div>

  <!-- TIKI TAKI TOE BOARD -->
  <table id="ticTacToeGrid" style="display: none;">
    <tbody>
      <tr>
        <td onclick="makeMove(this)"></td><td onclick="makeMove(this)"></td><td onclick="makeMove(this)"></td><td onclick="makeMove(this)"></td><td onclick="makeMove(this)"></td><td onclick="makeMove(this)"></td>
      </tr>
      <tr>
        <td onclick="makeMove(this)"></td><td onclick="makeMove(this)"></td><td onclick="makeMove(this)"></td><td onclick="makeMove(this)"></td><td onclick="makeMove(this)"></td><td onclick="makeMove(this)"></td>
      </tr>
      <tr>
        <td onclick="makeMove(this)"></td><td onclick="makeMove(this)"></td><td onclick="makeMove(this)"></td><td onclick="makeMove(this)"></td><td onclick="makeMove(this)"></td><td onclick="makeMove(this)"></td>
      </tr>
      <tr>
        <td onclick="makeMove(this)"></td><td onclick="makeMove(this)"></td><td onclick="makeMove(this)"></td><td onclick="makeMove(this)"></td><td onclick="makeMove(this)"></td><td onclick="makeMove(this)"></td>
      </tr>
      <tr>
        <td onclick="makeMove(this)"></td><td onclick="makeMove(this)"></td><td onclick="makeMove(this)"></td><td onclick="makeMove(this)"></td><td onclick="makeMove(this)"></td><td onclick="makeMove(this)"></td>
      </tr>
    </tbody>
  </table>



  <div id="Score">
    <h4 style= "text-align: center" id="rounds">Round No:</h4>
    <button style="display: none;" id="backAi" onclick="showAiBoard()">Back</button>
    <button style="display: none;" id="back" onclick="goHome()">Back</button>
    <button style="display: none;" id="resetB" onclick="resetScore()">Restart</button>
  </div>

    <!-- Footer -->
    <footer class="text-center">
    <div class="container">
      <h6 style="text-align: center" id="group">&copy ALL RIGHTS RESERVED<br>GROUP HALATA</h6>
    </div>
  </footer>
  <!-- End of Footer -->

  <!-- Hidden input fields to store PHP session variables -->
<input type="hidden" id="userName" value="<?php echo $userName; ?>">
<input type="hidden" id="playerID" value="<?php echo $loginPlayerId; ?>">

<!-- EXTERNAL JAVASCRIPT -->
<script src="javascript.js"></script>
</body>
</html>
