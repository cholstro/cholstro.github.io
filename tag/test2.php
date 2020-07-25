<?php
    
    $mysqli_connection = new MySQLi('vergil.u.washington.edu', 'root', 'degobah', 'tagging_experiment', 1357);
    if(!$mysqli_connection){
        die('Could not connect: ' . mysql_error());
    }
 
    $userid = $_POST['userid'];
    $photoid = $_POST['photoid'];
    $photoid_array = $_POST['photoid_array'];
    $auto = $_POST['autobool'];
    $suggest = $_POST['suggestbool'];
    $tags = $_POST['tags'];
    $order = $_POST['order'];
    $condition = $_POST['condition'];
    
    
 $sql = "INSERT INTO tag_data (`user_id`, `photo_id`, `suggested_tags`, `auto_complete`, `exp_order`, `tags`) VALUES ('$userid','$photoid','$auto', '$suggest', '$order','$tags')";

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
        echo "<p>Hooray! You're all done tagging. Thanks so much!<br>";
        echo "<p>Copy and paste the following code in Mechanical Turk: " .$userid. "<br>";
    } else {
        echo 'You are ' . $neworder . ' out of 16 pictures of the way there.<br><br>';
        echo '<form action="test.php" method="post">';
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


