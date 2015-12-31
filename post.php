<!DOCTYPE html>
<html>
<head> <title> Profile </title> 
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
<link rel="stylesheet" type="text/css" href="style.css" media="all" />
<link rel="stylesheet" type="text/css" href="demo.css" media="all" />
</head>
<body>
<?php
if ($_POST['post'])
{  
  session_start();
 $email=$_SESSION['email'];
 $name=$_SESSION['name'];
 $uploaded=$_SESSION['im'];
 $c = mysql_connect("localhost", "root", ""); 
 if (!$c) {
 die("Database connection failed: " . mysql_error());
 }
 $db_select = mysql_select_db("user",$c);
 if (!$db_select) {
  die("Database failed: " . mysql_error());}
     $result = mysql_query("SELECT * FROM post", $c);
  if (!$result) {
      die("Database query failed: " . mysql_error());
    }
    $caption = $_POST['caption'];
   // echo "$caption";
   $caption= str_replace(';)', '<img src="wink.png" title=";)"/>', $caption);
   $caption= str_replace(':)', '<img src="ebtesama.jpg" title=";)"/>', $caption);
   $caption= str_replace(':(', '<img src="sad.png" title=";)"/>', $caption);
   $caption= str_replace(':*', '<img src="kiss.png" title=";)"/>', $caption);
   $caption= str_replace(':D', '<img src="akbar.jpg" title=";)"/>', $caption);
   $caption= str_replace('(H)', '<img src="COOOL.jpg" title=";)"/>', $caption);
   $caption= str_replace(':|', '<img src="poker.png" title=";)"/>', $caption);
   $caption= str_replace(':P', '<img src="tongue.png" title=";)"/>', $caption);
   $caption= str_replace(':@', '<img src="angry.png" title=";)"/>', $caption);
   $caption= str_replace(':S', '<img src="ta3asa.jpg" title=";)"/>', $caption);
   $caption= str_replace('<3', '<img src="heart.png" title=";)"/>',$caption);
   $caption= str_replace(':3', '<img src="sun.png" title=";)"/>',$caption);
   
    $privacy= $_POST['Privacy'];
   // echo "$privacy";
     mysql_query("INSERT INTO `post`(`caption`, `email`, `name`, `likes`, `privacy`, `time`, `image`) VALUES ('$caption','$email','$name',null,'$privacy',CURRENT_TIMESTAMP,'$uploaded')") or die(mysql_error());
   if($privacy==1)
   {
	    $result2=mysql_query("SELECT * from `register` where email='$email'");
		$row2 = mysql_fetch_array( $result2 );
		$fname2=$row2['fname'];
		$lname2=$row2['lname'];
	    $notify="$fname2 $lname2 has posted a new public post";
	    mysql_query("INSERT INTO `notifications`(`sender`, `receiver`, `time`, `seen`, `notification`) VALUES ('$email','$email',CURRENT_TIMESTAMP,'1','$notify')") or die(mysql_error());
   }
   if($privacy==2)
   {
	    $result2=mysql_query("SELECT * from `register` where email='$email'");
		$row2 = mysql_fetch_array( $result2 );
		$fname2=$row2['fname'];
		$lname2=$row2['lname'];
	    $notify="$fname2 $lname2 has posted a new private post";
	    mysql_query("INSERT INTO `notifications`(`sender`, `receiver`, `time`, `seen`, `notification`) VALUES ('$email','$email',CURRENT_TIMESTAMP,'1','$notify')") or die(mysql_error());
   }
   header( "Location: Profile.php" ); die;
     //echo "$name POSTED SUCCESSFULLY "
} 
else
{
  header( "Location: img.php" ); die; 
   }
?>
</body>
</html>