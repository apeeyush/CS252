<?php
/*** begin our session ***/
session_start();

/*** first check that both the username, password and form token have been sent ***/
if(!isset( $_POST['username'], $_POST['password'], $_POST['form_token']))
{
    $message = 'Please enter a valid username and password';
}
/*** check the form token is valid ***/
elseif( $_POST['form_token'] != $_SESSION['form_token'])
{
    $message = 'Invalid form submission';
}
// check the username has only alpha numeric characters
elseif (ctype_alnum($_POST['username']) != true)
{
    /*** if there is no match ***/
    $message = "Username must be alpha numeric";
}
// check the password has only alpha numeric characters
elseif (ctype_alnum($_POST['password']) != true)
{
        /*** if there is no match ***/
        $message = "Password must be alpha numeric";
}
else
{
    /*** if we are here the data is valid and we can insert it into database ***/
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $password = sha1( $password );
    include("includes/db-config.php");
    $con=mysqli_connect($mysql_hostname, $mysql_username, $mysql_password, $mysql_dbname);

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $select_query = "SELECT * FROM users WHERE username = '$username'";
    $query = mysqli_query($con, $select_query);

    if(mysqli_num_rows($query) > 0){
        $message = "Username already exists";
    }else{
      $query = "INSERT INTO users (username, password ) VALUES ('$username', '$password')";
      $result = mysqli_query($con,$query);
      /*** unset the form token session variable ***/
      unset( $_SESSION['form_token'] );
      /*** if all is done, say thanks ***/
      $message = 'New user added';
    }
}
?>

<html>
<head>
<title>CS252 Login</title>
</head>
<body>
<p><?php echo $message; ?><br>
<a href="/sign_in.php">Sign In</a><br>
</body>
</html>
