<html>
<script type="text/javascript">
	/*
	if(document.getElementById("clouds").checked && !scoresContain("clouds")){
		score +=30;
		completed_array.push("clouds");
	}else if(scoresContain("clouds") && !document.getElementById("clouds").checked){
		score -=30; //remove score if later unchecked;
		place = returnIndex("clouds");
		completed_array.splice(place);
	}
	if(document.getElementById("community").checked){
		score +=25;
		completed_array.push("community");
	}
	if(document.getElementById("senses").checked){
		score +=40;
		completed_array.push("senses");
	}
	if(document.getElementById("remote").checked){
		score +=40;
		completed_array.push("remote");
	}
	if(document.getElementById("changing").checked){
		score +=40;
		completed_array.push("changing");
	}*/
/*Opening Door: //15
Cloud ACcess //30
Community Learning  // 25
Robotics COmpetition //select insert = 25; insert and loop = 55;
using the right senses //40
thinking outside the box // select bulb down = 25; bulb up = 40
Remote communications   //40
search engine //select slider= 15; loop and slider = 60
sports // select took a shot = 30; shot and goal = 60
reverse engineering //select basket = 30; basket and model = 45 
adapting to changing conditions //15
apprenticeship //model = 20 touching circle = 35
engagement //engaging = 20 
project based learning // 20 for first loop +=10 for every loop after
penalty points 
*/
var max_score = 857;
var score = 0;
var completed_array = [];
var number_rotations =0;
var number_penalties = 0;
function scoresContain(input){
	if(completed_array.indexOf(input)>=0){
		return true;
	}else{
		return false;
	}
}
function returnIndex(input){
	if(completed_array.indexOf(input)>=0){
		return completed_array.indexOf(input);
	}else{
		return false;
	}
}
function calculateScore(){
	//general function to check values of scoring, will use jquery to call on changes.
	//need to run a check about what is completed and if any of them have changed update scores;
	//have they opened the door:
	var simpleCheckArray = [["doors",15],["clouds",30],["community",25],["senses",40],["remote",40],["changing",15]];
	var simpleCheckLength = simpleCheckArray.length;
	for(var x = 0; x<simpleCheckLength; x++){
		if(document.getElementById(simpleCheckArray[x][0]).checked && !scoresContain(simpleCheckArray[x][0]) ){
			score +=simpleCheckArray[x][1];
			completed_array.push(simpleCheckArray[x][0]);
		}else if(scoresContain(simpleCheckArray[x][0]) && !document.getElementById(simpleCheckArray[x][0]).checked){
			score -=simpleCheckArray[x][1]; //remove score if later unchecked;
			//remove the element from the array;
			place = returnIndex(simpleCheckArray[x][0]);
			completed_array.splice(place);
		}
	}
	if(document.getElementById("robotComp").value == 25){ //insert
		score +=25;
		completed_array.push("insert");
	}else if(document.getElementById("robotComp").value == 55 && !scoresContain("insert")){ //just insert and loop has been selected 
		score += 55;
		completed_array.push("inandloop");
	}else if(document.getElementById("robotComp").value == 55 && scoresContain("insert")){ //insert and loop has been selected after insert has been selected
		//remove the insert score 
		score -= 25;
		//add back the score for the insert and loop falling
		score += 55;
		completed_array.push("inandloop");
	}
	if(document.getElementById("outabox").value == 25){ //insert
		score +=25;
		completed_array.push("bulbdown");
	}else if(document.getElementById("outabox").value == 40 && !scoresContain("bulbdown")){ //just insert and loop has been selected 
		score += 40;
		completed_array.push("bulbup");
	}else if(document.getElementById("outabox").value == 40 && scoresContain("bulbdown")){ //insert and loop has been selected after insert has been selected
		//remove the insert score 
		score -= 25;
		//add back the score for the insert and loop falling
		score += 40;
		completed_array.push("bulbup");
	}
	if(document.getElementById("searchEngine").value == 15){ //insert
		score +=15;
		completed_array.push("slider");
	}else if(document.getElementById("searchEngine").value == 60 && !scoresContain("slider")){ //just insert and loop has been selected 
		score += 60;
		completed_array.push("sliderLoop");
	}else if(document.getElementById("searchEngine").value == 60 && scoresContain("slider")){ //insert and loop has been selected after insert has been selected
		//remove the insert score 
		score -= 15;
		//add back the score for the insert and loop falling
		score += 60;
		completed_array.push("sliderLoop");
	}
	if(document.getElementById("sports").value == 30){ //insert
		score +=30;
		completed_array.push("shot");
	}else if(document.getElementById("sports").value == 60 && !scoresContain("shot")){ //just insert and loop has been selected 
		score += 60;
		completed_array.push("goal");
	}else if(document.getElementById("sports").value == 60 && scoresContain("shot")){ //insert and loop has been selected after insert has been selected
		//remove the insert score 
		score -= 30;
		//add back the score for the insert and loop falling
		score += 60;
		completed_array.push("goal");
	}
	if(document.getElementById("reverse").value == 30){ //insert
		score +=30;
		completed_array.push("basket");
	}else if(document.getElementById("reverse").value == 45 && !scoresContain("baseket")){ //just insert and loop has been selected 
		score += 45;
		completed_array.push("model");
	}else if(document.getElementById("reverse").value == 45 && scoresContain("basket")){ //insert and loop has been selected after insert has been selected
		//remove the insert score 
		score -= 30;
		//add back the score for the insert and loop falling
		score += 45;
		completed_array.push("model");
	}
	if(document.getElementById("apprenticeship").value == 20){ //insert
		score +=20;
		completed_array.push("legoModel");
	}else if(document.getElementById("reverse").value == 35 && !scoresContain("legoModel")){ //just insert and loop has been selected 
		score += 35;
		completed_array.push("incircle");
	}else if(document.getElementById("reverse").value == 35 && scoresContain("legoModel")){ //insert and loop has been selected after insert has been selected
		//remove the insert score 
		score -= 20;
		//add back the score for the insert and loop falling
		score += 35;
		completed_array.push("incircle");
	}
	if(document.getElementById("engage").value == "engaged"){ //insert
		score +=20;
		completed_array.push("engaged");
	}/*else if(document.getElementById("reverse").value == 35 && !scoresContain("legoModel")){ //just insert and loop has been selected 
		score += 35;
		completed_array.push("incircle");
	}else if(document.getElementById("reverse").value == 35 && scoresContain("legoModel")){ //insert and loop has been selected after insert has been selected
		//remove the insert score 
		score -= 20;
		//add back the score for the insert and loop falling
		score += 35;
		completed_array.push("incircle");
	}*/
	document.getElementById("score").innerHTML = score +"/"+max_score;
}

