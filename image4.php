<!DOCTYPE html>
<html>
<title>El 3M'S w nourhan</title>
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" type="text/css" href="style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="demo.css" media="all" />
         
<script type="text/javascript">
function validate(){
var img= document.getElementById("uploadedim").value;
if (img==null || pass=="")
{
		alert ("Please select a photo");
		return false;
}

return true;
} 
</script>
</head>
<body>
<div class="container">
 <div class="back-to-reg">
                <a href="Profile.php" target = "_self"><strong>Back To My Profile</strong></a>
                <div class="clr"></div>
            
            </div>
<header>
    <h1><span>Welcome</span>Please Edit Your Profile Picture Here</h1>
            </header>   
<form enctype="multipart/form-data" method="post" onsubmit="return validate()">
<table style="border-collapse: collapse; font: 12px Tahoma;" border="1" cellspacing="5" cellpadding="5">
<tbody><tr>
<td>
<input name="uploadedimage" type="file" id="uploadedim">
<?php
session_start();

if (isset($_POST['submit']) && $_FILES['uploadedimage']['size'] != 0 && $_FILES['uploadedimage']['error'] == 0)
{
	if ($_POST['submit'] == 'Upload Image' )
	{
	$uploadedimage = $_FILES['uploadedimage']['name'];
	$_SESSION['image']=$uploadedimage;
	echo $uploadedimage.'<br>';
	header( "Location: image1.php" ); die;
	}
}
?>
</td>
</tr>
<tr>
<td>
<input name="submit" type="submit" value="Upload Image" onsubmit="validate()">
</td>
</tr>
</tbody></table>
</form> 
</div>
</body>
</html>
