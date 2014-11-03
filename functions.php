<?php
function returnTeamResults(){
    global $dbh;
    //$sql = "SELECT * FROM scoring";
    $sql = "SELECT * FROM `scoring` ORDER BY `teamName` DESC";
    $get = $dbh->prepare($sql);
    $get->execute();
    return $get->fetchAll();
}
function individualResults($id){
    global $dbh;
    //$sql = "SELECT * FROM scoring";
    $sql = "SELECT * FROM `scoring` WHERE id=?";
    $get = $dbh->prepare($sql);
    $get->execute(array($id));
    return $get->fetchAll();
}
function returnTeamSelect(){
    global $dbh;
    $sql = "SELECT * FROM `teams`";
    $get = $dbh->prepare($sql);
    $get->execute();
    $html ='';
    foreach($get->fetchAll() as $team){
        $html .="<option value=$team['id']>$team['teamName']</option>";
    }
    return $html;
}