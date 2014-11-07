<?php
function returnTeamResults(){
    global $dbh;
    //$sql = "SELECT * FROM scoring";
    $sql = "SELECT * FROM `scoring` ORDER BY `teamName` DESC";
    $get = $dbh->prepare($sql);
    $get->execute();
    return $get->fetchAll();
}
function topFour(){
    global $dbh;
    //$sql = "SELECT * FROM scoring";
    $sql = "SELECT * FROM `scoring` ORDER BY `score` DESC";
    $get = $dbh->prepare($sql);
    $get->execute();
    $teams = $get->fetchAll();
    //ve var_dump($teams);
    for($x =0; $x<count($teams);$x++){
        echo '<h3>'.getTeamName($teams[$x]['teamName']).' '.$teams[$x]['score'].'</h3>';
        if($teams[$x]['teamName']==$teams[$x+1]){
            $x++;
        }
    }
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
        $html.='<tr><td>'.$team['teamName'].'</a></td>';
        $getTeam->execute(array($team['id']));
        foreach($getTeam->fetchAll() as $teamRow){
            $html .='<td><a href=results.php?id='.$teamRow['id'].'>'.$teamRow['score'].'</a></td>';
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
function getTeamName($id){
    global $dbh;
    $sql = "SELECT * FROM `teams` WHERE id=?";
    $get = $dbh->prepare($sql);
    $get->execute(array($id));
    $get = $get->fetchAll();
    return $get[0]['teamName'];
}
function returnTeamSelect(){
    global $dbh;
    $sql = "SELECT * FROM `teams`";
    $get = $dbh->prepare($sql);
    $get->execute();
    $html ='';
    foreach($get->fetchAll() as $team){
        $html .='<option value="'.$team['id'].'">'.$team['teamName'].'</option>';
    }
    return $html;
}
?>