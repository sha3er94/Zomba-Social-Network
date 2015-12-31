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
              <a href="home.php" target="_self"><strong> Home </strong></a>
              <a href="profile.php" target="_self"><strong>My Profile</strong></a>
                <span class="right">
               
                </span> 
                <div class="clr"></div>
            </div>
 <div class = "nourhan">
<form id="contactform" action="search.php" method="POST" > 
  <p>Search Here</p> 
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
session_start();

$email=$_SESSION['email'];
$page=$_SESSION['page'];
$c = mysql_connect("localhost", "root", ""); 
 if (!$c) {
 die("Database connection failed: " . mysql_error());
 }
 $db_select = mysql_select_db("user",$c);
  if (!$db_select) {
 die("Database failed: " . mysql_error());}

 if ($_POST['like'])
{
  $id=$_POST['like'];
  $re="SELECT * FROM `likeid` where id='$id'";
  $result2=mysql_query("SELECT * from `register` where email='$email'");
  $row2 = mysql_fetch_array( $result2 );
  $fname2=$row2['fname'];
  $lname2=$row2['lname'];
     $notify="$fname2 $lname2 has liked a post";
     mysql_query("INSERT INTO `notifications`(`sender`, `receiver`, `time`, `seen`, `notification`) VALUES ('$email','$email',CURRENT_TIMESTAMP,'1','$notify')") or die(mysql_error());
 $flname=mysql_query($re) or die(mysql_error());

 $row=mysql_fetch_array($flname);
 $postid=$row['idp'];
 $se="SELECT * FROM `likes` where id='$postid' AND email='$email'";
 $i=mysql_query($se) or die(mysql_error());
 if (mysql_num_rows($i) ==0)
 {
 	$p="INSERT INTO `likes`(`id`,`email`) VALUES ('$postid','$email')";
    $fr=mysql_query($p) or die(mysql_error());
    if ($page=="home")
   { header( "Location: home.php" ); die;}
  else if ($page=="profile")
    {header( "Location: profile.php" ); die;}
  else if ($page=="profile4")
    {header( "Location: profile4.php" ); die;}
}
 else  
 {   if ($page=="home")
    {header( "Location: home.php" ); die;}
   else if ($page=="profile")
   { header( "Location: profile.php" ); die; }
 else if ($page=="profile4")
    {header( "Location: profile4.php" ); die;}
}
}
else if ($_POST['unlike'])
{
  $id=$_POST['unlike'];
  $re="SELECT * FROM `likeid` where id='$id'";
 $flname=mysql_query($re) or die(mysql_error());
 $row=mysql_fetch_array($flname);
 $postid=$row['idp'];
 $se="SELECT * FROM `likes` where id='$postid' AND email='$email'";
 $i=mysql_query($se) or die(mysql_error());
 if (mysql_num_rows($i) !=0)
 {
  $p="DELETE from `likes` WHERE `id`='$postid' AND `email`='$email'";
    $fr=mysql_query($p) or die(mysql_error());
    if ($page=="home")
   { header( "Location: home.php" ); die;}
  else if ($page=="profile")
    {header( "Location: profile.php" ); die;}
  else if ($page=="profile4")
    {header( "Location: profile4.php" ); die;}
}
 else  
 {   if ($page=="home")
    {header( "Location: home.php" ); die;}
   else if ($page=="profile")
   { header( "Location: profile.php" ); die; }
 else if ($page=="profile4")
    {header( "Location: profile4.php" ); die;}
}
}
else if ($_POST['view'])
{  
     $id=$_POST['view'];
    $_SESSION['view']=$id;
	header( "Location: viewlikes.php" ); die; 
}
?>
</body>
</html>