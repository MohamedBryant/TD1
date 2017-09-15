<html>
	<head> 
		<meta charset="utf-8"> 
		<title>test_url_code_2</title>
	</head>
	<body> 
		<?php 
			$url1 = 'edit?cours=wim2&auteur=Denis Finck';
			echo 'URL : ', $url1, '<br/>'; 
			echo 'Encodage : ', 
			urlencode($url1), '<br/><br/>';
			echo 'Décodage : ', 
			urldecode(urlencode($url1)), '<br/><br/>'; 
			echo 'Encodage : ', 
			rawurlencode($url1), '<br/><br/>'; 
			echo 'Décodage : ', 
			rawurldecode(rawurlencode($url1)), '<br/><br/>'; 
			echo 'Décodage mixte : ', 
			urldecode(rawurlencode($url1)), '<br/><br/>'; 
			echo 'Décodage mixte : ', 
			rawurldecode(urlencode($url1)), '<br/><br/>'; 
			echo 'Double codage mixte : ', 
			rawurlencode(urlencode($url1)), '<br/><br/>'; 
		?> 
	</body>
</html>
