<?php
class Database {
    public PDO $conn;

    public function __construct(bool $useTestDb = false) {
        $host = "localhost";
        $dbname = $useTestDb ? "albatros_test" : "albatros";
        $username = "root";
        $password = "";

        try {
            $this->conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new RuntimeException("Erreur de connexion : " . $e->getMessage());
        }
    }

    public function getConnection(): PDO {
        return $this->conn;
    }
}