</script>
<body>
Time: Score:<div id="score"></div>
<ul>
<li>Tasks: 
<li>Opening Door:<input type="checkbox" name="doors" id="doors"/> </li> <!---->
<li>Cloud ACcess <input type="checkbox" name="clouds" id="clouds"/></li><!---->
<li>Community Learning  <input type="checkbox" name="community" id="community"/></li><!---->
<li>Robotics COmpetition  <select name="robotComp" id="robotComp"><option>
						</option><option value="25">Insert</option>
						<option value="55">Insert and loop</option>
						</select></li><!---->
<li>using the right senses <input type="checkbox" name="senses" id="senses"/></li><!---->
<li>thinking outside the box <select name="outabox" id="outabox"><option></option>
							<option value="25">Bulb Down</option>
							<option value="40">Bulb Up</option>
							</select></li><!---->
<li>Remote communications  <input type="checkbox" name="remote" id="remote"/> </li><!---->
<li>Search Engine <select name="searchEngine" id="searchEngine"><option></option>
					<option value="15">Slider</option>
					<option value="60">Slider and Loop</option>
					</select></li><!---->
<li>Sports <select name="sports" id="sports"><option></option>
					<option value="30">Took a Shot</option>
					<option value="60">Shot and Goal</option>
					</select></li><!---->
<li>Reverse Engineering <select name="reverse" id="reverse"><option></option>
							<option value="30">Basket</option>
							<option value="45">Basket and Model</option>
							</select></li><!---->
<li>Adapting to changing conditions <input type="checkbox" name="changing" id="changing"/> </li><!---->
<li>Apprenticeship<select name="apprenticeship" id="apprenticeship"><option></option>
								<option value="20">Model</option>
								<option value="35">Touching Circle</option>
								</select> </li>
<li>Engagement Number of Rotations<select name="engage"><option></option>
<option value="engaged">Engagement</option>
<!--<?php for($x=0;$x<=58;$x++){echo "<option value=$x>$x</option>";}?>-->
</select></li>
<li>Project Based Learning <select name="pbl" id="pbl"><option></option>
<!--<?php for($x=0;$x<=8;$x++){echo "<option value=$x>$x</option>";}?>-->
</select></li>
<li>penalty points </li><select name="penalty" id="penalty"><option></option>
<!--<?php for($x=0;$x<=8;$x++){echo "<option value=$x>$x</option>";}?>-->
</select></li>
</ul>
</body>
</html>