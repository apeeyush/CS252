<?php

session_start();

	if(session_destroy()){
		$message = 'Session Destroyed';
	} else{
		$message = 'Error';
	}
?>

<html>
<head>
</head>
<body>
<?php echo $message; ?>
</body>
</html>