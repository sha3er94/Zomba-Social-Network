<HTML>
<head> <title> Notifications </title> 
<meta http-equiv="refresh" content="10; URL=notifications.php">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
<link rel="stylesheet" type="text/css" href="style.css" media="all" />
<link rel="stylesheet" type="text/css" href="demo.css" media="all" />
</head>
<?php 
session_start();
 $email5=$_SESSION['email'];
$c = mysql_connect("localhost", "root", ""); 
 if (!$c) {
 die("Database connection failed: " . mysql_error());
 }
 $db_select = mysql_select_db("user",$c);
  if (!$db_select) {
 die("Database failed: " . mysql_error());}
 $re="SELECT * FROM `friends` where receiver='$email5'";
 $flname=mysql_query($re) or die(mysql_error());
$count=0;
 while( $row = mysql_fetch_assoc($flname) )
 {
  $count=$count+1;
 }
 ?>
<div class="container">
            <div class="back-to-reg">
              <a href="home.php" target="_self"><strong> Home </strong></a>
              <a href="profile.php" target="_self"><strong>My Profile</strong></a>
                <span class="right">
                   <a href="request.php" target="_self">
                 <strong> View Friend Requests <?= $count ?> </strong>  
                 </a>
               
                </span> 
                <div class="clr"></div>
            </div>
 <div class = "nourhan">
<form id="contactform" action="search.php" method="POST" > 
   <p style="margin-left:50px;"><strong>Search Here</strong></p>
  <input id="search" name="search" placeholder="Search Here" type="text" > 
  <input class="buttom" name="submit" id="submit" tabindex="12" value="Search!" type="submit"> 
  </br> 
</form>
</div>
 </br> 
  </br> 
   </br> 
<Body>
<div class="gal">
<p>Are You Sure You Want To Remove This Friend</p>
</div>

<form id="contactform" method="POST">
<div class="memmm">
<input class="buttom" name="Yes" id="Yes" value="Yes" type="submit">
</div>
<div class="memm">
<input class="buttom" name="No" id="No" value="No" type="submit">
</form>
</div>
<?php
$c = mysql_connect("localhost", "root", ""); 
 if (!$c) {
 die("Database connection failed: " . mysql_error());
 }
 $db_select = mysql_select_db("user",$c);
  if (!$db_select) {
 die("Database failed: " . mysql_error());}
$email5=$_SESSION['email'];
$email=$_SESSION['emailp4'];
 $res = mysql_query("SELECT * FROM register WHERE email='$email'");
	$row=mysql_fetch_array($res);
    $fname=$row['fname'];
    $lname=$row['lname'];
     $email=$row['email'];
     $phone = $row['phone'];
     $gender = $row['gender'];
     $year = $row['birthdate'];
     $town = $row['hometown'];
     $status = $row['status'];
     $about = $row['aboutme'];
	if (isset($_POST['Yes']))
	{
	if ($_POST['Yes'] == 'Yes'){
	mysql_query("DELETE FROM `relation` where email='$email' AND email1='$email5'");
	mysql_query("DELETE FROM `relation` where email='$email5' AND email1='$email'");
	echo"deleted successfully";
	$result2=mysql_query("SELECT * from `register` where email='$email5'");
		$row2 = mysql_fetch_array( $result2 );
		$fname2=$row2['fname'];
		$lname2=$row2['lname'];
	    $notify="$fname2 $lname2 has removed you from their friends";
	    mysql_query("INSERT INTO `notifications`(`sender`, `receiver`, `time`,`seen`, `notification`) VALUES ('$email','$email5',CURRENT_TIMESTAMP,'1','$notify')") or die(mysql_error());
	header( "Location: view.php" ); die;
	}
	}
	if (isset($_POST['No']))
	{
	if ($_POST['No'] == 'No'){
	echo"Get Back";
	header( "Location: profile4.php" ); die;
	}
	}
?>
</Body>
</HTML>