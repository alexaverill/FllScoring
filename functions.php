<?php
function returnTeamResults(){
    global $dbh;
    $sql = "SELECT * FROM scoring";
    $get = $dbh->prepare($sql);
    $get->execute();
    return $get->fetchAll();
}