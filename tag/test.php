<?php

$mysqli_connection = new MySQLi('vergil.u.washington.edu', 'root', 'degobah', 'tagging_experiment', 1357);
if(!$mysqli_connection){
    die('Could not connect: ' . mysql_error());
}



// If user's first page, generate a user id. Else, use the one passed by other page.
    if(!$_POST['userid']){
      $userid = uniqid();
    } else {
   $userid=$_POST['userid'];
    }

// If user's first page, establish which conditions are turned on and off
    if(!$_POST['condition']){
        $condition = rand(1,4);
    } else {
        $condition = $_POST['condition'];
    }
    
// variables to turn on and off suggested tags and autocomplete
    if($condition == 1){
   echo "<script>";
    echo "var suggest = 0;";
    echo "var auto = 0;";
    echo "</script>";
    }
    if($condition == 2){
        echo "<script>";
        echo "var suggest = 1;";
        echo "var auto = 0;";
        echo "</script>";
    }
    if($condition == 3){
        echo "<script>";
        echo "var suggest = 0;";
        echo "var auto = 1;";
        echo "</script>";
    }
    if($condition == 4){
        echo "<script>";
        echo "var suggest = 1;";
        echo "var auto = 1;";
        echo "</script>";
    }

//Track order for the same user. Other page increments this value.
    if(!$_POST['order']){
        $order=0;
//Generate random order for pics one time and then pass the array to step through in that order
        $photoid_array = range(1,16);
        shuffle($photoid_array);
    } else {
        $order=$_POST['order'];
        $photoid_array_notfixed = $_POST['photoid_array'];
        $photoid_array = unserialize($photoid_array_notfixed);
    }
    
    $photoid = $photoid_array[$order];
    $photoid_array_String = serialize($photoid_array);
    
    
// tags per photo
if($photoid==1) {
  $tag1 = "ballon";
  $tag2 = "cave";
  $tag3 = "water";
  $tag4 = "boy";
  $tag5 = "ocean";
}
if($photoid==2) {
        $tag1 = "butterfly";
        $tag2 = "flower";
        $tag3 = "antenna";
        $tag4 = "purple";
        $tag5 = "focus";
}
if($photoid==3) {
        $tag1 = "arches";
        $tag2 = "reflection";
        $tag3 = "tunnel";
        $tag4 = "building";
        $tag5 = "light";
}
if($photoid==4) {
        $tag1 = "train";
        $tag2 = "passengers";
        $tag3 = "smile";
        $tag4 = "wave";
        $tag5 = "thumbs up";
}
if($photoid==5) {
        $tag1 = "umbrella";
        $tag2 = "couple";
        $tag3 = "light";
        $tag4 = "reflection";
        $tag5 = "plaza";
}
if($photoid==6) {
        $tag1 = "windows";
        $tag2 = "city";
        $tag3 = "black and white";
        $tag4 = "buildings";
        $tag5 = "grid";
}
if($photoid==7) {
        $tag1 = "trumpet";
        $tag2 = "piano";
        $tag3 = "black and white";
        $tag4 = "music";
        $tag5 = "concert";
}
if($photoid==8) {
        $tag1 = "cave";
        $tag2 = "ice";
        $tag3 = "climbing";
        $tag4 = "mountains";
        $tag5 = "silhouette";
}
if($photoid==9) {
        $tag1 = "sunset";
        $tag2 = "nature";
        $tag3 = "lake";
        $tag4 = "mountains";
        $tag5 = "rocks";
}
if($photoid==10) {
        $tag1 = "girl";
        $tag2 = "dog";
        $tag3 = "farm";
        $tag4 = "clouds";
        $tag5 = "silos";
}
if($photoid==11) {
        $tag1 = "man";
        $tag2 = "bird";
        $tag3 = "black and white";
        $tag4 = "feeding";
        $tag5 = "wings";
}
if($photoid==12) {
        $tag1 = "turtle";
        $tag2 = "fish";
        $tag3 = "ocean";
        $tag4 = "blue";
        $tag5 = "underwater";
}
if($photoid==13) {
        $tag1 = "tunnel";
        $tag2 = "lights";
        $tag3 = "bricks";
        $tag4 = "buildings";
        $tag5 = "Austria";
}
if($photoid==14) {
        $tag1 = "couple";
        $tag2 = "mirror";
        $tag3 = "smile";
        $tag4 = "wallpaper";
        $tag5 = "candles";
}
if($photoid==15) {
        $tag1 = "mountains";
        $tag2 = "camels";
        $tag3 = "silhouette";
        $tag4 = "clouds";
        $tag5 = "black and white";
}
if($photoid==16) {
        $tag1 = "man";
        $tag2 = "city";
        $tag3 = "smog";
        $tag4 = "stick";
        $tag5 = "black and white";
}
?>


