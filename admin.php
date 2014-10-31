<?php
include("header.php");

$teamResults = returnTeamResults();
var_dump($teamResults);
echo $twig->render('adminTemplate.html',array('teamList'=>$teamResults));