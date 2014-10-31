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
$loops = $_POST['numberLoops']
$sql = "SELECT * FROM scoring WHERE teamName=?";
$check = $dbh->prepare($sql);
$check->execute(array($teamName));
if($check->rowCount() == 0){
    $nextSQL = "INSERT INTO scoring(teamName,score,tasksCompleted,numberPenalties,numberRotations,totalTasks,numberLoops) VALUES (?,?,?,?,?,?,?)";
    $addRaw = $dbh->prepare($nextSQL);
    $addRaw->execute(array($teamName,$score,$completed,$numberPen,$numberRot,$numberTasks,$loops));
}else{
    $update = "UPDATE scoring SET score =?,tasksCompleted=?,numberPenalties=?,numberRotations=?,totalTasks=?,numberLoops=? WHERE teamName=?";
    $updateRaw = $dbh->prepare($update);
    $updateRaw->execute(array($score,$completed,$numberPen,$numberRot,$numberTasks,$loops,$event));
    
}
?>