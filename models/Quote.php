<?php
    class Quote {
        private $conn;
        private $table = 'quotes';

        public $id;
        public $categoryId;
        public $authorId;
        public $quote;
        public $category_name;
        public $author_name;

        public function __construct($db) {
            $this->conn = $db; 
        }

        public function read() {
            $query = 'SELECT
                    a.author as author_name,
                    c.category as category_name,
                    q.id,
                    q.quote,
                    q.categoryId,
                    q.authorId
                FROM
                    ' . $this->table . ' q
                LEFT JOIN
                    authors a ON q.authorId = a.id
                LEFT JOIN
                    categories c ON q.categoryId = c.id';
                    
                
            
            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
        }


        public function readSingleId() {
            $query = 'SELECT
                    a.author as author_name,
                    c.category as category_name,
                    q.id,
                    q.quote,
                    q.categoryId,
                    q.authorId
                FROM
                    ' . $this->table . ' q
                LEFT JOIN
                    authors a ON q.authorId = a.id
                LEFT JOIN
                    categories c ON q.categoryId = c.id
                WHERE
                    q.id = ?
                LIMIT 0,1';

                $stmt = $this->conn->prepare($query);

                $stmt->bindParam(1, $this->id);

                $stmt->execute();

                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $this->id = $row['id'];
                $this->quote = $row['quote'];
                $this->author_name = $row['author_name'];
                $this->category_name = $row['category_name'];
        }
        
        public function readAuthorId() {
            $query = 'SELECT
                    a.author as author_name,
                    c.category as category_name,
                    q.id,
                    q.quote,
                    q.categoryId,
                    q.authorId
                    
                FROM
                    quotes q
                LEFT JOIN
                    authors a ON q.authorId = a.id
                LEFT JOIN
                    categories c ON q.categoryId = c.id
                WHERE
                    q.authorId = ?';
                
            
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $row['id'];
            $this->quote = $row['quote'];
            $this->author_name = $row['author_name'];
            $this->category_name = $row['category_name'];
        }
        
        public function readCategoryId() {
            $query = 'SELECT
                    c.id,
                    c.category as category_name,
                    q.quote,
                    q.categoryId
                    
                FROM
                    categories c
                LEFT JOIN
                    quotes q ON c.id = q.categoryId
                WHERE
                    c.id = ?';
                
            
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->categoryId = $row['id'];
            $this->quote = $row['quote'];
            //$this->author_name = $row['author_name'];
            $this->category_name = $row['category_name'];
        }

        public function create() {
            $query = 'INSERT INTO ' . $this->table . '
            SET
                id = :id,
                quote = :quote,
                authorId = :authorId,
                categoryId = :categoryId';
            
            $stmt = $this->conn->prepare($query);

            //clean
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $this->authorId = htmlspecialchars(strip_tags($this->authorId));
            $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));

            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':quote', $this->quote);
            $stmt->bindParam(':authorId', $this->authorId);
            $stmt->bindParam(':categoryId', $this->categoryId);

            if($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->error);

            return false;
        }
        
        public function update() {
            $query = 'UPDATE ' . $this->table . '
            SET
                
                quote = :quote,
                authorId = :authorId,
                categoryId = :categoryId
            WHERE
                id = :id';
            
            
            $stmt = $this->conn->prepare($query);

            //clean
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $this->authorId = htmlspecialchars(strip_tags($this->authorId));
            $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));

            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':quote', $this->quote);
            $stmt->bindParam(':authorId', $this->authorId);
            $stmt->bindParam(':categoryId', $this->categoryId);

            if($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->error);

            return false;
        }
       
        public function delete(){
            $query = 'DELETE FROM ' . $this->table . '
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

