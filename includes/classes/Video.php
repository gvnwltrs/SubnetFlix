<?php
class Video {
    private $connection, $sqlData, $entity;

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

        $this->entity = new Entity($connection, $this->sqlData["entityId"]); 
    }
}
?>