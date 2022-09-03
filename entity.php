<?php
require_once("includes/header.php"); 

if(!isset($_GET["id"])) {
    ErrorMessage::show("No ID passed into page");
}
$id = $_GET["id"]; 
$entity = new Entity($connection, $id); 

$preview = new PreviewProvider($connection, $userLoggedIn); 
echo $preview->createPreviewVideo($entity);

$seasonProvider = new SeasonProvider($connection, $userLoggedIn); 
echo $seasonProvider->create($entity); 

$categoryContainers = new CategoryContainers($connection, $userLoggedIn); 
echo $categoryContainers->showCategory($entity->getCategoryId(), "You might also like");
?>