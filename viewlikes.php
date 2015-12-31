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
  <p style="margin-left:50px;"><strong>Search Here</strong></p> 
  <input id="search" name="search" placeholder="Search Here" type="text" required> 
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
  $c = mysql_connect("localhost", "root", ""); 
 if (!$c) {
 die("Database connection failed: " . mysql_error());
 }
 $db_select = mysql_select_db("user",$c);
  if (!$db_select) {
 die("Database failed: " . mysql_error());}
   $postid=$_SESSION['view'];
   $po="SELECT * FROM `likeid` where id='$postid'";
 $fl=mysql_query($po) or die(mysql_error());
 $el=mysql_fetch_assoc($fl);
 $idpost=$el['idp'];
 $se="SELECT * FROM `likes` where id='$idpost'";
 $flname=mysql_query($se) or die(mysql_error());
     ?>
     <div class="Table">
     <table >
     <thead>
   <tr>
    <th><strong>Profile Picture</strong></th>
     <th><strong>Name</strong></th>
   </tr>
    </thead>
     <tbody>
   <?php
        while( $r = mysql_fetch_assoc($flname) ){
          $email=$r['email'];
          $o="SELECT * FROM `register` where email='$email'";
          $x=mysql_query($o) or die(mysql_error());
          $row = mysql_fetch_assoc($x);
          $fname=$row['fname'];
          $lname=$row['lname'];
          $name= $fname.' '.$lname;
           echo "<tr><td><img src={$row["profpic"]} height='100' width='100'></td><td>{$name}</td></tr>\n";
        }
   ?>
    </tbody>
  </table>
  </div>
</body>
</html>