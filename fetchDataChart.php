<?php
    include("connectDB.php");
    $result = mysqli_query($connectDB, "SELECT * FROM labroom ORDER BY id DESC LIMIT 10");
    $row = mysqli_fetch_array($result);

    $temp = $row["Temp"];
    $humid = $row["Humid"];
    $time = $row["idTime"];

    // Return the data as JSON
    $data = array("temp" => $temp, "humid" => $humid, "time" => $time);
    echo json_encode($data);

?>





