<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title> Success </title>
<link rel="stylesheet" href="style.css" type="text/css" /> 
</head>
<body>
<div class = "maincontent">
<h1>Success</h1>
Your score has been successfully sent to the instructor

<?php
$name = $_POST['name'];
$score = $_POST['score'];
$test = $_POST['test'];
$msg = "$name scored $score% on $test.";
mail("axalnix@gmail.com","LSAT score",$msg);
?>
<br>
<br>
<a href = "exam.html">Return to Exam Home Page</a>

</div>
</body>
</html>