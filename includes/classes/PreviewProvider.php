<?php
class PreviewProvider {

    private $connection, $username; 

    public function __construct($connection, $username) {
        $this->connection = $connection; 
        $this->username = $username; 
    }

    public function createPreviewVideo($entity) {
        if($entity == null) {
            $entity = $this->getRandomEntity(); 
        }

        $id = $entity->getId(); 
        $name = $entity->getName(); 
        $thumbnail = $entity->getThumbnail(); 
        $preview = $entity->getPreview(); 

        $videoId = VideoProvider::getEntityVideoForUser($this->connection, $id, $this->username); 
        $video = new Video($this->connection, $videoId); 

        $inProgress = $video->isInProgress($this->username); 
        $playButtonText = $inProgress ? "Continue watching" : "Play"; 

        $seasonEpisode = $video->getSeasonAndEpisode(); 
        $subHeading = $video->isMovie() ? "" : "<h4>$seasonEpisode</h4>"; 

        return "<div class='previewContainer'>
                    <img src='$thumbnail' class='previewImage' hidden>

                    <video autoplay muted class='previewVideo' onended='previewEnded()'>
                        <source src='$preview' type='video/mp4'> 
                    </video>

                    <div class='previewOverlay'>
                        <div class='mainDetails'>
                            <h3>$name</h3>
                            $subHeading
                            <div class='buttons'>
                                <button onclick='watchVideo($videoId)'><i class='fa-solid fa-play'></i> $playButtonText</button>
                                <button onclick='volumeToggle(this)'><i class='fa-solid fa-volume-xmark'></i></button>
                            </div>
                        </div>

                        
                    </div>
                </div>"; 
    }

    public function createEntityPreviewSquare($entity) {
        $id = $entity->getId();
        $thumbnail = $entity->getThumbnail();
        $name = $entity->getName();

        return "<a href='entity.php?id=$id'>
                    <div class='previewContainer small'>
                        <img src='$thumbnail' title='$name'>
                    </div>
                </a>"; 
    }

    private function getRandomEntity() {
       $entity = EntityProvider::getEntities($this->connection, null, 1); 
       return $entity[0]; 
    }
}

?> 