<!doctype html>
<html lang="us">
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="tagging.css">
<meta charset="utf-8">
<title>Tagging is Cool!</title>
<link href="jquery-ui.css" rel="stylesheet">
</head>
<body>

<div class="row">
<div class="column left">
<h1>Image to tag:</h1>
<img src="pic<?php echo $photoid;?>.jpg" width=95%>
</div>
<div class="column right">

<br><br><br>
<div id="SuggestHeader">
<h2 class="demoHeaders">Enter or select your tags here:</h2>
</div>
<div id="SuggestTags">
<input type="button" class="tag-button" id="title1" value="<?php echo $tag1;?>" onclick="insert1(); hideButton1()">
<input type="button" class="tag-button" id="title2" value="<?php echo $tag2;?>" onclick="insert2(); hideButton2()">
<input type="button" class="tag-button" id="title3" value="<?php echo $tag3;?>" onclick="insert3(); hideButton3()">
<input type="button" class="tag-button" id="title4" value="<?php echo $tag4;?>" onclick="insert4(); hideButton4()">
<input type="button" class="tag-button" id="title5" value="<?php echo $tag5;?>" onclick="insert5(); hideButton5()">
</div><br>

<script>
if(!suggest){
document.getElementById("SuggestTags").innerHTML = "";
document.getElementById("SuggestHeader").innerHTML = "<h2 class='demoHeaders'>Enter your tags here:</h2>";
        }
            </script>


<!-- This is where users type in tags and click Add to submit them. -->
<div>
<input id="title" type="text" title="type &quot;a&quot;" placeholder="Type tags here..." maxlength="99"  onkeyup="Allow()" onkeypress="return checkSubmit(event)" />
<input type="submit" class="add-button" value="Add Tag" onclick="insert()" />
</div>
<br><br>
<!-- This is the div where the entered tags show up. -->
<div id="entered_tags"></div>
<br><br>

<!--form submission and call to next page that writes to MySQL happens here -->
<form action="test2.php" method="post">
<input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>">
<input type="hidden" name="order" id="order" value="<?php echo $order;?>">
<input type="hidden" name="photoid" id="photoid" value="<?php echo $photoid;?>">
<input type="hidden" name="photoid_array" id="photoid_array" value="<?php echo $photoid_array_String;?>">
<input type="hidden" name="suggestbool" id="suggestbool" value="">
<input type="hidden" name="autobool" id="autobool" value="">
<input type="hidden" name="condition" id="condition" value="<?php echo $condition;?>">
<input type="hidden" name="tags" id="tags" value="">
<input type="submit" value="Submit Tags" class="submit-button" onclick="popForm()"/>
</form>
</div>
</div>

<script type="text/javascript">




//Add tags on Enter, not just Add Tag button
function checkSubmit(e) {
    if(e && e.keyCode == 13) {
        insert();
    }
}

var titles  = [];
var titleInput  = document.getElementById("title");
var titleInput1  = document.getElementById("title1");
var titleInput2  = document.getElementById("title2");
var titleInput3  = document.getElementById("title3");
var titleInput4  = document.getElementById("title4");
var titleInput5  = document.getElementById("title5");
var messageBox  = document.getElementById("entered_tags");

function popForm()
{
    document.forms[0].suggestbool.value = suggest;
    document.forms[0].autobool.value = auto;
    document.forms[0].tags.value = messageBox.innerHTML;
}

