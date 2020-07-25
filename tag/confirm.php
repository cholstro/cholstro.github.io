<?php
    
    $mysqli_connection = new MySQLi('vergil.u.washington.edu', 'root', 'degobah', 'tagging_experiment', 1357);
    if(!$mysqli_connection){
        die('Could not connect: ' . mysql_error());
    }
// Block people who try to get to this page directly.
   if(!$_POST['userid']){
     header('Location: /cholstro/tag/');
     exit; 
   } 

       // Get the POST values passed to the page.
    $userid = $_POST['userid'];
    $photoid = $_POST['photoid'];
    $photoid_array = $_POST['photoid_array'];
    $auto = $_POST['autobool'];
    $suggest = $_POST['suggestbool'];
    $tags = $_POST['tags'];
    $order = $_POST['order'];
    $condition = $_POST['condition'];

// If they submit no tags, send them back to previous state.

   if(!$_POST['tags']){
	        echo 'You must submit at least one tag.<br><br>';
        echo '<form action="index.php" method="post">';
        echo '<input type="hidden" name="order" id="order" value="'.$order.'">';
        echo '<input type="hidden" name="userid" id="userid" value="'.$userid.'">';
        echo '<input type="hidden" name="photoid_array" id="photoid_array" value="'.$photoid_array.'">';
        echo '<input type="hidden" name="suggestbool" id="suggestbool" value="'.$suggest.'">';
        echo '<input type="hidden" name="autobool" id="autobool" value="'.$auto.'">';
        echo '<input type="hidden" name="condition" id="condition" value="'.$condition.'">';
        echo '<input type="submit" value="Go back to where I was" class="submit-button" />';
        echo '</form>';
    exit;
   }

   

 // Write to the database
 $sql = "INSERT INTO tag_data (`user_id`, `photo_id`, `suggested_tags`, `auto_complete`, `exp_order`, `tags`, `Timestamp`) VALUES ('$userid','$photoid','$auto', '$suggest', '$order','$tags', NOW())";

    // Increment order to pass it back.
    $neworder = $order + 1;

    if($neworder == 4 || $neworder == 8 || $neworder == 12){
        $newcondition = $condition + 1;
    } else {
        $newcondition = $condition;
    }
    if($newcondition == 5){
        $newcondition = 1;
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
<h1>
<?php
    if ($mysqli_connection->query($sql) === TRUE) {
        echo "Thank you for tagging!";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli_connection->error;
    }
echo "</h1>";

    if($order==15) {
	    /*        echo "<p>Hooray! You're all done tagging. Thanks so much!<br>"; */
        echo "<p>Here is your code to enter in Mechanical Turk:<br>";
        echo $userid;
/*      echo "<p>If you are willing, please provide some demographic information.<br>";
        echo "<form action='demog.php' method='post'>";
        echo "<p>Gender:<br> <select name='gender' id='gender'>";
        echo "<option value='female'>Female</option>";
        echo "<option value='male'>Male</option>";
        echo "<option value='nonbinary'>Non-binary</option>";
        echo "<option value='nope'>Prefer Not to Answer</option>";
        echo "</select>";
        echo"<p>Age:<br> <input id='number' name='number' type='number'>";
        echo "<p>Education completed:<br> <select name='education' id='education'>";
        echo "<option value='highschool'>High School</option>";
        echo "<option value='college'>College</option>";
        echo "<option value='masters'>Masters</option>";
        echo "<option value='phd'>PhD</option>";
        echo "<option value='other'>Other</option>";     
        echo "</select>"; 
        echo "<p>e-mail (to enter to win $10 gift card):<br><input type='email' name='email'>";
        echo '<input type="hidden" name="userid" id="userid" value="'.$userid.'">'; 
        echo "<br><br><input type='submit' value='Submit' class='submit-button' />";     
        echo "</form>";
*/
    } else {
        echo 'You are ' . $neworder . ' out of 16 pictures of the way there.<br><br>';
        echo '<form action="index.php" method="post">';
        echo '<input type="hidden" name="order" id="order" value="'.$neworder.'">';
        echo '<input type="hidden" name="userid" id="userid" value="'.$userid.'">';
        echo '<input type="hidden" name="photoid_array" id="photoid_array" value="'.$photoid_array.'">';
        echo '<input type="hidden" name="suggestbool" id="suggestbool" value="'.$suggest.'">';
        echo '<input type="hidden" name="autobool" id="autobool" value="'.$auto.'">';
        echo '<input type="hidden" name="condition" id="condition" value="'.$newcondition.'">';
        echo '<input type="submit" value="Go to the next picture!" class="submit-button" />';
        echo '</form>';
    }
    


?>
</div>
<div class="column right">

</div>


</body>
</html>
