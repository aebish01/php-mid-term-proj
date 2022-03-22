<?php
    class Category {
        private $conn;

        public $id;
        public $category;

        public function __construct($db) {
            $this->conn = $db; 
        }
        public function read(){
            $query = 'SELECT
                    c.id,
                    c.category as category_name
                FROM 
                    categories c';
                    
                
            
            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
        }

        public function readSingle(){
            $query = 'SELECT
                    c.id,
                    c.category
                FROM
                    categories c

                WHERE
                    c.id = ?
                LIMIT 0,1';

                $stmt = $this->conn->prepare($query);

                $stmt->bindParam(1, $this->id);

                $stmt->execute();

                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $this->id = $row['id'];
                //$this->quote = $row['quote'];
                $this->category = $row['category'];
                //$this->category_name = $row['category_name'];
        }
        public function create() {
            $query = 'INSERT INTO categories
            SET
                id = :id,
                category = :category';
            
            $stmt = $this->conn->prepare($query);

            //clean
            $this->id = htmlspecialchars(strip_tags($this->id));
            
            $this->category = htmlspecialchars(strip_tags($this->category));

            $stmt->bindParam(':id', $this->id);
            
            $stmt->bindParam(':category', $this->category);

            if($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->error);

            return false;
        }
        
        public function update() {
            $query = 'UPDATE categories
            SET
                
                category = :category
            WHERE
                id = :id';
            
            $stmt = $this->conn->prepare($query);

            //clean
            $this->id = htmlspecialchars(strip_tags($this->id));
            
            $this->category = htmlspecialchars(strip_tags($this->category));

            $stmt->bindParam(':id', $this->id);
            
            $stmt->bindParam(':category', $this->category);

            if($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        public function delete(){
            $query = 'DELETE FROM categories
            WHERE 
                id = :id';

            $stmt = $this->conn->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(':id', $this->id);

            if($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->error);

            return false;

        }
    }