<?php

// connectio class
class Datab{

    // connwction properties
    private $host = 'localhost';
    private $user = 'root';
    private $dbname = 'myblog';
    private $pass = '';
    private $pdo;

    public function connect() {

        $this->pdo = null;

        // connection using PDO
        try {
            
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $e) {
            
            echo 'Connection error' . $e->getMessage();
        }

        // connection is returned in a property
        return $this->pdo;
    }

}

?>