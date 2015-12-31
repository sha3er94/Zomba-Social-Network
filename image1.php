<!DOCTYPE html>
<html>
<title>El 3M'S w nourhan</title>
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" type="text/css" href="style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="demo.css" media="all" />
</head>
<style>
p {text-align: center; font-style: italic; color:#719dab ;margin:0; padding:0; font-size:30px;}
</style>
<body>
<?php
session_start();
$email=$_SESSION['email'];
$c = mysql_connect("localhost", "root", ""); 
 if (!$c) {
 die("Database connection failed: " . mysql_error());
 }
 $db_select = mysql_select_db("user",$c);
  if (!$db_select) {
 die("Database failed: " . mysql_error());}
   $res = mysql_query("SELECT * FROM register where email='$email'", $c);
  if (!$res) {
   die("Database query failed: " . mysql_error());
  }
   $row=mysql_fetch_array($res);
   $fname=$row['fname'];
    $lname=$row['lname'];
    $name= $fname.' '.$lname; 
    $privacy=2;
  $result=$_SESSION['image'];
 // echo'result '.$result;
  mysql_query("update `register` set profpic='$result' where email='$email'");
  //echo"Editing Done !";
  mysql_query("INSERT INTO `post`(`caption`, `email`, `name`, `likes`, `privacy`, `time`, `image`) VALUES ('Has Changed Profile Picture','$email','$name',null,'$privacy',CURRENT_TIMESTAMP,'$result')") or die(mysql_error());
  header( "Location: Profile.php" ); die;
  ?>
 </body>
 </html>