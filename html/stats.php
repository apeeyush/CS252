<html>
<head>
<title>Statistics</title>
</head>
<body>

<?php

/*** begin the session ***/
session_start();

function match($s1,$s2)
{
        $u=strstr($s2,'_',true);
        return $s1==$u;
}

if(!isset($_SESSION['id']))
{
    $message = 'You must be logged in to access this page';
}
else
{
	echo '<h2>Your files: </h2>';
	$user=$_SESSION['username'];
	$dir="uploads";
	$files=scandir($dir);
	include("includes/notallowed.php");
	foreach ($files as &$val)
	{
	        if(match($user,$val)==1)
	        {
			$temp = explode(".",$val);
			$extn = end($temp);
			if(!in_array($extn,$extn_not_allowed)){        	
	                	$disp2= strstr($val,'_',false);
	                	$disp=substr($disp2,1);
	                	echo '<a href= "uploads/'.$val.'" > '.$disp.' </a><br>';
	                }
		}
	}
}

?>

</body>
</html>
