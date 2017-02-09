<?php
session_start();
?>
<?php require_once('Connections/dbconnect.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_dbconnect, $dbconnect);
$query_picture_list = "SELECT * FROM gallery ORDER BY id DESC";
$picture_list = mysql_query($query_picture_list, $dbconnect) or die(mysql_error());
$row_picture_list = mysql_fetch_assoc($picture_list);
$totalRows_picture_list = mysql_num_rows($picture_list);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<link href="styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<p align="center"><a href="upload.php">Add a New Picture</a></p>
<hr />
<?php
	if(isset($_SESSION['message']))
	{
		?>
        	<p class="<?php  echo $_SESSION['messagetype'];?>"><?php echo $_SESSION['message']; ?></p>
        <?php
		unset($_SESSION['message'], $_SESSION['messagetype']);
	}
?>
<?php
if($totalRows_picture_list<=0)
{
	?>
    	<p class="error">No picture has found!</p>
    <?php
}
else
{
	?>
    	<table align="center" cellpadding="5" cellspacing="1">
        	<tr bgcolor="#efefef">
            	<?php 
					$count=0;
					$bgcolor="#efefef";
				do { 
					$count++;
				?>
           	    <td align="center"><a href="images/<?php echo $row_picture_list['id']; ?>.jpg" target="_blank"><img src="images/<?php echo $row_picture_list['id']; ?>.jpg" width="100px" /><br />
           	      <?php echo $row_picture_list['pix_tag']; ?></a></td>
            	  <?php 
				  	if($count%4==0)
					{
						$bgcolor=($bgcolor=="#efefef") ? "#dcdcdc" : "#efefef";
						?>
                        	</tr><tr bgcolor="<?php echo $bgcolor ?>">
                        <?php
					}
				  } while ($row_picture_list = mysql_fetch_assoc($picture_list)); ?>
            </tr>
        </table>
    <?php
}
?>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($picture_list);
?>
