<?php
    $serveris = "localhost";
    $lietotajs = "grobina1_cariks";
    $parole = "21LnaFGk!";
    $db = "grobina1_cariks";
    
    $savienojums = mysqli_connect($serveris, $lietotajs, $parole, $db);

    if(!$savienojums){
        die("Connection failed: " . mysqli_connect_error());
    }

    // Coding
    mysqli_set_charset($savienojums, "utf8mb4");
?>