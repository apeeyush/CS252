<?php
	session_start();
	include("includes/notallowed.php");
	$username=$_SESSION['username'];
	$upload_dir='uploads/';
	$upfile_name=$username."_".$_FILES["file"]["name"];
	$name=explode(".",$upfile_name);
	$temp = explode(".",$upfile_name);
	$extn = end($temp);
	//$not_allowed=array('sh');
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
		else if(in_array($extn,$not_allowed)){
			$message="This extension is not allowed.<br>";
		}
		else{
			$message="Upload: " . $_FILES["file"]["name"] . "<br>";
			$message.="Type: " . $_FILES["file"]["type"] . "<br>";
			$message.="Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
			$message.="Stored in: " . $_FILES["file"]["tmp_name"]."<br>";
			if(file_exists($upload_dir.$upfile_name)){
				$message.="<br>".$_FILES["file"]["name"]." already exists. File uploaded ith timestamp.";
				$date= new DateTime();
				$timestamp=$date->getTimestamp();
				//echo $name[0].'hello<br>'.$extn.'<br>';
				if(move_uploaded_file($_FILES["file"]["tmp_name"], $upload_dir.$name[0]."_".$timestamp.".".$extn)){
					$message.="<br> File uploaded successfully.";
				}
				else{
					$message.="<br> File upload interrupted.";
				}
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
