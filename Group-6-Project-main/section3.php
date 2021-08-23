<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title> Exam </title>
<link rel="stylesheet" href="style.css" type="text/css" /> 
</head>
<body style="background-color: #303030; color:white;">
<div class = "maincontent">
<h1 style="text-align:center;">Section 3 </h1>
<p style="text-align:center;">Directions: The questions in this section are based on the reasoning contained in brief statements or passages. For some
questions, more than one of the choices could conceivably answer the question. However, you are to choose the best answer; that
is, the response that most accurately and completely answers the question. You should not make assumptions that are by
commonsense standards implausible, superfluous, or incompatible with the passage. After you have chosen the best answer,
blacken the corresponding space on your answer sheet.</p>
<form action = results2.php method = "POST" >
<?php

$counter = 1;
$handle = fopen("sec3questions.txt", "rt");
$question = fgets($handle);
while (!feof($handle)){
$recordArray =  explode(":", $question);
echo $recordArray[0], ") ", $recordArray[1], "<br/>";
$answerHandle = fopen("sec3questchoices.txt", "rt");
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