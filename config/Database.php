<?php
    class Database {
        //params

       // private $hostname = 'localhost';
        //private $db_name = 'quotesdb';
        //private $username = 'root';
        //private $password = '';
        function __construct()
        {
            $this->url = getenv('JAWSDB_URL');
            $this->conn = null;
        }
        //public $url = getenv('JAWSDB_URL');
        public $dbparts = parse_url($url);

        private $hostname = $dbparts['host'];
        private $db_name =  ltrim($dbparts['path'],'/');
        private $username = $dbparts['user'];
        private $password = $dbparts['pass'];
        //private $conn;
        
        //connect db
        public function connect() {
        $dbparts = parse_url($this->url);

        $hostname = $dbparts['host'];
        $db_name =  ltrim($dbparts['path'],'/');
        $username = $dbparts['user'];
        $password = $dbparts['pass'];

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

