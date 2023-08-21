<?php
include("connectDB.php"); // koneksi ke database
// mengambil data sql satu jam yang lalu
$result1 = mysqli_query($connectDB, "SELECT * FROM labroom WHERE idTime >= DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 1 HOUR), '%H:%i') ORDER BY idTime DESC LIMIT 1");
// mengambil data terbaru
$result2 = mysqli_query($connectDB, "SELECT * FROM labroom ORDER BY id DESC LIMIT 1");

$row1 = mysqli_fetch_array($result1);
$row2 = mysqli_fetch_array($result2);

$temp1[] = $row1["Temp"]; // memasukkan data temperatur ke dalam array
$humid1[] = $row1["Humid"]; // memasukkan data kelembaban ke dalam array

$temp2[] = $row2["Temp"]; // memasukkan data temperatur ke dalam array
$humid2[] = $row2["Humid"]; // memasukkan data kelembaban ke dalam array

// change to integer
$temp1 = (int)$temp1[0];
$humid1 = (int)$humid1[0];

$temp2 = (int)$temp2[0];
$humid2 = (int)$humid2[0];

// Function to calculate the percentage difference between two numbers
function calculatePercentageDifference($number1, $number2) {
    if ($number1 == 0) {
        // Handle division by zero to avoid errors
        
    }

    $difference = abs($number1 - $number2); // Calculate the absolute difference
    $percentage = ($difference / $number1) * 100; // Calculate the percentage

    $percentage = round($percentage, 2); // round to 2 decimal places

    // change to array

    return $percentage;
}

// Calculate the percentage difference between the two numbers
$percentageTemp = calculatePercentageDifference($temp1,$temp2);
$percentageHumid = calculatePercentageDifference($humid1,$humid2);

$data = array("tempStat" => $percentageTemp, "humidStat" => $percentageHumid); // memasukkan data ke dalam array

echo json_encode($data);
?>
