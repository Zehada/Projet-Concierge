<?php
require('classes/Task.php');
require('functions.php');
?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conciergerie</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>

    <form id="task-form" class="m-5">
        <div class="mb-3">
            <label for="task-done" class="form-label">Intervention effectuée</label>
            <input type="text" class="form-control" id="task-done" name="task-done">
        </div>
        <div class="mb-3">
            <label for="task-date" class="form-label">Date d'intervention</label>
            <input type="date" class="form-control" id="task-date" name="task-date">
        </div>
        <div class="mb-3">
            <label for="task-floor" class="form-label">Étage concerné</label>
            <input type="number" class="form-control" id="task-floor" name="task-floor">
        </div>
        <button type="submit" class="btn btn-primary" name="add-task">Ajouter</button>
    </form>

    <?php


    if (isset($_GET['add-task'])) {
        $newTask = new Task($_GET['task-done'], $_GET['task-date'], $_GET['task-floor']);
        $newTask->addTask();
    }

    $displayTasksByFloor = getFloor();
    $displayTasksByDate = getDatee();
    ?>
    <form class="mx-5">
        <select id="select-by-floor" class="form-select mb-3" name="floor-selected">
            <option selected>Sélectionner par étage</option>
            <?php
            foreach ($displayTasksByFloor as $task) {

                echo '<option>' . $task['etage_intervention'] . '</option>';
            }
            ?>
        </select>
        <select id="select-by-date" class="form-select mb-3" name="date-selected">
            <option selected>Sélectionner par date</option>
            <?php
            foreach ($displayTasksByDate as $date) {

                echo '<option>' . $date['date_intervention'] . '</option>';
            }
            ?>
        </select>
        <button class="btn btn-primary" type="submit" name="rechercher">Rechercher</button>
    </form>


    <div class="d-flex flex-wrap m-5">

        <?php


        if (isset($_GET['rechercher'])) {

            if ($_GET['floor-selected'] !== "Sélectionner par étage" && $_GET['date-selected'] == "Sélectionner par date") {
                $displayTasks = getTasksByFloor();
                if ($_GET['floor-selected'] == "Sélectionner par étage") {
                    $displayTasks = getTasks();
                }
            } else if ($_GET['date-selected'] !== "Sélectionner par date" && $_GET['floor-selected'] == "Sélectionner par étage") {
                $displayTasks = getTasksByDate();
                if ($_GET['date-selected'] == "Sélectionner par date") {
                    $displayTasks = getTasks();
                }
            } else if ($_GET['date-selected'] == "Sélectionner par date" && $_GET['floor-selected'] == "Sélectionner par étage") {
                $displayTasks = getTasks();
            } else  if ($_GET['date-selected'] !== "Sélectionner par date" && $_GET['floor-selected'] !== "Sélectionner par étage") {

                $displayTasks = getTasksByAll();
                if (empty($displayTasks)) {
                    echo "Rien à afficher";
                }
            }
        } else {
            $displayTasks = getTasks();
        }


        foreach ($displayTasks as $task) {

            echo '<div class="card">
                    <div class="card-body">
                        <h5 class="card-title">' . $task['date_intervention'] . '</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Étage ' . $task['etage_intervention'] . '</h6>
                        <p class="card-text">' . $task['nom_intervention'] . '</p>
                        <form>
                            <button class="btn btn-primary" type="submit" name="supprimer' . $task['id_intervention'] . '">Supprimer</button>
                        </form>
                    </div>
                </div>';


            if (isset($_GET['supprimer' . $task['id_intervention']])) {
                $query = "DELETE FROM interventions WHERE id_intervention = :id_intervention";
                $taskDelete = connectToDatabase()->prepare($query);
                $taskDelete->execute([
                    'id_intervention' => $task['id_intervention'],
                ]);
                echo "<script>window.location='index.php'</script>";
            }
        }
        ?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>

</html>