// Hide buttons. Bunch of these because I'm a hack.
function hideButton1()
{document.getElementById("title1").setAttribute("class", "hidden-button");}

function hideButton2()
{document.getElementById("title2").setAttribute("class", "hidden-button");}

function hideButton3()
{document.getElementById("title3").setAttribute("class", "hidden-button");}

function hideButton4()
{document.getElementById("title4").setAttribute("class", "hidden-button");}

function hideButton5()
{document.getElementById("title5").setAttribute("class", "hidden-button");}

// Restrict input, not sure if it is actually working
function Allow(){
    if (!title.value.match(/[a-zA-Z0-9_\s]$/) && title.value !="") {
        title.value="";
        alert("Please enter only letters, numbers, underscores, and spaces.");
    }
}

//Insert for typed-in labels
function insert () {
    titles.push(titleInput.value);
    clearAndShow();
}

//An overly long list of inserts for suggested labels. I am a hack.
function insert1 () {
    titles.push(titleInput1.value);
    clearAndShow();
}

function insert2 () {
    titles.push(titleInput2.value);
    clearAndShow();
}

function insert3 () {
    titles.push(titleInput3.value);
    clearAndShow();
}

function insert4 () {
    titles.push(titleInput4.value);
    clearAndShow();
}

function insert5 () {
    titles.push(titleInput5.value);
    clearAndShow();
}

function clearAndShow () {
    titleInput.value = "";
    messageBox.innerHTML = "";
    messageBox.innerHTML += "Tags: " + titles.join(", ") + "<br/>";
}
</script>



<!-- Autocomplete -->
<script src="external/jquery/jquery.js"></script>
<script src="jquery-ui.js"></script>
<script>

if(!auto){
    
} else{

var availableTags = [
"balloon",
"kid",
"boy",
"cave",
"beach",
"ocean",
"water",
"chase",
"chasing",
"reach",
"red",
"play",
"stretch",
"framed",
"string",
"playing",
"stretching",
"sky",
"blue",
"photograph",
"photo",
"wave",
"light",
"hair",
"butterfly",
"flower",
"insect",
"color",
"black and white",
"moth",
"monarch",
"stem",
"purple",
"antenna",
"focus",
"blurry",
"light",
"reflection",
"arch",
"arches",
"building",
"perspective",
"tunnel",
"golden",
"train",
"passengers",
"smile",
"wave",
"thumbs up",
"people",
"windows",
"bars",
"seat",
"ring",
"glasses",
"emergency",
"train car",
"locomotive",
"umbrella",
"couple",
"lights",
"plaza",
"wet",
"together",
"Europe",
"shiny",
"night",
"city",
"buildings",
"gap",
"grid",
"urban",
"squares",
"blocks",
"architecture",
"music",
"musicians",
"trumpet",
"piano",
"concert",
"microphone",
"suit",
"man",
"duet",
"Baldwin",
"silhouette",
"ice",
"climbing",
"mountains",
"climber",
"fence",
"backpack",
"gear",
"outdoors",
"glacier",
"shadow",
"sunset",
"lake",
"rocks",
"nature",
"clouds",
"epic",
"amazing",
"cool",
"modern",
"girl",
"dog",
"pink",
"farm",
"bags",
"silos",
"truck",
"hat",
"rural",
"storm",
"bird",
"wings",
"feedings",
"relationship",
"sitting",
"flight",
"flying",
"sharing",
"shirt",
"pen",
"bald",
"old",
"turtle",
"fish",
"underwater",
"framed",
"wildlife",
"animals",
"Austria",
"slow exposure",
"bike lane",
"rail",
"train tracks",
"bricks",
"stoplight",
"railing",
"senior citizens",
"mirror",
"candles",
"kiss",
"earring",
"necklace",
"wallpaper",
"smile",
"close",
"camels",
"pollution",
"smog",
"stick",
"above",
"thinking"
];
$( "#title" ).autocomplete({
                           source: availableTags
                           });
}
</script>


</body>
</html>

