<?php
/*** begin our session ***/
session_start();
if(isset( $_SESSION['id'] ))
{
    $message = 'User is already signed in';
}

?>

<html>
<head>
	<title>Sign In</title>
</head>
<body>

	<? if ($message == "User is already signed in"): ?>
  		<p>User is already signed in!</p>
  		<a href='/sign_out.php'>Sign Out</a>
	<? else: ?>
	<h2>Sign In</h2>
		<form action="sign_in_submit.php" method="post">
			<p>
				<label for="username">Username</label>
				<input type="text" id="username" name="username" value="" maxlength="20" />
			</p>
			<p>
				<label for="password">Password</label>
				<input type="text" id="password" name="password" value="" maxlength="20" />
			</p>
			<p>
				<input type="submit" value="Sign In" />
			</p>
		</form>
	<? endif; ?>

</body>
</html>
