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
session_start();
$id=$_SESSION['id'];
$email=$_SESSION['email']; //sender
$c = mysql_connect("localhost", "root", ""); 
 if (!$c) {
 die("Database connection failed: " . mysql_error());
 }
 $db_select = mysql_select_db("user",$c);
  if (!$db_select) {
 die("Database failed: " . mysql_error());}
  $s=mysql_query("SELECT * FROM search WHERE id='$id'");
$r=mysql_fetch_array($s);
$email1=$r['email']; //receiver
   $result = mysql_query("SELECT * FROM friends", $c);
  if (!$result) {
   die("Database query failed: " . mysql_error());
  }
  $result1=mysql_query("SELECT * from `register` where email='$email1'");
$row1 = mysql_fetch_array( $result1 );
$fname1=$row1['fname'];
$lname1=$row1['lname'];
 $notify="You sent $fname1 $lname1 a friend request";
 $result2=mysql_query("SELECT * from `register` where email='$email'");
$row2 = mysql_fetch_array( $result2 );
$fname2=$row2['fname'];
$lname2=$row2['lname'];
 mysql_query("INSERT INTO `friends`(`sender`, `receiver`) VALUES ('$email','$email1')") or die(mysql_error());
 mysql_query("INSERT INTO `notifications`(`sender`, `receiver`, `time`, `seen`, `notification`) VALUES ('$email','$email1',CURRENT_TIMESTAMP,'1','$notify')") or die(mysql_error()); 
 $notify1="$fname2 $lname2 sent you a friend request";
 mysql_query("INSERT INTO `notifications`(`sender`, `receiver`, `time`, `seen`, `notification`) VALUES ('$email1','$email',CURRENT_TIMESTAMP,'1','$notify1')") or die(mysql_error());
 header( "Location: Profile2.php" ); die;
?>
</body>
</html>