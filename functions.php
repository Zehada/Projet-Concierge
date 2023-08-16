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
    $query = "SELECT * FROM interventions ORDER BY date_intervention";
    $stmt = connectToDatabase()->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}

function getFloor()
{
    $query = "SELECT DISTINCT etage_intervention FROM interventions ORDER BY etage_intervention";
    $stmt = connectToDatabase()->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}

function getTasksByFloor()
{
    $query = "SELECT * FROM interventions WHERE etage_intervention = :etage_intervention";
    $stmt = connectToDatabase()->prepare($query);
    $stmt->execute([
        'etage_intervention' => $_GET['floor-selected'],
    ]);

    $result = $stmt->fetchAll();
    return $result;
}

function getDatee()
{
    $query = "SELECT DISTINCT date_intervention FROM interventions ORDER BY date_intervention";
    $stmt = connectToDatabase()->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}

function getTasksByDate()
{
    $query = "SELECT * FROM interventions WHERE date_intervention = :date_intervention";
    $stmt = connectToDatabase()->prepare($query);
    $stmt->execute([
        'date_intervention' => $_GET['date-selected'],
    ]);

    $result = $stmt->fetchAll();
    return $result;
}

function getTasksByAll()
{
    $query = "SELECT * FROM interventions WHERE date_intervention = :date_intervention AND etage_intervention = :etage_intervention";
    $stmt = connectToDatabase()->prepare($query);
    $stmt->execute([
        'date_intervention' => $_GET['date-selected'],
        'etage_intervention' => $_GET['floor-selected'],
    ]);

    $result = $stmt->fetchAll();
    return $result;
}
