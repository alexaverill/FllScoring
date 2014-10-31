<?php
include("header.php");
$id = $_GET['id'];
$individualResults = individualResults($id);
$completedJSON = $individualResults[0]['tasksCompleted'];
echo $twig->render('resultsTemplate.html',array('teamResults'=>$individualResults,'completed'=>$completedJSON));