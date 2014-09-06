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

	<?php if (isset( $_SESSION['id'])): ?>
  		<p>User is already signed in!</p>
  		<a href='/sign_out.php'>Sign Out</a>
		<br><a href="/stats.php">Statistics</a><br>
		<a href="/upload.html">Upload</a>

	<?php else: ?>
		<h2>Sign In</h2>
		<form action="sign_in_submit.php" method="post">
			<p>
				<label for="username">Username</label>
				<input type="text" id="username" name="username" value="" maxlength="20" />
			</p>
			<p>
				<label for="password">Password</label>
				<input type="password" id="password" name="password" value="" maxlength="20" />
			</p>
			<p>
				<input type="submit" value="Sign In" />
			</p>
		</form>
	<?php endif; ?>

</body>
</html>
