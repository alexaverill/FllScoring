<html>
<link rel="stylesheet" href="stylesheet.css" type="css"/>
<script type="text/javascript" src="jquery-2.1.1.min.js"></script>
<script type="text/javascript">
// scoring information:
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
var penaltiesCounted = 0;
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
	/*array for the select boxes.
	/*diagram: [0]=>select name; [1]=>array [1][0]=>first select option name for the completed array;
	/*					[1][1]=>second select option name for completed array;
	/* [2] => first scoring option value;
	/* [3] => second scoring option
	*/
	var multiCheckArray = [
		["robotComp",["insert","inandloop"],25,55],
		["outabox",["bulbdown","bulbup"],25,40],
		["searchEngine",["slider","sliderloop"],15,60],
		["sports",["shot","goal"],30,60],
		["reverse",["basket","model"],30,45],
		["apprenticeship",["legoModel","incircle"],20,35]
	];
	console.log(multiCheckArray);
	var multiLength = multiCheckArray.length;
	for(var z = 0; z<multiLength; z++){
		if(document.getElementById(multiCheckArray[z][0]).value == multiCheckArray[z][2] &&  !scoresContain(multiCheckArray[z][1][0])){ //insert
			if (scoresContain(multiCheckArray[z][1][1])) {
				score -= multiCheckArray[z][3];
			}
			score +=multiCheckArray[z][2];
			console.log(multiCheckArray[z][1][0]);
			completed_array.push(multiCheckArray[z][1][0]);
		}else if(document.getElementById(multiCheckArray[z][0]).value == multiCheckArray[z][3] && !scoresContain(multiCheckArray[z][1][0])){ //just insert and loop has been selected 
			score += multiCheckArray[z][3];
			completed_array.push(multiCheckArray[z][1][1]);
		}else if(document.getElementById(multiCheckArray[z][0]).value == multiCheckArray[z][3] && scoresContain(multiCheckArray[z][1][0])){ //insert and loop has been selected after insert has been selected
			//remove the insert score 
			score -= multiCheckArray[z][2];
			place = returnIndex(multiCheckArray[z][1][0]);
			completed_array.splice(place);
			//add back the score for the insert and loop falling
			score += multiCheckArray[z][3];
			completed_array.push(multiCheckArray[z][1][1]);
		}else if (document.getElementById(multiCheckArray[z][0]).value==-1 ){
			if (scoresContain(multiCheckArray[z][1][0])) {
				place = returnIndex(multiCheckArray[z][1][0]);
				completed_array.splice(place);
				score -= multiCheckArray[z][2];
			}else if (scoresContain(multiCheckArray[z][1][1])){
				place = returnIndex(multiCheckArray[z][1][1]);
				completed_array.splice(place);
				score -= multiCheckArray[z][3];
			}
		}
	}
	
	
	if(document.getElementById("engage").value == "engaged" && !scoresContain("engaged")){
		//insert base score of 20 for rotation, then will run a check to determine the number of future rotations
		score +=20;
		completed_array.push("engaged");
	}
	document.getElementById("score").innerHTML = score +"/"+max_score;
}
$(document).on("change",'.score', function() {
		calculateScore();
	 });
</script>
<body>
    <div id="headerBar">
        <div id="timer"><h3>Time: 2:00</h3></div>
        <div id="scoreContainer"><h3>Score: <span id="score">0/857</span></h3></div>
    </div>
    <div id="mainContent">
        <div id="title">
            <h3>Tasks:</h3>
        </div>
            <div id ="tasklist">
                    <ul>

                    <li>Opening Door:<input type="checkbox" class="score" name="doors" id="doors"/> </li> <!---->
                    <li>Cloud Access <input type="checkbox" class="score" name="clouds" id="clouds"/></li><!---->
                    <li>Community Learning  <input type="checkbox" class="score" name="community" id="community"/></li><!---->
                    <li>Robotics Competition  <select name="robotComp" class="score" id="robotComp"><option value="-1">
                                            </option><option value="25">Insert</option>
                                            <option value="55">Insert and loop</option>
                                            </select></li><!---->
                    <li>Using the Right Senses <input type="checkbox" class="score" name="senses" id="senses"/></li><!---->
                    <li>Thinking Outside the Box <select name="outabox" class="score" id="outabox"><option value="-1"></option>
                                                <option value="25">Bulb Down</option>
                                                <option value="40">Bulb Up</option>
                                                </select></li><!---->
                    <li>Remote Communications  <input type="checkbox" class="score" name="remote" id="remote"/> </li><!---->
                    <li>Search Engine <select name="searchEngine" id="searchEngine"><option value="-1"></option>
                                        <option value="15">Slider</option>
                                        <option value="60">Slider and Loop</option>
                                        </select></li><!---->
                    <li>Sports <select name="sports" class="score" id="sports"><option value="-1"></option>
                                        <option value="30">Took a Shot</option>
                                        <option value="60">Shot and Goal</option>
                                        </select></li><!---->
                    <li>Reverse Engineering <select name="reverse" class="score" id="reverse"><option value="-1"></option>
                                                <option value="30">Basket</option>
                                                <option value="45">Basket and Model</option>
                                                </select></li><!---->
                    <li>Adapting to Changing Conditions <input type="checkbox" class="score" name="changing" id="changing"/> </li><!---->
                    <li>Apprenticeship<select name="apprenticeship" id="apprenticeship"><option value="-1"></option>
                                                    <option value="20">Model</option>
                                                    <option value="35">Touching Circle</option>
                                                    </select> </li>
                    <li>Engagement Number of Rotations<select name="engage" class="score" id="engage"><option value="-1"></option>
                    <option value="engaged">Engagement</option>
                    <?php for($x=0;$x<=58;$x++){echo "<option value=$x>$x</option>";}?>
                    </select></li>
                    <li>Project Based Learning <select name="pbl" class="score" id="pbl"><option value="-1"></option>
                    <?php for($x=0;$x<=8;$x++){echo "<option value=$x>$x</option>";}?>
                    </select></li>
                    <li>Penalty Points<select name="penalty" class="score" id="penalty"><option value="-1"></option>
                    <?php for($x=0;$x<=8;$x++){echo "<option value=$x>$x</option>";}?>
                    </select></li>
                        <li><button onclick="save()">Save Scores</button></li>
                    </ul>
                </div>
        </div>
</body>
</html>