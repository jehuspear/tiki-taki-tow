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
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel ="stylesheet" href = "Style.css">
</head>
<body>

<a href="index.php">
<div class="image-container" onclick="location.reload()" title="Homepage" style="cursor:pointer" draggable="false">
    <img src="images/TTTLogo.png" id="logo" draggable="false">
</div>
</a>

    <div class = "container">

    <!-- PHP CODE FOR LOGGING IN -->
        <?php
            if(isset ($_POST["login"])) {
                $username = $_POST["Input_username"];
                $password = $_POST["Input_password"];
                

                //Finding the User in Database
                    require_once "database.php";
                    $sql = "SELECT * FROM players_info_tbl WHERE Username = '$username' ";
                    $result = mysqli_query($conn, $sql);
                    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    if($user) {
                        if(password_verify($password, $user["Password"])) {
                            $_SESSION["users"] = "yes";
                            $_SESSION["sess-playerId"] = $user["player_ID"];
                            header("Location: home.php");
                            die();
                        }  else {
                            echo "<div class = 'alert alert-danger'> Password does not match </div>";
                        }
                    } else {
                        echo "<div class = 'alert alert-danger'> Username does not match </div>";
                    }
            }
        ?>

        <form action = "login.php" method = "post">
           
            <div class = "form-group">
                <label for = "email"> Username: </label>
                <input type="text" name = "Input_username" class = "form-control" required>
            </div>
 
            <div class = "form-group">
                <label for = "password"> Password:</label>
                <input type = "password" name = "Input_password" class = "form-control" required>
            </div>
 
            <div class = "form-btn">
                <input type ="submit" value ="Login" name ="login" class = "btn strtbtn">
            </div>
 
        </form>

        <!-- GO TO REGISTRATION FORM -->
        <br>
        <div class="d-flex justify-content-center"><p>Not Registered yet? <a href="register.php"> Register Here</a></div>

        <div class="d-flex justify-content-center"><a href="index.php" class="btn" id="back">Back</a> </div>
     

    </div>
</body>
</html>
