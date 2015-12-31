<!DOCTYPE html>
<html>
<head> <title> Profile </title> 
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
<link rel="stylesheet" type="text/css" href="style.css" media="all" />
<link rel="stylesheet" type="text/css" href="demo.css" media="all" />
</head>
<?php 
session_start();
 $email5=$_SESSION['email'];
$_SESSION['page']="profile4";
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
               <a href="view.php" target="_self"><strong> View Friends </strong></a>
                <span class="right">

                 <a href="delete.php" target="_self">
                 <strong>Remove</strong>  
                 </a>
                   <a href="request.php" target="_self">
                 <strong> View Friend Requests <?= $count ?> </strong>  
                 </a>

                 
                        <strong>Friends</strong> 
                </span> 
                <div class="clr"></div>
            </div>
 <div class = "blue">
<form id="contactform" action="search.php" method="POST" > 
  <p style="margin-left:50px;"><strong>Search Here</strong></p>
  <input id="search" name="search" placeholder="Search Here" type="text" required> 
  <input class="buttom" name="submit" id="submit" tabindex="12" value="Search!" type="submit">  
</form>
</div>
<body>
<?php
$id=$_SESSION['id'];
$email=$_SESSION['email'];
//echo "<p><strong> Welcome $fname </strong></p> ";
$c = mysql_connect("localhost", "root", ""); 
 if (!$c) {
 die("Database connection failed: " . mysql_error());
 }
 $db_select = mysql_select_db("user",$c);
  if (!$db_select) {
 die("Database failed: " . mysql_error());}
   $result = mysql_query("SELECT * FROM search", $c);
  if (!$result) {
   die("Database query failed: " . mysql_error());
  }
  $result= mysql_query("DELETE FROM  likeid");
 if (!$result) {
   die("Database query failed: " . mysql_error());
  }
 $s=mysql_query("SELECT * FROM search WHERE id='$id'");
$r=mysql_fetch_array($s);
$email=$r['email'];
 $result = mysql_query("SELECT * FROM register", $c);
  if (!$result) {
   die("Database query failed: " . mysql_error());
  }
    $res = mysql_query("SELECT * FROM register WHERE email='$email'");
  $row=mysql_fetch_array($res);
  $_SESSION['emailp4']=$email;
    $fname=$row['fname'];
    $lname=$row['lname'];
     $email=$row['email'];
     $phone = $row['phone'];
     $gender = $row['gender'];
     $year = $row['birthdate'];
     $town = $row['hometown'];
     $status = $row['status'];
     $about = $row['aboutme'];
     $u=1;
 echo"<tr>";
 echo"<td>"; ?>
 <div class = "sa7" >
 <img src="<?php echo $row["profpic"];?>" height="250" width="250">
 </div>
 <?php  
  echo"</td>";
  echo"</tr>";
  ?>
  <div class="container">
  <header>
   <h3 style ="font-style: italic; color:#719dab ;margin-top: 210px ; padding:0; font-size:35px; margin-left :20px;">
  <?php
       echo "$fname $lname";
  ?>
 </h3>
  </header>

<div class="mayar">
  <header>
       <?php
       echo "Email: $email"; ?>
       </br>
       <?php echo "Phone Number: $phone "; ?>
       </br>
       <?php
       echo "Gender: $gender"; ?>
       </br>
       <?php
       echo "Birthday: $year"; ?>
       </br>
       <?php
       echo "Hometown: $town"; ?>
       </br>
       <?php
       echo "Marital Status: $status"; ?>
       </br>
       <?php
       echo "About me: $about"; ?>
  </header>
</div>
<div class="me">
<?php
$res = mysql_query("SELECT * FROM post WHERE email='$email'");
while($r=mysql_fetch_array($res)){;
 ?> <!<div style="border-style:double; width:700px;"> 
 <form id="contactform" action="like.php" method="POST" >  <?php
    $caption=$r['caption'];
    $user=$r['name'];
    $time=$r['time'];
       //echo "Email: $email";
    ?>
    <div class="T">
    <?php
    echo "<div class='nameee'><strong>$user</strong> $time</div>";
    ?>
    </br>
  </br>
    <?php       
       echo "<div class='sooo'><strong>$caption</strong></div>";
       ?>
    </br>
  </br>
    <?php 
    if(strpos($r['image'],'.') !== false)
      { echo "<div class='marmero'><img src={$r['image']} height='500' width='500'></div>"; }
 $rt="SELECT * FROM `Likes` where id='{$r['id']}' AND email='$email5'";   
  $fe=mysql_query($rt) or die(mysql_error());   
 if (mysql_num_rows($fe)==0)
        {
          echo " <div class='nono' ><button class='buttom' name='like' id='like' value='$u' type='submit'> LIKE </button></div>";}
      else
        {echo " <div class='nono' ><button class='buttom' name='unlike' id='unlike' value='$u' type='submit'> Unlike </button></div>";}
      $rt="SELECT * FROM `Likes` where id='{$r['id']}'";   
  $fe=mysql_query($rt) or die(mysql_error()); 
      $co=0;
 while( $row = mysql_fetch_assoc($fe) )
 {
  $co=$co+1;
 }
        echo "<div class='maaay'><button class='buttom' name='view' id='view' value='$u' type='submit'> View Likes! $co </button></div>";

    ?>
  </form>
      </div>
    <?php
    mysql_query("INSERT INTO `likeid`(`idp`, `id`) VALUES ('{$r['id']}','$u')") or die(mysql_error());
    $u=$u+1;
  }

    ?> 
</div>
</body>
</html>