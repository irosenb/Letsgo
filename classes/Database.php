<?php 

class Database {

        public $db;

        public function __construct() {
                try {
                        require_once('./config.php');
                        $conn = new PDO('mysql:host=localhost;dbname=' . DB_NAME,
                                DB_USER,
                                DB_PASS);
                        $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                        $conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

                        $this->db = $conn;
                        return $this->db;
                } catch(Exception $e) {
                        return false;
                }
        }

}