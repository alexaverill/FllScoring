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
var completed_array = []; //array to hold completed tasks
var number_rotations =0; //number of rotations for the engagedment task
var number_penalties = 0; 
var penaltiesCounted = 0;
var numberLoops = 0;	//Project based learning	
var numberLoopsCounted = 0;
var time = 120; //time in seconds;
var interval;
function timer(){
	time  -= 1; //remove a second
	var timeDisplayMinutes = Math.floor(time /60); //determine minutes 
	var timeDisplaySeconds = time - (timeDisplayMinutes * 60) ; //determine seconds parenthesis are for readability
	document.getElementById("time").innerHTML = timeDisplayMinutes+":"+timeDisplaySeconds; //update the visual timer.
	if (timeDisplaySeconds <=0 && timeDisplayMinutes<=0) {
		//stop timer when it equals 0;
		interval = clearInterval(interval);
		alert("Time Over!"); 
		document.getElementById("time").innerHTML = "0:00";
	}
}
function callTimer() {
	//function to start the timer, setInterval calles the countdown function every 1000 milliseconds or 1 second
	interval = setInterval(timer, 1000);
}
function resetTimer(){
	interval = clearInterval(interval);
	time = 120;
	document.getElementById("time").innerHTML ="2:00";
}
function scoresContain(input){
	//determine if a task has been completed/ is in the completed array.
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
	
	var multiLength = multiCheckArray.length;
	for(var z = 0; z<multiLength; z++){
		//define some human readable names.
		var selectOption = document.getElementById(multiCheckArray[z][0]).value; //value of the select option
		var scoreOne = multiCheckArray[z][2];	//fist score value
		var nameOne = multiCheckArray[z][1][0];   //name for completed array;
		var scoreTwo = multiCheckArray[z][3]; //second score value
		var nameTwo = multiCheckArray[z][1][1]; //name for completed task
		if(selectOption == scoreOne &&  !scoresContain( nameOne )){
			//if the selected value is the first score option, and the first score option hasnt already been input
			if (scoresContain( nameTwo )) {
				//if name two was selected earlier we need to fix the score so we dont get too high
				place = returnIndex( nameTwo );
				completed_array.splice(place,1); //remove the name from the completed array so we can keep track of the selected
				score -= scoreTwo; //fix score
			}
			score +=scoreOne;
			completed_array.push( nameOne );
		}else if(selectOption == scoreTwo && !scoresContain( nameOne )){
			//if the second option is selected first.
			if (!scoresContain( nameTwo )) {
				//and if the second option isn't already in the completed array;
				score += scoreTwo;
				completed_array.push( nameTwo );
			}
			
		}else if( selectOption == scoreTwo && scoresContain( nameOne )){
			//if the first select option was picked first, and now we change to the second select option
			score -= scoreOne; //remove score one
			
			place = returnIndex( nameOne );
			completed_array.splice(place,1); //remove name one from completed_array[]
			//add score two
			score += scoreTwo;
			completed_array.push( nameTwo );
		}else if (selectOption == -1 ){
			//if the select is returned to the empty option
			if (scoresContain( nameOne )) {
				place = returnIndex( nameOne);
				completed_array.splice(place,1);
				score -= scoreOne;
			}else if (scoresContain( nameTwo )){
				place = returnIndex( nameTwo );
				completed_array.splice(place,1);
				score -= scoreTwo;
			}
		}
		console.log(completed_array);
	}
	
	//engaged tasks
	if(document.getElementById("engage").value == "engaged" && !scoresContain("engaged")){
		//insert base score of 20 for rotation, then will run a check to determine the number of future rotations
		score +=20;
		completed_array.push("engaged");
	}else if (document.getElementById("engage").value >=0) {
		if (!scoresContain("engaged")) {
			//if engaged wasn't selected in the select, but the number of rotations has changed we will need to add an engaged score
			score +=20
			completed_array.push("engaged");	
		}
		//since not calculated until final save it does not have to be input into score.
		number_rotations = document.getElementById("engage").value;
	}else if (document.getElementById("engage").value ==-1) {
		if (scoresContain("engaged")) {
			//engaged was selected
			score -=20;
		}
		number_rotations = 0;
	}
	if (document.getElementById("penalty").value>=0) {
			//calculate number of penalty points
			numberDifference = (document.getElementById("penalty").value - penaltiesCounted);
			console.log(numberDifference);
			if ( numberDifference >0 ) {
				score -= 10 * numberDifference;
				penaltiesCounted = document.getElementById("penalty").value;
			}else if (numberDifference < 0) {
				score += 10 * Math.abs(numberDifference);
				penaltiesCounted = document.getElementById("penalty").value;
			}
		
		
	}
	/**************TODO*********************************
	 *
	 *	Project Based Learning!
	 *
	 *
	 *
	 *
	 */
	document.getElementById("score").innerHTML = score +"/"+max_score;
}
function save(){
	var name=document.getElementById("teamNameIn").value;
	if (scoresContain("engaged")) {
		if (number_rotations>0) {
			tempScore = score - 20;
			percentBack = tempScore * (number_rotations*.01);
			score += percentBack;
		}
	}
	completedString = JSON.stringify(completed_array);
	 $.ajax({
		type: "POST",
		url: "save.php",
		data: { teamName:name , score: score, tasksDone: completedString }
		});
	 alert("Team Data Saved, and Submitted!")
}
$(document).on("change",'.score', function() {
		calculateScore();
	 });
</script>
</head>
<body>
    <div id="headerBar">
        <div id="timer"><h3>Time: <span id="time">2:00</span><button onclick="callTimer();">Start Time</button>
	<button onclick="resetTimer();">Reset Time</button></h3></div>
	
        <div id="scoreContainer"><h3>Score: <span id="score">0/857</span></h3></div>
    </div>
    <div id="mainContent">
        <div id="title">
            <h3>Tasks:</h3>
        </div>
            <div id ="tasklist">
		<div id="teamName">Team Name: <input type="text" id="teamNameIn"/></div>
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
                    <li>Search Engine <select name="searchEngine" class="score" id="searchEngine"><option value="-1"></option>
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
                    <li>Apprenticeship<select name="apprenticeship" class="score" id="apprenticeship"><option value="-1"></option>
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