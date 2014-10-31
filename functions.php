<?php
function returnTeamResults(){
    global $dbh;
    $sql = "SELECT * FROM scoring ORDER BY score ASC";
    $get = $dbh->prepare($sql);
    $get->execute();
    return $get->fetchAll();
}