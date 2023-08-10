<?php


function connectToDatabase()
{

    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'projet_concierge';
    $charset = 'utf8mb4'; {
        try {
            $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
            $pdo = new PDO($dsn, $username, $password);
            return $pdo;
        } catch (PDOException $e) {
            die('Erreur de connexion à la base de données : ' . $e->getMessage());
        }
    }
}

function getTasks()
{
    $query = "SELECT * FROM interventions";
    $stmt = connectToDatabase()->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}

function deleteTask()
{
}
