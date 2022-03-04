<?php

require_once ("db.php");
$query = $conn->query("SELECT id,SensorName, location, value1, reading_time FROM sensor_data ORDER BY id DESC LIMIT 100"); 
 
if($query->num_rows > 0){ 
    $delimiter = ","; 
    $filename = "temperature_data.csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array('ID', 'SENSOR NAME','LOCATION','Temperature','READING TIME'); 
    fputcsv($f, $fields, $delimiter); 
     
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = $query->fetch_assoc()){ 
        // $status = ($row['status'] == 1)?'Active':'Inactive'; 
        $lineData = array($row['id'], $row['SensorName'], $row['location'], $row['value1'], $row['reading_time']); 
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    // Move back to beginning of file 
    fseek($f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f); 
    
} 
exit; 






?>