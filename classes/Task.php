<?php


class Task
{
    private $taskName;
    private $taskDate;
    private $taskFloor;

    public function __construct($taskName, $taskDate, $taskFloor)
    {
        $this->taskName = $taskName;
        $this->taskDate = $taskDate;
        $this->taskFloor = $taskFloor;
    }

    public function addTask()
    {
        $query = "INSERT INTO interventions (nom_intervention, date_intervention, etage_intervention) VALUES (?, ?, ?)";
        $stmt = connectToDatabase()->prepare($query);
        $params = [$this->taskName, $this->taskDate, $this->taskFloor];
        $stmt->execute($params);
        echo "<script>window.location='index.php'</script>";
    }
}
