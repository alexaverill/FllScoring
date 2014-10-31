<?php
include("header.php");
$id = $_GET['id'];
$individualResults = individualResults($id);
$completed = json_decode($individualResults[0]['tasksCompleted']);
var_dump($completed);
echo $twig->render('resultsTemplate.html',array('teamResults'=>$individualResults,'completed'=>$completed));