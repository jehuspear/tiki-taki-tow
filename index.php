<?php
    session_start();
    if(isset($_SESSION["users"]))
    {
        header("Location: home.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="images/logo-tab.png">

  <!-- FONTS -->
  <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap" rel="stylesheet"> -->

  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  
  <!-- CSS -->
  <link href="Style.css" rel="stylesheet" type="text/css" /> 



  <title>Tiki Taki Tow</title>
</head>
<body>
    
<video autoplay muted loop id="video-bg">
        <source src="Video/Background.mp4" type="video/mp4">
</video>
    
<div class="image-container" onclick="location.reload()" title="Homepage" style="cursor:pointer" draggable="false">
    <img src="images/TTTLogo.png" id="logo" draggable="false">
</div>

<!-- Home Page-->
<div class="container">
  <div class="text-center">

<!-- LOG IN BUTTON -->
  <a href="login.php" style="text-decoration: none;">
    <button class="strtbtn" style="margin-right: 30px; width: 200px;">Log In</button>
  </a>

<!-- Create an account BUTTON -->
  <a href="register.php" style="text-decoration: none;">
    <button class="strtbtn" style="width: 200px;" >Create an account</button>
    </a>

  <br><br>

  <!-- Play as a Guest Button -->
  <a href="home.php" style="text-decoration: none;">
    <button class="strtbtn" style="width: 200px;" >Play as a Guest</button>
    </a>
  <br><br><br>

  <!-- GAME MECHANICS -->
  <div class="mechanics-section">
  <h5 style="text-align: center; margin-top: 20px;">MECHANICS:<br>Players take turns putting their marks in empty squares.<br>The first player to get 3 marks in a row<br>(up, down, across, or diagonally) is the winner.</h5>
  
  </div>
</div>

    <!-- Footer -->
    <footer class="text-center">
    <div class="container">
      <h6 style="text-align: center" id="group">&copy ALL RIGHTS RESERVED<br>GROUP HALATA</h6>
    </div>
  </footer>
  <!-- End of Footer -->

</body>
</html>
