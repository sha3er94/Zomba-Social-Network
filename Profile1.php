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
 //$count=$_SESSION['count'];
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
              <a href="profile.php" target="_self"><strong>My Profile!</strong></a>
              <a href="view.php" target="_self"><strong>View Friends</strong></a>
               <a href="request.php" target="_self"> <strong> View Friend Requests <?= $count ?> </strong>  </a>
                <span class="right">
                    <a href="fr.php" target="_self"> <strong>Send Friend Request</strong> </a>
                </span> 
                <div class="clr"></div>
            </div>
 <div class = "nou">
<form id="contactform" action="search.php" method="POST" > 
  <p style="margin-left:50px;"><strong>Search Here</strong></p>
  <input id="search" name="search" placeholder="Search Here" type="text" required > 
  <input class="buttom" name="submit" id="submit" tabindex="12" value="Search!" type="submit">  
</form>
</div>
<body>
<?php
//$email7=$_SESSION['email']; //el email beta3y
$id=$_POST['id'];
$_SESSION['id']=$id;
//echo "<p><strong> Welcome $fname </strong></p> ";
$c = mysql_connect("localhost", "root", ""); 
 if (!$c) {
 die("Database connection failed: " . mysql_error());
 }
 $db_select = mysql_select_db("user",$c);
  if (!$db_select) {
 die("Database failed: " . mysql_error());}
  //  $result = mysql_query("SELECT * FROM search", $c);
  // if (!$result) {
  //  die("Database query failed: " . mysql_error());
  // }
 $s=mysql_query("SELECT * FROM search WHERE id='$id'");
$r=mysql_fetch_array($s);
$email=$r['email']; //email el profile
if ($email==$email5)
{
  echo "awl case";
  header( "Location: Profile.php" ); die;
} 
 $sh="SELECT * FROM relation WHERE (email='$email5' AND email1='$email')"; 
 $ph=mysql_query($sh) or die(mysql_error());
 if(mysql_num_rows($ph) !=0){
  echo "awl case";
  $_SESSION['id']=$id;
  header( "Location: Profile4.php" ); die;
  }
  $resl = mysql_query("SELECT * FROM friends WHERE (sender='$email' and receiver='$email5')");
    if (mysql_num_rows($resl) != 0)
    {
      $_SESSION['id']=$id;
      echo "tany case";
      header( "Location: profile3.php" ); die;
    }
  $s="SELECT * FROM friends WHERE (sender='$email5' AND receiver='$email')";
  $p=mysql_query($s) or die(mysql_error());
if(mysql_num_rows($p) !=0){
  echo "talet case";
  $_SESSION['id']=$id;
 header( "Location: Profile2.php" ); die;
}

 $result = mysql_query("SELECT * FROM register", $c);
  if (!$result) {
   die("Database query failed: " . mysql_error());
  }
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

 echo"<tr>";
 echo"<td>"; ?>
 <div class = "m" >
 <img src="<?php echo $row["profpic"];?>" height="250" width="250">
 </div>
 <?php  
  echo"</td>";
  echo"</tr>";
  ?>
  <div class="container">
  <header>
   <h3 style ="font-style: italic; color:#719dab ;margin-top: 220px ; padding:0; font-size:35px; margin-left :15px;">
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
       echo "Hometown: $town"; ?>
       </br>
       <?php
       echo "Marital Status: $status"; ?>
       </br>
  </header>
</div>
<div class="me">

<?php
   $privacy=1;
   $res = mysql_query("SELECT * FROM post WHERE email='$email' AND privacy='$privacy'");
  while($r=mysql_fetch_array($res)){;
 ?> <!<div style="border-style:double; width:700px;"> <?php
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
       echo "<div class='marmero'><img src={$r['image']} height='500' width='500'></div>"; 
    ?>
    </br>
      </div>
    <?php 
  }
    ?>
     
</table>
</div>
</body>
</html>