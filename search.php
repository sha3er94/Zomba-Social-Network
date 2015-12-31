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
  <?php
$c = mysql_connect("localhost", "root", ""); 
 if (!$c) {
 die("Database connection failed: " . mysql_error());
 }
 $db_select = mysql_select_db("user",$c);
  if (!$db_select) {
 die("Database failed: " . mysql_error());}
mysql_query("UPDATE `search` SET `email`=NULL,`id`=NULL ");
$search=$_POST['search'];
if (strpos($search, ' ') > 0) {
$full1=explode(' ', $search);
 $first=$full1[0];
 $last=ltrim($search, $first);
 $string = str_replace(' ', '', $last);
 $re="SELECT * FROM `register` where fname='$first' and lname='$string'";
$flname=mysql_query($re) or die(mysql_error());
 $k="SELECT * FROM `post` WHERE caption LIKE '%$search%' AND (email='$email5' OR privacy=1) ";
  $fl=mysql_query($k) or die(mysql_error());
  if((mysql_num_rows($flname)==0) AND (mysql_num_rows($fl)==0))
  {
    echo "<div class='galb'>No Entries Found</div>";
  }
  else
  { 
     ?>
     <div class="Tabl">
     <table>
     <thead>
   <tr>
    <th><strong>Profile Picture</strong></th>
     <th><strong>Name</strong></th>
      <th><strong>Gender</strong></th>
       <th><strong>View Profile</strong> </th>
   </tr>
    </thead>
     <tbody>
      <form id="search" action="profile1.php" method="POST" >
   <?php
     $mayar=1;
        while( $r = mysql_fetch_assoc($flname) ){
          $fname=$r['fname'];
          $lname=$r['lname'];
          $name= $fname.' '.$lname;
           echo "<tr><td><img src={$r["profpic"]} height='100' width='100'></td><td>{$name}</td><td>{$r['gender']}</td></td><td><div class='memoo'><button class='buttom' type='submit'  value='$mayar' name='id'>View Profile</button></div></td></tr>\n";
           mysql_query("INSERT INTO `search`(`email`, `id`) VALUES ('{$r['email']}','$mayar')") or die(mysql_error());
          $mayar=$mayar+1;
        }
   ?>
   <form>
    </tbody>
  </table>
  </div>
  <br/>
  <div class="Tab">
     <table>
     <thead>
   <tr>
    <th><strong>Posted</strong></th>

      <th><strong>Caption</strong></th>
     <th><strong>Image</strong></th>
   </tr>
    </thead>
     <tbody>
       <?php
      while( $row = mysql_fetch_assoc($fl) ) {
       if(strpos($row['image'],'.') !== false){
    echo "<tr><td>{$row['name']}</td><td>{$row['caption']}</td><td><img src={$row["image"]} height='200' width='200'></td></tr>\n";
     }  
     else
     {
      echo "<tr><td>{$row['name']}</td><td>{$row['caption']}</td><td>'No Image In This Post'</td></tr>\n";
     }   
}
      ?>
   <form>
    </tbody>
  </table>
  </div>
  <br/>
<?php
  }
}
else
{
$re="SELECT * FROM `register` where email='$search' or fname='$search' or lname='$search' or hometown='$search' or phone='$search'";
$k="SELECT * FROM `post` WHERE caption LIKE '%$search%' AND (email='$email5' OR privacy=1) ";
  $fl=mysql_query($k) or die(mysql_error());
 $res=mysql_query($re) or die(mysql_error());
 $num_rows = mysql_num_rows($res);
 if(mysql_num_rows($res)==0 AND mysql_num_rows($fl)==0)
 {
  echo "<div class='galb'>No results found</div>";
 }
  else 
 {?>
<div class="Tabl">
   <table>
   <thead>
    <tr>

   <th><strong>Profile Picture</strong></th> 
      <th><strong>Name</strong></th>
       <th><strong>Gender</strong></th>
           <th><strong>View Profile</strong></th>
    </tr>
  </thead>
   <tbody>
    <form id="search" action="profile1.php" method="POST" >
    <?php
        $mayar=1;
        while( $row = mysql_fetch_assoc($res) ){
          $fname=$row['fname'];
          $lname=$row['lname'];
          $name= $fname.' '.$lname;
           echo "<tr><td><img src={$row["profpic"]} height='100' width='100'></td><td>{$name}</td><td>{$row['gender']}</td><td><div class='memoo'><button class='buttom' type='submit'  value='$mayar' name='id'>View Profile</button></div></td></tr>\n";
            mysql_query("INSERT INTO `search`(`email`, `id`) VALUES ('{$row['email']}','$mayar')") or die(mysql_error());
          $mayar=$mayar+1;
        }
    ?>
    <form>
  </tbody>
</table>
</div>
<br/>
    <div class="Tab">
     <table>
     <thead>
   <tr>
    <th><strong>Posted</strong></th>
      <th><strong>Caption</strong></th>
     <th><strong>Image</strong></th>
   </tr>
    </thead>
     <tbody>
       <?php
      while( $row = mysql_fetch_assoc($fl) ) {
       if(strpos($row['image'],'.') !== false){
    echo "<tr><td>{$row['name']}</td><td>{$row['caption']}</td><td><img src={$row["image"]} height='200' width='200'></td></tr>\n";
     }  
     else
     {
      echo "<tr><td>{$row['name']}</td><td>{$row['caption']}</td><td>'No Image In This Post'</td></tr>\n";
     }   
}
      ?>
   <form>
    </tbody>
  </table>
  <br/>
<?php
 } }
?>
</body>
</html>