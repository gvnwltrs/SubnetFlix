<?php 
require_once("includes/header.php"); 

//DEBUG
// echo "User logged in is: " . $userLoggedIn; 

$preview = new PreviewProvider($connection, $userLoggedIn); 
echo $preview->createPreviewVideo(null); 
?>

<!-- <a href="register.php">register</a> -->

