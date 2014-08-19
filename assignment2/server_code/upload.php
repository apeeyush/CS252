<?php
	session_start();
	include("includes/db_config.php");
	$username=$_SESSION['username'];
	$upload_dir='home/aditya/';
	$upfile_name=$username."_".$_FILES["file"]["name"];
	#$con=mysqli_connect($mysql_hostname,$mysql_username,$mysql_password,$mysql_dbname);
	if(!isset($_SESSION['id'])){
		$message="No user is logged in";
	}
	else if(!isset($_FILES["file"]["name"])){
		$message="No file has been uploaded";
	}
	else{
		if($_FILES["file"]["error"]>0){
			$message="Return Code: ".$_FILES["file"]["error"]."<br>";
		}
		else{
			$message="Upload: " . $_FILES["file"]["name"] . "<br>";
			$message.="Type: " . $_FILES["file"]["type"] . "<br>";
			$message.="Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
			$message.="Stored in: " . $_FILES["file"]["tmp_name"]."<br>";

			if(file_exists($upload_dir.$upfile_name)){
				$message.="<br>".$_FILES["file"]["name"]." already exists. ";
			}
			else{
				if(move_uploaded_file($_FILES["file"]["tmp_name"], $upload_dir.$upfile_name)){
					$message.="<br> File uploaded successfully.";
				}
				else{
					$message.="<br> File upload interrupted.";
				}
			}
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