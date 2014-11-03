<?php
require('database.php');
try{
    $dbh= new PDO('mysql:host='.$data_host.';dbname='.$name_database,$data_username,$data_password);
}catch(PDOException $e){
    echo $e->getMessage();
}
$teamName = $_POST['teamName'];
$score = $_POST['score'];
$completed = $_POST['tasksDone'];
$numberPen = $_POST['numPenalties'];
$numberRot = $_POST['numRotations'];
$numberTasks = $_POST['totalNumber'];
$loops = $_POST['numberLoops'];
$round = $_POST['round'];

    $nextSQL = "INSERT INTO scoring(teamName,score,round,tasksCompleted,numberPenalties,numberRotations,totalTasks,numberLoops) VALUES (?,?,?,?,?,?,?,?)";
    $addRaw = $dbh->prepare($nextSQL);
    $addRaw->execute(array($teamName,$score,$round,$completed,$numberPen,$numberRot,$numberTasks,$loops));
?>