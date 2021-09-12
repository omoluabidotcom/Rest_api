<?php

class Category{

    private $table = 'categories';
    private $pdo;

    public $id;
    public $name;
    public $created_at;

    public function __construct($db) {

        $this->pdo = $db;
    }

    public function read() {

        $query ='SELECT 
                    id,
                    name,
                    created_at
                FROM ' . 
                   $this->table . '
                ORDER BY
                    created_at' ;

        $stmt = $this->pdo->prepare($query);

        $stmt->execute;
        
        return $stmt;
    }

}

?>