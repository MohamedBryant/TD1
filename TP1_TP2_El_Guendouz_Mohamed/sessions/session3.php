<?php

ini_set('session.use_only_cookies', 0);

//var_dump(SID);

session_start();

var_dump(SID);

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
	echo 'Session détruite.' . '<br>';
}

echo 'Bonjour, vous avez vu cette page '.$_SESSION['count']. ' fois';
var_dump($_SESSION);
?>

 <a href="session3.php?<?php echo SID; ?>"> Rechargement </a> <br>