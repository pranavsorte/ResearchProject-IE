<?php

    $servername = 'localhost';
    // Database name
    $dbname = 'esp32';
    // Database user
    $username = 'root';
    // Database user password
    $password = '';

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    } 
    else 
    {
        //echo "database connected";
    }

    $limit_num = 40;

    $sql = "SELECT id, value1, value2, value3, reading_time FROM sensor_data order by reading_time desc limit " . $limit_num;

    $result = $conn->query($sql);

    while ($data = $result->fetch_assoc())
    {
        $sensor_data[] = $data;
    }

    $readings_time = array_column($sensor_data, 'reading_time');

    // ******* Uncomment to convert readings time array to your timezone ********
    $i = 0;
    foreach ($readings_time as $reading)
    {
        // Uncomment to set timezone to - 1 hour (you can change 1 to any number)
        $readings_time[$i] = date("Y-m-d H:i:s", strtotime("$reading - 5 hours"));
        // Uncomment to set timezone to + 4 hours (you can change 4 to any number)
        //$readings_time[$i] = date("Y-m-d H:i:s", strtotime("$reading + 4 hours"));
        $i += 1;
    }

    $value1 = json_encode(array_reverse(array_column($sensor_data, 'value1')), JSON_NUMERIC_CHECK);
    $value2 = json_encode(array_reverse(array_column($sensor_data, 'value2')), JSON_NUMERIC_CHECK);
    $value3 = json_encode(array_reverse(array_column($sensor_data, 'value3')), JSON_NUMERIC_CHECK);
    $reading_time = json_encode(array_reverse($readings_time), JSON_NUMERIC_CHECK);   
    
    // isset — Determine if a variable is declared and is different than null
    //if (isset($_GET['get_data']))
    if (isset($_POST['get_data']))
    {        
        $data = array(
        'value1'   => $value1,
        'value2'   => $value2,
        'value3'   => $value3,
        'reading_time'   => $reading_time
        );
        echo json_encode($data);
    }    

    $result->free();
    $conn->close();
?>