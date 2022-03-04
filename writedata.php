<?php
require_once ("db.php");
$SensorName = isset($_POST['SensorName']) ? $_POST['SensorName'] : "";
$location = isset($_POST['location']) ? $_POST['location'] : "";
$Temperature = isset($_POST['Temperature']) ? $_POST['Temperature'] : "";
$Humidity = isset($_POST['Humidity']) ? $_POST['Humidity'] : "";
$Pressure = isset($_POST['Pressure']) ? $_POST['Pressure'] : "";
//$date = date('Y-m-d H:i:s');

if($_SERVER["REQUEST_METHOD"] == "POST"){				
$sql = "INSERT INTO sensor_data (SensorName,location,value1,value2,value3) VALUES ('" . $SensorName . "','" . $location . "','" . $Temperature . "','" . $Humidity . "','" . $Pressure . "')";
$result = mysqli_query($conn, $sql);
}

else {
    echo "fill all details! Thanks";
}
if (!$result) {
    $result = mysqli_error($conn);
}
echo $result;
?>