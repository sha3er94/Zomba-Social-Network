 <!DOCTYPE html>
<html>
<head> <title> Search Results </title> 
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
<link rel="stylesheet" type="text/css" href="style.css" media="all" />
<link rel="stylesheet" type="text/css" href="demo.css" media="all" />
</head>
<body>
<?php
session_start();
$id=$_SESSION['ignore'];
echo "$id";
$c = mysql_connect("localhost", "root", ""); 
 if (!$c) {
 die("Database connection failed: " . mysql_error());
 }
 $db_select = mysql_select_db("user",$c);
  if (!$db_select) {
 die("Database failed: " . mysql_error());}
  $email=$_SESSION['email']; //email el fate7 el profile
  $re="SELECT * FROM `search` where id='$id'";
 $flname=mysql_query($re) or die(mysql_error());
 $row=mysql_fetch_array($flname);
 $email1=$row['email']; //email el friend
 mysql_query("DELETE FROM `friends` WHERE `receiver` = '$email' AND `sender` = '$email1'");
 header( "Location: request.php" ); die;

 ?>
 </body>
 </html>