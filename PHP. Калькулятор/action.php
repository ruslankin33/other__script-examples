<?php

session_start();

$num1 = $_POST['num1'];
$num2 = $_POST['num2'];
$znak = $_POST['znak'];

function getSum($z1,$z2,$z3) {
	switch ($z3) {
		case '+':
			$sum = $z1 + $z2;
			break;
		case '-':
			$sum = $z1 - $z2;
			break;
		case '*':
			$sum = $z1 * $z2;
			break;
		case '/':
			$sum = $z1 / $z2;
			break;
	}
	return $sum;
}

$result = getSum($num1,$num2,$znak);
$_SESSION['result'] = $result;

header ("Location: index.php");