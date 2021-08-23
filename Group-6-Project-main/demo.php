<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title> Exam Demo </title>
<link rel="stylesheet" href="style.css" type="text/css" /> 
</head>
<body style="background-color: #303030; color:white;">
<div class = "maincontent">
<h1 style="text-align:center;">Demo</h1>
<br>
<form action = "demoresults.php" method = "POST" >
<?php

$counter = 1;
$handle = fopen("demoquestions.txt", "rt");
$question = fgets($handle);
while (!feof($handle)){
$recordArray = explode(":", $question);
echo $recordArray[0], ") ", $recordArray[1], "<br/>";
$answerHandle = fopen("demoquestchoices.txt", "rt");
$questionchoices = fgets($answerHandle);
while (!feof($answerHandle)){
$recordAArray =  explode(":", $questionchoices);
if ($recordArray[0] == $recordAArray[0]){
echo "<input type = 'radio' name = $counter value = $recordAArray[1]>";
echo $recordAArray[1], ") ", $recordAArray[2], "<br/>";
}
$questionchoices = fgets($answerHandle);

}
$question = fgets($handle);
echo "<br/>";
++$counter;
}
echo "<input type='hidden' name='counter' value='$counter'/>";
echo "<input type='submit' name='submit' value='Submit'/>";


?>
</form>
</div>

</body>
</html>