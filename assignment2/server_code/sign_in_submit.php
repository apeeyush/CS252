<?php

session_start();
/*** check if the users is already logged in ***/
if(isset( $_SESSION['id'] ))
{
    $message = 'Users is already logged in';
}
/*** check that both the username, password have been submitted ***/
if(!isset( $_POST['username'], $_POST['password']))
{
    $message = 'Please enter a valid username and password';
}
/*** check the username is the correct length ***/
elseif (strlen( $_POST['username']) > 20 || strlen($_POST['username']) < 4)
{
    $message = 'Incorrect Length for Username';
}
/*** check the password is the correct length ***/
elseif (strlen( $_POST['password']) > 20 || strlen($_POST['password']) < 4)
{
    $message = 'Incorrect Length for Password';
}
else
{
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $password = sha1( $password );
    include("includes/db-config.php");
    try
    {
        $con=mysqli_connect($mysql_hostname, $mysql_username, $mysql_password, $mysql_dbname);
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($con,$query);
        $num_row = mysqli_num_rows($result);

        if( $num_row != 1)
        {
                $message = 'Login Failed';
        }
        else
        {
            while( $row=mysqli_fetch_array($result) ){
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
            }
            $message = 'You are now logged in';
        }
    }
    catch(Exception $e)
    {
        $message = 'We are unable to process your request. Please try again later"';
    }
}
?>

<html>
<head>
<title>CS 252</title>
</head>
<body>
<p><?php echo $message; ?>
</body>
</html>