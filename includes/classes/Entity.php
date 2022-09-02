<?php
class Entity {

    private $connection, $sqlData;

    public function __construct($connection, $input) {

        $this->connection = $connection;

        if(is_array($input)) {
            $this->sqlData = $input;
        }
        else { // assuming specific entity ID is being selected 
            $query = $this->connection->prepare("SELECT * FROM entities WHERE id=:id");
            $query->bindValue(":id", $input); 
            $query->execute();

            $this->sqlData = $query->fetch(PDO::FETCH_ASSOC); 
        }
    }

    public function getId() {
        return $this->sqlData["id"]; 
    }

    public function getName() {
        return $this->sqlData["name"]; 
    }

    public function getThumbnail() {
        return $this->sqlData["thumbnail"]; 
    }

    public function getPreview() {
        return $this->sqlData["preview"]; 
    }

    public function getSeasons($entity) {
        $query = $this->connection->prepare("SELECT * FROM videos WHERE entityId=:id
        AND isMovie=0 ORDER BY season, episode ASC"); 
        $query->bindValue(":id", $this->getId()); 
        $query->execute(); 

        $seasons = array(); 
        $videos = array(); 
        $currentSeason = null;

        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            if($currentSeason != null && $currentSeason != $row["season"]) {
                $seasons[] = new Season($currentSeason, $videos); 
                $videos = array(); 
            }

            $currentSeason = $row["season"]; 
            $videos[] = new Video($this->connection, $row);
        }

        // if only 1 season do this 
        if(sizeof($videos) != 0) {
            $seasons[] = new Season($currentSeason, $videos); 
        }

        return $seasons; 
    }
}
?>