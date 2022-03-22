<?php
    class Database {
        //params
        public $url = getenv('JAWSDB_URL');
        public $dbparts = parse_url($url);

        private $hostname = $dbparts['host'];
        private $db_name =  ltrim($dbparts['path'],'/');
        private $username = $dbparts['user'];
        private $password = $dbparts['pass'];
        private $conn;
        
        //connect db
        public function connect() {
            $this->conn = null;

            try{
                $this->conn = new PDO('mysql:host=' . $this->hostname . ';dbname=' . $this->db_name,
                $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e) {
                echo 'Connection Error: ' . $e->getMessage();
            }

            return $this->conn;
        }

        
    }

