<?php
require('classes/Task.php');
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
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>

</html>