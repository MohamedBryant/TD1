<?php
session_start();

if (!isset($_SESSION['count']))
{
	$_SESSION['count'] = 0;
}
else
{
	$_SESSION['count']++ ;
}

if ($_SESSION['count'] >= 4)
{
	$_SESSION['count'] = 0;
}
var_dump($_SESSION);

?>

 <a href="session1.php"> Rechargement </a> <br>