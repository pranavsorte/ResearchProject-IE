<?php

$con = mysqli_connect("localhost","root","","esp32");

$result = mysqli_query($con, "SELECT id, SensorName,location,value1,value2,value3 FROM sensor_data");

$rows = array();
while($row= mysqli_fetch_array($result)){
    $rows [] = $row;

}

echo json_encode($rows);



?>