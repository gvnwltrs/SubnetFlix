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

        // TODO: add subtitle

        return "<div class='previewContainer'>
                    <img src='$thumbnail' class='previewImage' hidden>

                    <video autoplay muted class='previewVideo' onended='previewEnded()'>
                        <source src='$preview' type='video/mp4'> 
                    </video>

                    <div class='previewOverlay'>
                        <div class='mainDetails'>
                            <h3>$name</h3>
                            <div class='buttons'>
                                <button><i class='fa-solid fa-play'></i> Play</button>
                                <button onclick='volumeToggle(this)'><i class='fa-solid fa-volume-xmark'></i></button>
                            </div>
                        </div>

                        
                    </div>
                </div>"; 
    }

    private function getRandomEntity() {

        $query = $this->connection->prepare("SELECT * FROM entities ORDER BY RAND() LIMIT 1");
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);  

        return new Entity($this->connection, $row);
    }
}

?> 