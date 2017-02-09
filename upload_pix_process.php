<?php
session_start();
include_once("Connections/dbconnect.php");

$current_id=1;

$check_last_id=mysql_query("select * from gallery order by id desc");

if($check_last_id==FALSE)
{
	$_SESSION['message']="Error encountered accessing gallery record! ".mysql_error();
	$_SESSION['messagetype']="error";
	header("location: upload.php");
	exit();
}

if(mysql_num_rows($check_last_id)>0)
{
	mysql_data_seek($check_last_id,0);
	$row=mysql_fetch_assoc($check_last_id);
	$current_id=$row['id']+1;
}

if(is_uploaded_file($_FILES['mypix']['tmp_name'])==FALSE)
{
	$error=$_FILES['mypix']['error'];
	if($error==1 || $error==2)
	{
		$_SESSION['message']="Please upload a jpg file not more than 1MB!";
	}
	elseif($error==3)
	{
		$_SESSION['message']="File was partially uploaded. Please upload again!";
	}
	elseif($error==4)
	{
		$_SESSION['message']="No file was uploaded. Please upload a jpg file.";
	}
	else
	{
		$_SESSION['message']="Error encountered uploading file. Please upload file again.";
	}
	$_SESSION['messagetype']="error";
	header("location: upload.php");
	exit();
}

$target_file="images/". $current_id .".jpg";

if(move_uploaded_file($_FILES['mypix']['tmp_name'],$target_file)==FALSE)
{
	$_SESSION['message']="Error encountered uploading file. Please upload file again.";
	$_SESSION['messagetype']="error";
	header("location: upload.php");
	exit();
}

$pix_tag=isset($_POST['pix_tag']) ? trim($_POST['pix_tag']) : "";

if($pix_tag=="")
{
	$_SESSION['message']="Please enter picture tag.";
	$_SESSION['messagetype']="error";
	header("location: upload.php");
	exit();
}

$add_pix_tag=mysql_query("insert into gallery set pix_tag='$pix_tag'");

if($add_pix_tag==FALSE)
{
	$_SESSION['message']="Error encountered adding picture tag to record! ".mysql_error();
	$_SESSION['messagetype']="error";
	header("location: upload.php");
	exit();
}

$_SESSION['message']="Picture has been successfully uploaded";
$_SESSION['messagetype']="success";
header("location: index.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>