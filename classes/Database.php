<?php
class Database
{


    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'projet_concierge';
    private $charset = 'utf8mb4';




    protected function connectToDatabase()
    {
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=$this->charset";
            $pdo = new PDO($dsn, $this->username, $this->password);
            return $pdo;
            echo "hello";
        } catch (PDOException $e) {
            die('Erreur de connexion à la base de données : ' . $e->getMessage());
        }
    }
}
