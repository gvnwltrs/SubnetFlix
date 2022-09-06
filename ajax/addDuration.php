<?php
require_once("../includes/config.php"); 

if(isset($_POST["videoId"]) && isset($_POST["username"])) {
    // using this to check if row exists for current user and video 
    $query = $connection->prepare("SELECT * FROM videoProgress WHERE videoId=:videoId AND username=:username" ); 
    $query->bindValue(":videoId", $_POST["videoId"]); 
    $query->bindValue(":username", $_POST["username"]); 
    $query->execute(); 

    // if the user/video entry doesn't exist, make it now 
    if($query->rowCount() == 0) {
        $query = $connection->prepare("INSERT INTO videoProgress (username, videoId)
                                        VALUES(:username, :videoId)"); 
            $query->bindValue(":videoId", $_POST["videoId"]); 
            $query->bindValue(":username", $_POST["username"]); 
            $query->execute(); 
    }
}
else {
    echo "No videoId or username passed into file"; 
}
?>