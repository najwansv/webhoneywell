<?php
    $username = "root"; // username database
    $host = "localhost"; // host database
    $password = ""; // password database
    $database = "honeywelldb"; // nama database

    // membuat koneksi
    $connectDB = mysqli_connect($host, $username, $password, $database);

    if(mysqli_connect_errno()){ // jika koneksi gagal
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

?>