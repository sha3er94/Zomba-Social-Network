<!DOCTYPE html>
<html>
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
<body>
<div class="Table">
<table>
  <thead>
  <th><strong>Notifications</strong></th>
   </thead>
<?php
$c = mysql_connect("localhost", "root", ""); 
 if (!$c) {
 die("Database connection failed: " . mysql_error());
 }
 $db_select = mysql_select_db("user",$c);
  if (!$db_select) {
 die("Database failed: " . mysql_error());
  }
//hena hatba3 el notifications
$email=$_SESSION['email']; //sender
$nots=mysql_query("select * from `notifications` where sender='$email' ORDER BY time DESC") or die(mysql_error());
while( $row = mysql_fetch_assoc($nots) ){
      $notification=$row['notification'];
		  $seen=$row['seen'];
      $t=$row['time'];
		  if($seen == '1'){
			echo "<tr><td>$notification</td></tr>";
			mysql_query("UPDATE `notifications` set `seen`=2 where notification='$notification' AND time='$t'");
		  }
      else
      {
        echo "<tr><td>$notification <div class='see'><strong>SEEN</strong></div></td></tr>";
      }
		}
		
?>

</table>
</div>
 </body>
 </html>