<!DOCTYPE html>
<html>
<head> <title> Search Results </title> 
<script src="socket.io.min.js"></script>
<script>
var socket = io.connect('http://localhost:8080');
socket.on('notification', function (data) {
    console.log(data.message);
});
</script>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
<link rel="stylesheet" type="text/css" href="style.css" media="all" />
<link rel="stylesheet" type="text/css" href="demo.css" media="all" />
</head>
<body>
<?php
session_start();
//  $_SESSION['id']=$id;
if ($_POST['view'])
{  
      $id=$_POST['view'];
    $_SESSION['view']=$id;
	header( "Location: profile3.php" ); die; 
} 
else if ($_POST['ignore']) {
	 $id=$_POST['ignore'];
	 $_SESSION['ignore']=$id;
    header( "Location: ignore.php" ); die; }
else {
	  $id=$_POST['accept'];
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
 $result1=mysql_query("SELECT * from `register` where email='$email'");
$row1 = mysql_fetch_array( $result1 );
$fname1=$row1['fname'];
$lname1=$row1['lname'];
$result2=mysql_query("SELECT * from `register` where email='$email1'");
$row2 = mysql_fetch_array( $result2 );
$fname2=$row2['fname'];
$lname2=$row2['lname'];
 $notify="$fname1 $lname1 has accepted your friend request";
 mysql_query("INSERT INTO `notifications`(`sender`, `receiver`, `time`,`seen`,`notification`) VALUES ('$email1','$email',CURRENT_TIMESTAMP,'1','$notify')");
 $notify1="You accepted the friend request from $fname2 $lname2";
 mysql_query("INSERT INTO `notifications`(`sender`, `receiver`, `time`,`seen`, `notification`) VALUES ('$email','$email1',CURRENT_TIMESTAMP,'1','$notify1')");
 mysql_query("INSERT INTO `relation`(`email`, `email1`) VALUES ('$email','$email1')");
 mysql_query("INSERT INTO `relation`(`email`, `email1`) VALUES ('$email1','$email')");
 mysql_query("DELETE FROM `friends` WHERE `receiver` = '$email' AND `sender` = '$email1'");
 header( "Location: request.php" ); die;
 }?>
 </body>
 </html>