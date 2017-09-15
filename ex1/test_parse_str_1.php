<?php
$table = array( 
	
	"1" => "http://localhost/drupal/module1/fonction1/?arg1=value1&arg2=value2#anchor",
	"2" => "http://localhost/drupal/index.php?q=module1/fonction1&arg[]=value1&arg[]=value2#anchor",
	"3" => "http://localhost/drupal/index.php?q=module1/fonction1?arg1=value1&arg2=value2#anchor",	
);
$i=1 ;
for ($i; $i < 4 ; $i++):
	var_dump($table[$i]);
	var_dump(parse_str($table[$i]));
endfor;
?>