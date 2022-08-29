<?php 
class Account {

    private $connection; 
    private $errorArray = array(); 

    public function __construct($connection) {
        $this->connection = $connection; 
    }

    public function register($firstName, $lastName, $username, $email, $email2, $password, $password2) {
        $this->validateFirstName($firstName); 
        $this->validateLastName($lastName); 
        $this->validateUsername($username); 
        $this->validateEmails($email, $email2); 
        $this->validatePasswords($password, $password2); 

        if(empty($this->errorArray)) {
            return $this->insertUserDetails($firstName, $lastName, $username, $email, $password); 
        }
        else {
            return false;
        }
    }

    public function login($username, $password) {
        $password = hash("sha512", $password); 

        $query = $this->connection->prepare("SELECT * FROM users WHERE username=:username AND password=:password"); 
        $query->bindParam(":username", $username);
        $query->bindParam(":password", $password);
        $query->execute(); 

        if($query->rowCount() == 1) {
            return true;
        }

        array_push($this->errorArray, Constants::$loginFailed); 
        return false; 
    }

    private function insertUserDetails($firstName, $lastName, $username, $email, $password) {
        $password = hash("sha512", $password); 

        $query = $this->connection->prepare("INSERT INTO users (firstName, lastName, username, email, password) 
                                            VALUES (:firstName, :lastName, :username, :email, :password)"); 
        $query->bindParam(":firstName", $firstName); 
        $query->bindParam(":lastName", $lastName); 
        $query->bindParam(":username", $username); 
        $query->bindParam(":email", $email); 
        $query->bindParam(":password", $password); 

        return $query->execute(); 
    }

    private function validateFirstName($firstName) {
        if(strlen($firstName) < 2 || strlen($firstName) > 25) {
            array_push($this->errorArray, Constants::$firstNameCharacters); 
        }
    }

    private function validateLastName($lastName) {
        if(strlen($lastName) < 2 || strlen($lastName) > 25) {
            array_push($this->errorArray, Constants::$lastNameCharacters); 
        }
    }

    private function validateUsername($username) {
        if(strlen($username) < 2 || strlen($username) > 25) {
            array_push($this->errorArray, Constants::$usernameCharacters); 
            echo "found error in name length"; 
            return;
        }

        $query = $this->connection->prepare("SELECT * FROM users WHERE username=:username");
        $query->bindValue(":username", $username); 
        $query->execute(); 

        if($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$usernameTaken);  
        }
    }

    private function validateEmails($email, $email2) {
        if($email != $email2) {
            array_push($this->errorArray, Constants::$emailsDoNotMatch);     
            return; 
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constants::$emailInvalid); 
            return; 
        }

        $query = $this->connection->prepare("SELECT * FROM users WHERE email=:email");
        $query->bindValue(":email", $email);
        $query->execute(); 

        if($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$emailTaken);  
        }
    }

    private function validatePasswords($password, $password2) {
        if($password != $password2) {
            array_push($this->errorArray, Constants::$passwordsDoNotMatch);     
            return; 
        }

        if(strlen($password) < 2 || strlen($password) > 25) {
            array_push($this->errorArray, Constants::$passwordLength); 
            return; 
        }
    }

    public function getError($error) {
        if(in_array($error, $this->errorArray)) {
            return "<span class='errorMessage'>$error</span>"; 
        }
    }

}
?>