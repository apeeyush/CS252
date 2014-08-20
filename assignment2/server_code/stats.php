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
        if ($username != false){
            include("includes/db-config.php");
            $con=mysqli_connect($mysql_hostname, $mysql_username, $mysql_password, $mysql_dbname);
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            $query = "SELECT * FROM files WHERE username = '$username'";
            $result = mysqli_query($con,$query);
            
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
    <? if ($username == false): ?>
        <p>Please Log In to see uploaded files</p>
    <? else: ?>
        <?php
            while( $row=mysqli_fetch_array($result) ){
                echo $row['filename'];
                echo "<br>";
            }
        ?>
    <? endif; ?>

</body>
</html>