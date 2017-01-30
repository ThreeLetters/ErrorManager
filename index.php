<?php
include("SQLHandler.php");

if (isset($_POST["message"]) && isset($_POST["stack"])) {
 $connector = new SQLConnector();
   $ip = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']); // ip
    
    $toSend = [];
    
    $toSend["message"] = (string)$_POST["message"];
     $toSend["stack"] = (string)$_POST["stack"];
     $toSend["ip"] = (string)$_POST["ip"];
    
    $connector->insert("Errors",$toSend); // insert into table
    
    
    $manager = $connector->query("SELECT * FROM `ErrMsgs` WHERE `error` = '".  $toSend["message"]."'"); // Search through list
    
    $row = $manager->next(); // get row
    
    if ($row) {
    echo $row["message"];    // if row is valid, then echo message
    }
    
     $connector->close(); //close connection
    
}

?>