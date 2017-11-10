<?php

	setcookie ('local_cookie_1','valeur_local_1', time()+3600);
	setcookie ('local_cookie_2' ,'valeur_local_2', time()+3600,'/','',false,true);

	var_dump($_COOKIE);
?>
	