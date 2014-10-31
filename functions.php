<?php
function returnTeamResults(){
    global $dbh;
    $sql = "SELECT * FROM scoring ORDER BY score DESC";
    $get = $dbh->prepare($sql);
    $get->execute();
    return $get->fetchAll();
}