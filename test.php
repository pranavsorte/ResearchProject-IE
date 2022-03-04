<?php
$message_received = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $message_received = $_POST["message_sent"];
        echo "Welcome ESP32, the message you sent me is: " . $message_received;
    }
    else {
        echo "Sorry, accepting only POST requests...";
    }
?>