<?php

ob_start(); //Turns on output buffering
session_start();

date_default_timezone_set("America/New_York");

try {
    $conn = new PDO("mysql:dbname=syndflix;host=localhost", "root", "Nethalk@123");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}
catch(PDOException $e) {
    exit("Connection failed: " . $e->getMessage());
}


?>