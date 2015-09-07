<?php

namespace APP\DB;

use \PDO;

class DB {

    private $database;
    private $username;
    private $password;
    private $host;

    public function __construct($database, $username, $password, $host = 'localhost') {


        $this->database = $database;
        $this->username = $username;
        $this->password = $password;
        $this->host = $host;
    }

    public function connect() {
        try {
            $conn = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->database . "", $this->username, $this->password, array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ));
            return $conn;
//            echo "<pre>";
//            print_r($pdo->getAvailableDrivers());
//            echo "</pre>";
        } catch (PDOException $e) {
//            echo "Connection failed: " . $e->getMessage();
            return FALSE;
        }
    }

    public function query($sql, $bindArray, $conn) {
        $stmt = $conn->prepare($sql);
        $stmt->execute($bindArray);
        $result = $stmt->fetchAll();
        return $result ? $result : FALSE;
    }

}
