<?php
    $servername = "localhost";
    $username = "skorepa";
    $password = "YXq.n2-856aHOLC";
    $dbname = "skorepa_shop";
    
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    mysqli_query($conn,"SET NAMES utf8");
    
    
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }




?>