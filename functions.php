<?php
function returnTeamResults(){
    global $dbh;
    //$sql = "SELECT * FROM scoring";
    $sql = "SELECT * FROM `scoring` ORDER BY `teamName` DESC";
    $get = $dbh->prepare($sql);
    $get->execute();
    return $get->fetchAll();
}
function returnTeamCell(){
        global $dbh;
    $sql = "SELECT * FROM `teams`";
    $get = $dbh->prepare($sql);
    $get->execute();
    $html ='';
    
    $teamsql = "SELECT * FROM `scoring` WHERE teamName=? ORDER BY score DESC";
    $getTeam = $dbh->prepare($teamsql);
    foreach($get->fetchAll() as $team){
        $html.='<tr><td><a href=results.php?id="$team[\'id\']">$team[\'teamName\']</a></td>';
        $teamData = $getTeam($team['id']);
        foreach($teamData->fetchAll() as $teamRow){
            $html .="<td>$teamRow['score']</td>";
        }
        $html.="</tr>";
    }
    return $html;
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