<?php
    
    $mysqli_connection = new MySQLi('vergil.u.washington.edu', 'root', 'degobah', 'tagging_experiment', 1357);
    if(!$mysqli_connection){
        die('Could not connect: ' . mysql_error());
    }
 
    $gender = $_POST['gender'];
    $age = $_POST['number'];
    $education = $_POST['education'];
    $userid = $_POST['userid'];
    $email = $_POST['email'];
    
    
 $sql = "INSERT INTO user_data (`user_id`, `gender`, `age`, `education`, `email`) VALUES ('$userid','$gender','$age', '$education', '$email')";

    
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
        echo "<h1>Thank you for tagging!</h1> <p>And thanks for providing demographic info! You are all done.";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli_connection->error;
    }

?>
</div>
<div class="column right">

</div>


</body>
</html>