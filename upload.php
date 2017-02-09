<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="styles.css" rel="stylesheet" type="text/css" />
</head>

<?php
if(isset($_SESSION['message']))
{
	?>
    <p><?php echo $_SESSION['message']; ?></p>
    <?php
	unset($_SESSION['message']);
}
?>
<body>
<p align="center"><a href="index.php">Back to Gallery</a></p>
<?php
	if(isset($_SESSION['message']))
	{
		?>
<p class="<?php  echo $_SESSION['messagetype'];?>"><?php echo $_SESSION['message']; ?></p>
        <?php
		unset($_SESSION['message'], $_SESSION['messagetype']);
	}
?>
<form action="upload_pix_process.php" method="post" enctype="multipart/form-data" id="myform">
  <table align="center" cellpadding="10" cellspacing="1">
    	<tr bgcolor="#efefef">
        	<td>Choose Picture:</td>
        	<td><input name="mypix" type="file" id="mypix" /></td>
        </tr>
        <tr bgcolor="#dcdcdc">
        	<td>Picture Tag:</td>
            <td><input name="pix_tag" type="text" id="pix_tag" /></td>
        </tr>
        <tr bgcolor="#efefef">
        	<td colspan="2" align="center"><input name="Button" type="button" onclick="validate_bttn()" value="Upload" /></td>
        </tr>
    </table>
      <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
</form>
<script language="javascript">
	function validate_bttn()
	{
		var i=document.getElementById("mypix").value;
		if(i=="")
		{
			alert("Please Your Picture File");
			return null;
		}
		var the_length=i.length;
		//alert(the_length +" i is "+ i);
		
		var ext=i.substr(the_length-4,4);
		//alert("the extension is - "+ext);
		
		ext=ext.toLowerCase();
		
		if(ext[0]!="." || ext[1]!="j" || ext[2]!="p" || ext[3]!="g")
		{
			alert("This is a '"+ ext +"' file. Please choose a '.jpg' file!");
			return null;
		}
		
		if(document.getElementById("pix_tag").value=="")
		{
			alert("Please enter picture tag!");
			document.getElementById("pix_tag").focus();
			return null;
		}
		document.getElementById("myform").submit();
	}

</script>
</body>
</html>