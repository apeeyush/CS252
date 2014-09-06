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
	<?php if ($message == "Destroyed"): ?>
  		<h2>Signed Out Successfully</h2>
  		<a href='/sign_in.php'>Sign In</a>
	<?php else: ?>
		<h2>Error</h2>
	<?php endif; ?>
</body>
</html>
