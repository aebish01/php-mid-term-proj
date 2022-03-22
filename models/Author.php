<?php
    class Author {
        private $conn;

        public $id;
        public $author;

        public function __construct($db) {
            $this->conn = $db; 
        }

        public function read(){
            $query = 'SELECT
                    a.id,
                    a.author as author_name
                FROM 
                    authors a';
                    
                
            
            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
        }
        public function readSingle(){
            $query = 'SELECT
                    a.id,
                    a.author
                FROM
                    authors a

                WHERE
                    a.id = ?
                LIMIT 0,1';

                $stmt = $this->conn->prepare($query);

                $stmt->bindParam(1, $this->id);

                $stmt->execute();

                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $this->id = $row['id'];
                //$this->quote = $row['quote'];
                $this->author = $row['author'];
                //$this->category_name = $row['category_name'];
        }

        public function create() {
            $query = 'INSERT INTO authors
            SET
                id = :id,
                
                author = :author';
            
            $stmt = $this->conn->prepare($query);

            //clean
            $this->id = htmlspecialchars(strip_tags($this->id));
            
            $this->author = htmlspecialchars(strip_tags($this->author));

            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':author', $this->author);

            if($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        public function update() {
            $query = 'UPDATE authors
            SET
                                
                author = :author
            Where
                id = :id';
            
            $stmt = $this->conn->prepare($query);

            //clean
            $this->id = htmlspecialchars(strip_tags($this->id));
            
            $this->author = htmlspecialchars(strip_tags($this->author));

            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':author', $this->author);

            if($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        public function delete(){
            $query = 'DELETE FROM authors
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