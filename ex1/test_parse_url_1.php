<?php 
$table = array( 
	"1" => "http://username:password@hostname.com/path/file.php?arg1=value1&arg2=value2#anchor",
	"2" => "http://hostname.com:8080/path/file.php?arg1=value1&arg2=value2#anchor",
	"3" => "http://subdom.hostname.com/path/file.php?arg1=value1&arg2=value2#anchor",
	"4" => "//www.example.com/path/file.php?arg1=value1&arg2=value2#anchor",
	"5" => "www.example.com/path/file.php?arg1=value1&arg2=value2#anchor",
	"6" => "/path/file.php?arg[]=value1&arg[]=value2#anchor",
	"7" => "path/file.php?arg1=value1&arg2=value2#anchor",
	
);
$i=1 ;
for ($i; $i < 8 ; $i++):
	var_dump($table[$i]);
	var_dump(parse_url($table[$i]));
endfor;
?>