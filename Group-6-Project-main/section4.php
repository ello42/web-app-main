<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title> Exam </title>
<link rel="stylesheet" href="style.css" type="text/css" /> 
</head>
<body style="background-color: #303030; color:white;">
<div class = "maincontent">
<h1 style="text-align:center;">Section 4 </h1>
<br>
<p style="text-align:center;"> Directions: Each set of questions in this section is based on a single passage or a pair of passages. The questions are to be
answered on the basis of what is stated or implied in the passage or pair of passages. For some of the questions, more than one
of the choices could conceivably answer the question. However, you are to choose the best answer; that is, the response that most
accurately and completely answers the question, and blacken the corresponding space on your answer sheet. </p>
<p style="text-align:center;">
<a href = "sec4passage1.html" target="_blank" style="color:#02B2E5;">For questions 1-6, read the linked passage/s</a>
<br>
<br>
<a href = "sec4passage2.html" target="_blank" style="color:#02B2E5;">For questions 7-14, read the linked passage/s</a>
<br>
<br>
<a href = "sec4passage3.html" target="_blank" style="color:#02B2E5;">For questions 15-19, read the linked passage/s</a>
<br>
<br>
<a href = "sec4passage4.html" target="_blank" style="color:#02B2E5;">For questions 20-27, read the linked passage/s</a>
<br>
<br>
</p>
<form action = results4.php method = "POST" >
<?php

$counter = 1;
$handle = fopen("sec4questions.txt", "rt");
$question = fgets($handle);
while (!feof($handle)){
$recordArray =  explode(":", $question);
echo $recordArray[0], ") ", $recordArray[1], "<br/>";
$answerHandle = fopen("sec4questchoices.txt", "rt");
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