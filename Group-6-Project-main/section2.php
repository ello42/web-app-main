<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title> Exam </title>
<link rel="stylesheet" href="style.css" type="text/css" /> 
</head>
<body style="background-color: #303030; color:white;">
<div class = "maincontent">
<h1 style="text-align:center;">Section 2 </h1>
<br>
<p style="text-align:center;"> Directions: Each group of questions in this section is based on a set of conditions. In answering some of the questions, it may be
useful to draw a rough diagram. Choose the response that most accurately and completely answers each question and blacken the
corresponding space on your answer sheet. </p>
<p style="text-align:center;">
<a href = "sec2passage1.html" target="_blank" style="color:#02B2E5;">For questions 1-5, read the linked passage</a>
<br>
<br>
<a href = "sec2passage2.html" target="_blank" style="color:#02B2E5;">For questions 6-11, read the linked passage</a>
<br>
<br>
<a href = "sec2passage3.html" target="_blank" style="color:#02B2E5;">For questions 12-17, read the linked passage</a>
<br>
<br>
<a href = "sec2passage4.html" target="_blank" style="color:#02B2E5;">For questions 18-23, read the linked passage</a>
<br>
<br>
</p>
<form action = results1.php method = "POST" >
<?php

$counter = 1;
$handle = fopen("sec2questions.txt", "rt");
$question = fgets($handle);
while (!feof($handle)){
$recordArray =  explode(":", $question);
echo $recordArray[0], ") ", $recordArray[1], "<br/>";
$answerHandle = fopen("sec2questchoices.txt", "rt");
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