<?php
    include("connectDB.php");
    $result = mysqli_query($connectDB, "SELECT * FROM labroom WHERE TIME_FORMAT(idTime, '%H:%i') IN ('06:00', '09:00', '12:00', '15:00', '17:00', '19:00', '21:00', '24:00', '03:00')");
    $row = mysqli_fetch_array($result);

    $temp[] = $row["Temp"];
    $humid[] = $row["Humid"];
    $time[] = $row["idTime"];

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            array_push($temp, $row["Temp"]);
            array_push($humid, $row["Humid"]);
            array_push($time, $row["idTime"]);
        }
    }

    // Return the data as JSON
    $data = array("temp" => $temp, "humid" => $humid, "time" => $time);
    echo json_encode($data);

?>





