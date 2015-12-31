<!DOCTYPE html>
<html>
<title>El 3M'S w nourhan</title>
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" type="text/css" href="style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="demo.css" media="all" />
</head>
<body>
<div class="container">
 <div class="back-to-reg">
                <a href="Profile.php" target = "_self"><strong>Back To My Profile</strong></a>
               <!-- <span class="right">
                    <a href="profile.php">
                        <strong>You Can login directly from here</strong>
                    </a> 
                </span>  -->
                <div class="clr"></div>
            
            </div>
<header>
    <h1><span>Welcome</span>Please Upload a Photo Here</h1>
            </header>      
<form enctype="multipart/form-data" method="post">
<div class="Tables">
<table style="border-collapse: collapse; font: 12px Tahoma;" border="1" cellspacing="5" cellpadding="5">
<tbody><tr>
<td>
<div class="miss">
<input class="buttom" name="uploaded" type="file">
</div>
<?php
session_start();
if (isset($_POST['submit']) && $_FILES['uploaded']['size'] != 0 && $_FILES['uploaded']['error'] == 0)
{
if ($_POST['submit'] == 'Upload Image')
  {
   $uploaded = $_FILES['uploaded']['name'];
   $_SESSION['img']=$uploaded;
   echo $uploaded.'<br>';
   header( "Location: profile.php" ); die;
  }
}
?>
</td>
</tr>
<tr>
<td>
<div class="miss">
<input class="buttom" name="submit" type="submit" value="Upload Image">
</div>
</td>
</tr>
</tbody></table>
</form> 
</div>
</div>
</body>
</html>
