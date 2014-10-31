<?php
function returnTeamResults(){
    global $dbh;
    //$sql = "SELECT * FROM scoring";
    $sql = "SELECT * FROM `scoring` ORDER BY `score` DESC";
    $get = $dbh->prepare($sql);
    $get->execute();
    return $get->fetchAll();
}
return individualResults($id){
    global $dbh;
    //$sql = "SELECT * FROM scoring";
    $sql = "SELECT * FROM `scoring` WHERE id=?";
    $get = $dbh->prepare($sql);
    $get->execute(array($id));
    return $get->fetchAll();
}