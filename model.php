<?php

class Model
{
    private string $table;

    private $dbConnection;

    public function __construct(string $table) {
        $this->table = $table;
    }

    private function getDBConnection() {

        $host = 'localhost';
        $db = 'note';
        $username = 'root';
        $password = '';   

        $this->dbConnection = new PDO("mysql:host=$host;dbname=$db", $username, $password);
        // set the PDO error mode to exception
        $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $this->dbConnection;
    
    
    }

    public function create_nots($title, $description, $date, $status)
    {
        $stmt = $this->getDBConnection()->prepare("INSERT INTO $this->table (title,description,date,done) VALUES (:title,:description,:date,:status)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }

    public function create($name ,$email , $password_hash)
    {
        $stmt = $this->getDBConnection()->prepare("INSERT INTO $this->table (name, email, password) VALUES (:name,:email,:hash_password)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':hash_password', $password_hash);
        return $stmt->execute();
    }

    public function first($key, $value )
    {
        $stmt = $this->getDBConnection()->query("SELECT * FROM $this->table  WHERE $key = '$value' LIMIT 1");

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function all() 
    {
        $stmt = $this->getDBConnection()->query("SELECT * FROM $this->table");
        // set the resulting array to associative
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function __destruct() {
        // close connection
        $this->dbConnection = null;
    }
}
