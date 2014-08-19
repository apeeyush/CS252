<?php

/*** begin the session ***/
session_start();
if(!isset($_SESSION['id']))
{
    $message = 'You must be logged in to access this page';
}
else
{
    try
    {
        include("includes/db-config.php");
        $username = $_SESSION['username'];
        if($username == false){
            $message = 'Access Error';
        } else {
            $message = 'Welcome '.$username;
        }
    }
    catch (Exception $e)
    {
        $message = 'We are unable to process your request. Please try again later"';
    }
}

?>

<html>
<head>
<title>Statistics</title>
</head>
<body>
<h2><?php echo $message; ?></h2>
</body>
</html>