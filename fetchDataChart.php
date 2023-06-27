<?php
include("connectDB.php");

$result = mysqli_query($connectDB, "SELECT * FROM labroom ORDER BY id DESC LIMIT 6");

$idTime = array();
$temps = array();
$humid = array();

while ($row = mysqli_fetch_array($result)) {
    $idTime[] = $row["idTime"];
    $temps[] = $row["Temp"];
    $humid[] = $row["Humid"];
}

// Prepare the data as an associative array
$responseData = array(
    'times' => array_reverse($idTime),
    'temps' => array_reverse($temps),
    'humid' => array_reverse($humid)
);

// Set the response content type to JSON
header('Content-Type: application/json');

// Convert the data to JSON format and echo it
echo json_encode($responseData);

// Close the database connection
mysqli_close($connectDB);
?>
