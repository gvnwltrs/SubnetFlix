<?php
class CategoryContainers {

    private $connection, $username; 

    public function __construct($connection, $username) {
        $this->connection = $connection; 
        $this->username = $username; 
    }

    public function showAllCategories() {
        $query = $this->connection->prepare("SELECT * FROM categories"); 
        $query->execute(); 

        $html = "<div class='previewCategories'>"; 

        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $html .= $this->getCategoryHtml($row, null, true, true); 
        }

        return $html . "</div>"; 
    }

    public function showCategory($categoryId, $title = null) {
        $query = $this->connection->prepare("SELECT * FROM categories WHERE id=:id"); 
        $query->bindValue(":id", $categoryId); 
        $query->execute(); 

        $html = "<div class='previewCategories noScroll'>"; 

        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $html .= $this->getCategoryHtml($row, $title, true, true); 
        }

        return $html . "</div>"; 
    }

    private function getCategoryHtml($sqlData, $title, $tvShows, $movies) {
        $categoryId = $sqlData["id"]; 
        $title = $title == null ? $sqlData["name"] : $title; 

        if($tvShows && $movies) {
            $entities = EntityProvider::getEntities($this->connection, $categoryId, 30); 
        }
        else if($tvShows) {
            // get tvshow entities 
        }
        else {
            // get movie entities 
        }

        if(sizeof($entities) == 0) {
            return; 
        }

        $entitiesHtml = ""; 
        $previewProvider = new PreviewProvider($this->connection, $this->username); 

        foreach($entities as $entity) {
            $entitiesHtml .= $previewProvider->createEntityPreviewSquare($entity);  
        }

        return "<div class='category'>
                    <a href='category.php?id=$categoryId'>
                        <h3>$title</h3>
                    </a>   

                    <div class='entities'>
                    $entitiesHtml
                    </div>
                </div>"; 
    }

    
}
?>