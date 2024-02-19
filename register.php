<?php
     session_start();
     if(isset($_SESSION["users"]))
     {
         header("Location: index.php");
     }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>

    <!-- BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Style.css">
</head>
<body>

<a href="index.php">
<div class="image-container" onclick="location.reload()" title="Homepage" style="cursor:pointer" draggable="false">
    <img src="images/TTTLogo.png" id="logo" draggable="false">
</div>
</a>

    <div class="container" style="width: 25vw;">
    <?php
    
        if (isset($_POST["submit"])) {
            $LastName = $_POST["LastName"];
            $FirstName = $_POST["FirstName"];
            $Username = $_POST["Username"];
            $password = $_POST["password"];
            $RepeatPassword = $_POST["repeat_password"];

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $errors = array(); 
            // echo "$LastName";
       

            // VALIDATE IF ALL FIELD ARE EMPTY
            if(empty($LastName) OR empty($FirstName) OR empty($Username) OR empty($password) OR empty($RepeatPassword)) {
                array_push($errors, "All Fields are required");
            }


            // VALIDATE IF PASSWORD IS NOT LESS THAN 8 CHARACTERS
            if (strlen($password)<8) {
                array_push($errors, "Password must be at least 8 characters long");
            }
            
            // VALIDATE IF THE RE-ENTERED PASSWORD IS THE SAME
            if ($password != $RepeatPassword){
                array_push($errors, "Password does not match");
            }

            //CHECK IF THE EMAIL in the DATABASE is already taken
            require_once "database.php";
            $sql = "SELECT * FROM players_info_tbl WHERE Username = '$Username' ";
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);
            if($rowCount>0){
                array_push($errors, "Username Already Exist!");
            }

            
            // SHOW ERRORS
            if (count($errors)>0){
                foreach($errors as $error){
                    echo "<div class='d-flex justify-content-center alert alert-danger'>$error</div>";
                } 
            }else{
                // INSERT TO DATABASE
                require_once "database.php";
                $sql = "INSERT INTO players_info_tbl (Last_Name, First_Name, Username, Password) VALUES (?, ?, ?, ?)";                
                $stmt = mysqli_stmt_init($conn); // Initializes a statement and returns an object suitable for mysqli_stmt_preprare()
                $preparestmt = mysqli_stmt_prepare($stmt, $sql);
                    if ($preparestmt){
                        mysqli_stmt_bind_param($stmt, "ssss", $LastName, $FirstName, $Username, $passwordHash);
                        mysqli_stmt_execute($stmt);
                        echo "<div class='d-flex justify-content-center alert alert-success'> You are Registered Successfully! </div>";
                    } else {
                        die("Something went wrong");
                    }
                }
       }         
    ?>
        <!-- FORM PAGE -->
        <form action="register.php" method="post">
            <!-- LASTNAME -->
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="LastName" placeholder="Enter your Last Name: " >
            </div>
            <!-- FIRSTNAME -->
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="FirstName" placeholder="Enter your First Name: " >
            </div>
            <!-- EMAIL -->
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="Username" placeholder="Enter your Username: " >
            </div>
            <!-- PASSWORD -->
            <div class="form-group mb-3">
                <input type="password" id="password" class="form-control" name="password" placeholder="Enter your Password: " >
                <!-- <i class="bi bi-eye-slash" id="togglePassword"></i> -->
            </div>
            <!-- RE-ENTER PASSWORD -->
            <div class="form-group mb-3">
                <input type="password" class="form-control" name="repeat_password" placeholder="Re-Enter Password: " >
            </div>

            <!-- SUBMIT BUTTON -->
            <div class="form-group">
                <input type="submit" class="btn strtbtn" name="submit" placeholder="Submit: ">
            </div>
</form>

        <!-- GO TO LOGIN PAGE -->
        <br>
        <div class="d-flex justify-content-center"><p>Already Registered?  <a href="login.php"> Log In Here</a></div>
        <div class="d-flex justify-content-center"><a href="index.php" class="btn" id="back">Back</a> </div>

</div>

</body>
</html>
