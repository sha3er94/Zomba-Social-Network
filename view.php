<!DOCTYPE html>
<html>
<head> <title> Search Results </title> 
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
<link rel="stylesheet" type="text/css" href="style.css" media="all" />
<link rel="stylesheet" type="text/css" href="demo.css" media="all" />
</head>
<div class="container">
            <div class="back-to-reg">
              <a href="Profile.php" target="_self"><strong>My Profile</strong></a>
                <span class="right">
                    <a href="login.php" target="_self">
                    <strong> Sign out </strong>
                    </a>
                </span> 
                <div class="clr"></div>
            </div>
<body>
<?php
session_start();
$c = mysql_connect("localhost", "root", ""); 
 if (!$c) {
 die("Database connection failed: " . mysql_error());
 }
 $db_select = mysql_select_db("user",$c);
 if (!$db_select) {
 die("Database failed: " . mysql_error());}
 mysql_query("UPDATE `search` SET `email`=NULL,`id`=NULL ");
 $email=$_SESSION['email']; //el email el asly
$fe="SELECT * FROM `relation` where email='$email'";
 $flname=mysql_query($fe) or die(mysql_error());
 //$row=mysql_fetch_array($flname);
// $numrows = mysql_num_rows($flname);
 $items = array();
while ($result=mysql_fetch_array($flname)){
    $items[] = $result['email1'];   
}
  $mayar=1;
$arrlength = count($items);?>
<div class="Tables">
     <table>
     <thead>
   <tr>
     <th><strong>FirstName</strong></th>
     <th><strong>Last Name</strong></th>
     <th><strong>Email</strong></th>
      <th><strong>Phone</strong></th>
      <th><strong>Gender</strong></th>
    <th><strong>Year</strong></th>
     <th><strong>Home Town</strong></th>
      <th><strong>Status</strong></th>
       <th><strong>About me</strong></th>
       <th><strong>Profile Picture</strong> </th>
       <th><strong>View Profile</strong></th>
   </tr>
    </thead>
     <tbody> <?php
for($x = 0; $x < $arrlength; $x++) {
 $email1=$items[$x];
$re="SELECT * FROM `register` where email='$email1'";
$fl=mysql_query($re) or die(mysql_error());
 if(mysql_num_rows($flname)==0){
   echo"\r\nNo Friends Found";
  }
  else{
    ?>
      <form id="search" action="profile1.php" method="POST" >
   <?php
      
        while( $row = mysql_fetch_assoc($fl) ){
          echo "<tr><td>{$row['fname']}</td><td>{$row['lname']}</td><td>{$row['email']}</td><td>{$row['phone']}</td><td>{$row['gender']}</td><td>{$row['birthdate']}</td><td>{$row['hometown']}</td><td>{$row['status']}</td><td>{$row['aboutme']}</td><td><img src={$row["profpic"]} height='100' width='100'></td><td><div class='memoo'><button class='buttom' type='submit'  value='$mayar' name='id'>View Profile</button></div></td></tr>\n";
         mysql_query("INSERT INTO `search`(`email`, `id`) VALUES ('{$row['email']}','$mayar')") or die(mysql_error());
          $mayar=$mayar+1;
        ?> 
  <?php 
  }
        }
    } ?>
    </tbody>
  </table>
  <br/>
 </body>
 </html>