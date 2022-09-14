<?php 
require_once("includes/header.php"); 

//DEBUG
// echo "User logged in is: " . $userLoggedIn; 

$preview = new PreviewProvider($connection, $userLoggedIn); 
echo $preview->createMoviePreview();

$containers = new CategoryContainers($connection, $userLoggedIn); 
echo $containers->showMovieCategories();

?>

<!-- <a href="register.php">register</a> -->

