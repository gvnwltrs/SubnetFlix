<?php
class EntityProvider {

    static public function getEntities($connection, $categoryId, $limit) {
        $sql = "SELECT * FROM entities "; 
        
        if($categoryId != null) {
            $sql .= "WHERE categoryId=:categoryId "; 
        }
        
        $sql .= "ORDER BY RAND() LIMIT :limit"; 
        $query = $connection->prepare($sql); 
        
        if($categoryId != null) {
            $query->bindValue(":categoryId", $categoryId); 
        }

        $query->bindValue(":limit", $limit, PDO::PARAM_INT); 

        $query->execute(); 

        $result = array(); 

        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new Entity($connection, $row);
        }

        return $result; 

    }
}
?>