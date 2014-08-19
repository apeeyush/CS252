<?php
session_start();
	if(session_destroy()){
		$message = 'Destroyed';
	} else{
		$message = 'Error';
	}
?>
<html>
<head>
</head>
<body>
	<? if ($message == "Destroyed"): ?>
  		<h2>Signed Out Successfully</h2>
  		<a href='/sign_in.php'>Sign In</a>
	<? else: ?>
		<h2>Error</h2>
	<? endif; ?>
</body>
</html>