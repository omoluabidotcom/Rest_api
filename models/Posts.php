<?php

// include_once '../config/Datab.php';

class Post{

    // Database stuff
    private $pdo;
    private $table = 'posts';

    // Tables stuff
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    // contsruct to pass connection into a class
    public function __construct($db) {
      $this->pdo = $db;
    }

    // Read all data
    public function read() {

        $query = 'SELECT 
                    c.name as category_name,
                    p.id,
                    p.category_id,
                    p.title,
                    p.body,
                    p.author,
                    p.created_at
                  FROM
                    ' . $this->table . ' p
                  LEFT JOIN 
                    categories c ON p.category_id = c.id
                  ORDER BY 
                    p.created_at DESC';
        
        // prepare statement
        $stmt = $this->pdo->prepare($query);

        // execute statement
        $stmt->execute();

        // return result
        return $stmt;
    }


    public function read_single() {

      $query = 'SELECT
                  c.name as category_name,
                  p.id,
                  p.category_id,
                  p.title,
                  p.body,
                  p.author,
                  p.created_at
                FROM
                  ' . $this->table . ' p
                LEFT JOIN 
                  categories c ON p.category_id = c.id
                WHERE 
                  p.id = ?
                LIMIT 0,1';

      $stmt = $this->pdo->prepare($query);

      $stmt->bindParam(1, $this->id);

      $stmt->execute();

      $data = $stmt->fetch(PDO::FETCH_ASSOC);

      $this->title = $data['title'];
      $this->body = $data['body'];
      $this->author = $data['author'];
      $this->category_id = $data['category_id'];
      $this->category_name = $data['category_name'];
      
    }

    public function create() {

      $query = 'INSERT INTO 
                  '. $this->table . '
                SET
                  title = :title,
                  body = :body,
                  author = :author,
                  category_id = :category_id';
      
      $stmt = $this->pdo->prepare($query);

      $this->title = htmlspecialchars(strip_tags($this->title));
      $this->body = htmlspecialchars(strip_tags($this->body));
      $this->author = htmlspecialchars(strip_tags($this->author));
      $this->category_id = htmlspecialchars(strip_tags($this->category_id));
      
      $stmt->bindParam(':title', $this->title);
      $stmt->bindParam(':body', $this->body);
      $stmt->bindParam(':author', $this->author);
      $stmt->bindParam(':category_id', $this->category_id);

      if($stmt->execute()) {

        return true;
      } 
        
        return false;
    }

    public function update() {

      $query = 'UPDATE ' . 
                  $this->table . '
                SET
                  title = :title,
                  body = :body,
                  author = :author
                WHERE 
                  id = :id';

      $stmt = $this->pdo->prepare($query);

      $this->id = htmlspecialchars(strip_tags($this->id));
      $this->title = htmlspecialchars(strip_tags($this->title));
      $this->body = htmlspecialchars(strip_tags($this->body));
      $this->author = htmlspecialchars(strip_tags($this->author));
      
      $stmt->bindParam(':id', $this->id);
      $stmt->bindParam(':title', $this->title);
      $stmt->bindParam(':body', $this->body);
      $stmt->bindParam(':author', $this->author);

      if ($stmt->execute()) {

        return true;
      }

      return false;
    }


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