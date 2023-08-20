<?php
    include("connectDB.php"); // koneksi ke database
    // mengambil data terbaru
    $result = mysqli_query($connectDB, "SELECT * FROM labroom ORDER BY id DESC LIMIT 1"); 
    $row = mysqli_fetch_array($result);

    $temp[] = $row["Temp"]; // memasukkan data temperatur ke dalam array
    $humid[] = $row["Humid"]; // memasukkan data kelembaban ke dalam array
    $time[] = $row["idTime"]; // memasukkan data waktu ke dalam array

    $data = array("temp" => $temp, "humid" => $humid, "time" => $time); // memasukkan data ke dalam array
    echo json_encode($data); // mengembalikan data dalam bentuk JSON

?>
