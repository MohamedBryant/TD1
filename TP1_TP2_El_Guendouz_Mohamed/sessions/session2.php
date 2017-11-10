<?php
ini_set('session.use_only_cookie', 0);
session_start();

if (!isset($_SESSION['count']))
{
	$_SESSION['count'] = 1;
}
else
{
	$_SESSION['count']++ ;
}


if ($_SESSION['count'] >= 3)
{
	session_destroy();
	echo 'Session détruite <br>';
}

echo 'Bonjour, vous avez vu cette page '.$_SESSION['count']. ' fois';
var_dump($_SESSION);
?>

 <a href="session2.php"> Rechargement </a> <br>