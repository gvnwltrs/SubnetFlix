<?php 
require_once("includes/config.php"); 
require_once("includes/classes/PreviewProvider.php"); 
require_once("includes/classes/CategoryContainers.php"); 
require_once("includes/classes/EntityProvider.php"); 
require_once("includes/classes/SeasonProvider.php");
require_once("includes/classes/Entity.php"); 
require_once("includes/classes/Video.php");
require_once("includes/classes/Season.php");
require_once("includes/classes/ErrorMessage.php");

if(!isset($_SESSION["userLoggedIn"])) {
    header("Location: register.php"); 
}

$userLoggedIn = $_SESSION["userLoggedIn"]; 

?>

<!DOCTYPE html>
<html>

<head>
    <title>Welcome to SubnetFlix</title>
    <link rel="stylesheet" type="text/css" href="assets/style/style.css" />

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/6703725f77.js" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
</head>

<body>
    <div class="wrapper">

