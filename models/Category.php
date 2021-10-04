<?php

class Category{

    // category class properties
    private $table = 'categories';
    private $pdo;
    public $id;
    public $name;
    public $created_at;

    // constructor passing connection into category class
    public function __construct($db) {

        $this->pdo = $db;
    }

    // method to return a data from database
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

        $stmt->execute();
        
        return $stmt;
    }

    // method to return single data from database
    public function read_single() {

        $query = 'SELECT
                    id,
                    name,
                    created_at
                  FROM
                    ' . $this->table . ' 
                  WHERE 
                    id = ?
                  ORDER BY
                    created_at';
  
        $stmt = $this->pdo->prepare($query);
  
        $stmt->bindParam(1, $this->id);
  
        $stmt->execute();
  
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
  
        $this->name = $data['name'];
        $this->created_at = $data['created_at'];
        
      }

      // method to add new data to database
      public function create() {

        $query = 'INSERT INTO 
                    '. $this->table . '
                  SET
                    name = :name';
        
        $stmt = $this->pdo->prepare($query);
  
        $this->name = htmlspecialchars(strip_tags($this->name));
        
        
        $stmt->bindParam(':name', $this->name);
        
        if($stmt->execute()) {
  
          return true;
        } 
          
          return false;
      }

      // method to update of specific data in database
      public function update() {

        $query = 'UPDATE ' . 
                    $this->table . '
                  SET
                    name = :name
                  WHERE 
                    id = :id';
  
        $stmt = $this->pdo->prepare($query);
  
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->name = htmlspecialchars(strip_tags($this->name));
        
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':name', $this->name);
  
        if ($stmt->execute()) {
  
          return true;
        }
  
        return false;
      }

      // method to delete data from database
      public function delete() {

        $query = 'DELETE FROM ' . 
                    $this->table . '
                  WHERE id = :id';
  
        $stmt = $this->pdo->prepare($query);
  
        $this->id = htmlspecialchars(strip_tags($this->id));
  
        $stmt->bindParam(':id', $this->id);
  
        if ($stmt->execute()) {
  
          return true;
        }
  
        return false;
      }


}

?>