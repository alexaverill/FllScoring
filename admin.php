<?php
include("header.php");
//$teamResults = returnTeamResults();
?>
<html>
<head>
<link rel="stylesheet" href="stylesheet.css" type="css"/>
<script type="text/javascript" src="jquery-2.1.1.min.js"></script>
</head>
<body>
    <div id="headerBar">
        
    </div>
    <div id="mainContent">
	<h2>Results:</h2>
	<table>
	    <tr><th>Team Name</th><th>Score 1</th><th>Score 2 </th><th>Score 3</th>
                <?php echo returnTeamCell();?>
                </table>