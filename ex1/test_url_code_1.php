<html>
	<head> 
		<title>test_url_code_1</title>
	</head>
	<body> 
		<?php 
			echo 'var_dump de $_GET :'; 
			var_dump($_GET); 
			echo 'Ré encodage de $_GET par http_build_query($_GET) : ', 
			http_build_query ($_GET), '<br/><br/>'; 
			echo 'urldecode(http_build_query ($_GET)) = ', 
			urldecode(http_build_query ($_GET)), '<br/><br/>';
			$x = $_SERVER['REQUEST_URI']; 
			echo '$_SERVER["REQUEST_URI"] = ',$x,	'<br/>';
			echo 'urldecode($_SERVER["REQUEST_URI"]) = ', 
			urldecode($x), '<br/><br/>'; 
		?> 
	</body>
</html>