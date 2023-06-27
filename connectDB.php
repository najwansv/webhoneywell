<?php
    $username = "root";
    $host = "localhost";
    $password = "";
    $database = "honeywelldb";

    // Create connection to the database
    $connectDB = mysqli_connect($host, $username, $password, $database);

    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

?>