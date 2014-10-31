<html>
<head>
<link rel="stylesheet" href="stylesheet.css" type="css"/>
<script type="text/javascript" src="jquery-2.1.1.min.js"></script>
</head>
<?php
include('database.php');
try{
    $dbh= new PDO('mysql:host='.$data_host.';dbname='.$name_database,$data_username,$data_password);
}catch(PDOException $e){
    echo $e->getMessage();
}

include('functions.php');

require_once './Twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('./templates');
$twig = new Twig_Environment($loader, array(
    
));
?>