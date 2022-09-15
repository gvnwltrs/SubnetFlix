<?php
class User {
    private $connection, $sqlData; 

    public function __construct($connection, $username) {
        $this->connection = $connection; 
        
        $query = $connection->prepare("SELECT * FROM users WHERE username=:username");
        $query->bindValue(":username", $username); 

        $query->execute(); 

        $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getFirstName() {
        return $this->sqlData["firstName"]; 
    }

    public function getLastName() {
        return $this->sqlData["lastName"]; 
    }
    
    public function getEmail() {
        return $this->sqlData["email"]; 
    }
}
?>