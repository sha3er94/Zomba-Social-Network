<!DOCTYPE html>
<html>
<head> <title> Search Results </title> 
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
              <a href="home.php" target="_self"><strong>Home</strong></a>
              <a href="Profile.php" target="_self"><strong>My Profile</strong></a>
                <span class="right">
                   <a href="request.php" target="_self">
                 <strong> View Friend Requests <?= $count ?> </strong>  
                 </a>
                    <a href="login.php" target="_self">
                    <strong> Sign out </strong>
                    </a>
                </span> 
                <div class="clr"></div>
            </div>
<body>
<?php
$c = mysql_connect("localhost", "root", ""); 
 if (!$c) {
 die("Database connection failed: " . mysql_error());
 }
 $db_select = mysql_select_db("user",$c);
  if (!$db_select) {
 die("Database failed: " . mysql_error());}
mysql_query("UPDATE `search` SET `email`=NULL,`id`=NULL ");
$email=$_SESSION['email'];
$re="SELECT * FROM `friends` where receiver='$email'";
 $flname=mysql_query($re) or die(mysql_error());
  if(mysql_num_rows($flname)==0){
   echo"<div class='galb'>No Friend Requests Found</div>";
  }
  else{

    ?>
    <div class="Tables">
     <table>
     <thead>
   <tr>
     <th>Email</th>
     <th>View</th>
     <th>Accept</th>
     <th>Ignore</th>
   </tr>
    </thead>
     <tbody>
      <form id="search" action="add.php" method="POST" >
   <?php
     $mayar=1;
        while( $row = mysql_fetch_assoc($flname) ){
          echo "<tr><td>{$row['sender']}</td><td><div class='memoo'><button class='buttom' type='submit'  value='$mayar' name='view'>View Profile</button></div></td><td><div class='memoo'><button class='buttom' type='submit' value='$mayar' name='accept'>Accept</button></div></td><td><div class='memoo'><button class='buttom' type='submit' value='$mayar' name='ignore'>Ignore</button></div></td></tr>\n";
           mysql_query("INSERT INTO `search`(`email`, `id`) VALUES ('{$row['sender']}','$mayar')") or die(mysql_error());
          $mayar=$mayar+1;
        }
        $count=$mayar;
    $_SESSION['count']=$count;
   ?>
   <form>
    </tbody>
  </table>
  <br/>
  <?php
    
 } ?>
 </body>
 </html>