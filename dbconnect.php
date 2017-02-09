<?php 

//1.define connection vaiables
$db_name='dream';
$db_host='localhost';
$db_username='dream';
$db_password='testpassword';


//2. establish a connection to mysql
$connection=mysql_connect("$db_host", "$db_username" ,"$db_password");

//3.if connection was not succesful
if($connection==FALSE)
{
	die("connection failed! ".mysql_error());
}

//4.if connection succeful, select database

$select_db=mysql_select_db("$db_name",$connection);

if($select_db==FALSE)
{
	die("database selection error! ".mysql_error());
}
?>
