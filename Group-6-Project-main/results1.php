<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title> Exam </title>
<link rel="stylesheet" href="style.css" type="text/css" /> 
</head>
<body style="background-image: url('resultsbackground.jpg');color:white; background-size: cover; background-position: center center; text-align:center; font-size: 45px;">
<div class = "maincontent">
<h1>Section 2 </h1>
<?php
$count = $_POST['counter'];
for($i = 1; $i < $count; $i++){
if (empty($_POST["$i"])){

die ("You must select an answer for each question!");}
$answer[] = trim($_POST["$i"]);
}

$correctAnswers = 0;
$handle = fopen("sec2questions.txt", "rt");

$counter = 0;

do{
$answers = fgets($handle);
$recordArray =  explode(":", $answers);
if (trim($recordArray[2]) == $answer[$counter]){
++$correctAnswers;
}
++$counter;
}while (!feof($handle) && $counter < count($answer));
$noQuestions = count($answer);
echo "$correctAnswers / $noQuestions ";
$percent = ($correctAnswers/$noQuestions)*100;
echo "<br/>", "You scored a $percent% on the quiz";
// send email with score to instructor
echo "<br><br><form action = 'mail.php' method = 'POST' >
Send your score to the instructor<br>
Name: <input type='text' name='name'><br>
Test: <input type='text' name='test'><br>
<input type='hidden' name='score' value=$percent>
<input type='submit'>
</form>";
/*if($percent >= 80){
echo "<h3 class = 'green'>", "You scored a $percent% on the quiz", "</h3>";
}
else if ($percent >= 60){
echo "<h3 class = 'yellow'>", "You scored a $percent% on the quiz", "</h3>";
}
else if ($percent >= 50){
echo "<h3 class = 'red'>", "You scored a $percent% on the quiz", "</h3>";
}
else{
echo "<h3>", "You scored a $percent% on the quiz", "</h3>";
}
echo '<br/>','<br/>','<a href = "http://helios.ite.gmu.edu/~dchintak/IT207/PRACTICUM2/index.php">Return to Quiz Page</a>','<br/>','<br/>';
date_default_timezone_set('EST');
echo "Last modified: " . date ("H:i F d, Y T", getlastmod());
*/
?>
<br>
<br>
<a href = "exam.html">Return to Exam Home Page</a>
</div>
</body>
</html>