<?php
include("header.php");
$id = $_GET['id'];
$individualResults = individualResults($id);
$completed = json_decode($individualResults[0]['tasksCompleted']);
$rotations = $individualResults[0]['numberRotations'];
$numberLoops = $individualResults[0]['numberLoops'];
$penalties = $individualResults[0]['numberPenalties'];
$round = $individualResults[0]['round'];
$team = getTeamName($individualResults[0]['teamName']);
$score = $individualResults[0]['score'];
echo $twig->render('resultsTemplate.html',array('teamResults'=>$individualResults,'score'=>$score,'round'=>$round,'completed'=>$completed,
                                                'rotations'=>$rotations,'loops'=>$numberLoops,'penalties'=>$penalties,'teamName'=>$team));