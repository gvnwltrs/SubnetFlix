<?php

ob_start(); 
session_start();

date_default_timezone_set("America/Detroit"); 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$debug_mode = false;

try {
    $connection = new PDO("mysql:dbname=SubnetFlix;host=localhost", "root", ""); 
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); 
    
    if($connection && $debug_mode) {
        echo "connection to: " . $connection->query('select database()')-> fetchColumn() . " successful"; 
    }
}
catch (PDOException $e) {
    exit("Connection failed: " . $e->getMessage()); 
}
?> 