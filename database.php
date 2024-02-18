<?php

    $hostName = "tiki-taki-tow-server.mysql.database.azure.com";
    $dbUser = "tikitakitowadmin123";
    $dbPassword = "WebProg_2023";
    $dbName = "tiki_taki_tow_db";
    $conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
    if(!$conn) {
        die("Something went wrong!");
    }
    
    ?>
