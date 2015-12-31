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
 $malepic = "male.png";
      $femalepic = "female.png";
     session_start();
$email=$_SESSION['email'];
$c = mysql_connect("localhost", "root", ""); 
 if (!$c) {
 die("Database connection failed: " . mysql_error());
 }
 $db_select = mysql_select_db("user",$c);
  if (!$db_select) {
 die("Database failed: " . mysql_error());}
   $result = mysql_query("SELECT * FROM register", $c);
  if (!$result) {
   die("Database query failed: " . mysql_error());
  }
    $res = mysql_query("SELECT * FROM register WHERE email='$email'");
    $row=mysql_fetch_array($res);
     $gender1 = $row['gender'];
     if($gender1=="Male")
   {

      mysql_query("UPDATE `register` SET `profpic`='$malepic' WHERE email='$email' ") or die(mysql_error());
     }
     else{
      mysql_query("UPDATE `register` SET `profpic`='$femalepic' WHERE email='$email'") or die(mysql_error());
     }
   header( "Location: Profile.php" ); die;
 ?>
</body>
</html>