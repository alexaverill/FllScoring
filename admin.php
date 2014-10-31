<?php
include("header.php");

$teamResults = returnTeamResults();

echo $twig->render('adminTemplate.html',array('teamList'=>$teamResults));