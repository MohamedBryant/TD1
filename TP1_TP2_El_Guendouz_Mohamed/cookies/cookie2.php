 <?php
 
	setcookie ('test_cookie_1','valeur_test_1', time()-3600);
	setcookie ('test_cookie_2' ,'xxx' , time()-3600);
	setcookie ('test_cookie_4');
	setcookie ('test_cookie_7' , false);
	
	var_dump($_COOKIE);
 ?>
 <a href="cookie2.php"> Rechargement </a> <br>
<a href="cookie1.php"> Redirection vers cookie1.php </a> <br>