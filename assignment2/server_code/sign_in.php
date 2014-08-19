<html>
<head>
	<title>PHPRO Login</title>
</head>
<body>
	<h2>Login Here</h2>
	<form action="sign_in_submit.php" method="post">
		<p>
			<label for="username">username</label>
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
</body>
</html>
