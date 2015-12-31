<!DOCTYPE html>
<html>
<head> <title> Profile </title> 
<script src="jquery-1.11.3.min.js"></script>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
<link rel="stylesheet" type="text/css" href="style.css" media="all" />
<link rel="stylesheet" type="text/css" href="demo.css" media="all" />
<script>
function showResult(value) {
$.post("livesearch.php",{res:value},function(data)
$("#results").html(data)
);
}
</script>
</head>
   <script type="text/javascript">

function validate()
{

var caption= document.getElementById("caption").value;
var letters = /^[A-Za-z]+$/;
if(!caption.match(letters))  
     {  
     alert("you Forgot to write a caption");  
     return false;  
     }  
  return true;

}
function validatee() 
{
  var search= document.getElementById("search").value;
var letters = /^[A-Za-z]+$/;
  if(!search.match(letters))  
     {  
     alert("you Forgot to write what you want to look for");  
     return false;  
     }   
  return true;

} 
</script>   
<?php 
session_start();
 $email=$_SESSION['email'];
 //$count=$_SESSION['count'];
$c = mysql_connect("localhost", "root", ""); 
 if (!$c) {
 die("Database connection failed: " . mysql_error());
 }
 $db_select = mysql_select_db("user",$c);
  if (!$db_select) {
 die("Database failed: " . mysql_error());}
 $re="SELECT * FROM `friends` where receiver='$email'";
 $flname=mysql_query($re) or die(mysql_error());
$count=0;
 while( $row = mysql_fetch_assoc($flname) )
 {
  $count=$count+1;
 }
 $c=0;
$nots=mysql_query("select * from `notifications` where sender='$email' AND seen='1' ORDER BY time DESC") or die(mysql_error());
while( $row = mysql_fetch_assoc($nots))
{
  $c=$c+1;
}
 ?>
<div class="container">
            <div class="back-to-reg">
              <a href="home.php" target="_self"><strong>Home</strong></a>
               <a href="view.php" target="_self"><strong>View Friends</strong></a>
               <a href="request.php" target="_self">
                 <strong> View Friend Requests <?= $count ?> </strong>  
                 </a>
                <a href="notifications.php" target="_self">
                    <strong> NOTIFICATIONS <?= $c ?> </strong>
                    </a>
                <span class="right">
                    <a href="login.php" target="_self">
                    <strong> Sign out </strong>
                    </a>
                </span> 
                <div class="clr">

                </div>
            </div>
 <div class = "nourhan">
<form id="contactform" action="search.php" method="POST"> 
  <p style ="margin-left:50px;" ><strong>Search Here</strong></p> 
  <input id="search" name="search" placeholder="Search Here" type="text" onkeyup="showResult(this.value)" required>
  <br>
  <div id="results"></div>  
  <input class="buttom" name="submit" id="submit" tabindex="12" value="Search!" type="submit" >
</form>
  </div>
<div class="batee5">
  <form id="contactform" action="post.php" method="POST">
    <p style ="margin-left:250px;" ><strong>Post In Here</strong></p> 
  <input id="caption" name="caption" placeholder="Post Here" type="text" required>
</br>
</br>
  <input class="buttom" name="post" id="post" value="Post" type="submit">
   <!<fieldset>
                  <label class="Privacy"> 
                  <select class="select-style" name="Privacy" required >
                  <option value="1">Public</option>
                  <option value="2">Private</option>
                  </label>
   </select>   
   </br>
</form>
 <form id="contactform" action="post.php" method="POST">
   </br>
  <input class="buttom" name="upload" id="upload" value="upload" type="submit"> 
  </form>
</div>
<body>
<?php
$_SESSION['page']="profile";
 $uploaded=$_SESSION['img'];
 $_SESSION['im']=$uploaded;
$c = mysql_connect("localhost", "root", ""); 
 if (!$c) {
 die("Database connection failed: " . mysql_error());
 }
 $db_select = mysql_select_db("user",$c);
  if (!$db_select) {
 die("Database failed: " . mysql_error());}
 $result= mysql_query("DELETE FROM  likeid");
 if (!$result) {
   die("Database query failed: " . mysql_error());
  }
   $result = mysql_query("SELECT * FROM register", $c);
  if (!$result) {
   die("Database query failed: " . mysql_error());
  }
    $res = mysql_query("SELECT * FROM register WHERE email='$email'");
  $row=mysql_fetch_array($res);
    $fname=$row['fname'];
    $lname=$row['lname'];
    $name= $fname.' '.$lname; 
    $_SESSION['name']=$name;
   $email=$row['email'];
   $phone = $row['phone'];
     $gender = $row['gender'];
     $year = $row['birthdate'];
     $town = $row['hometown'];
     $status = $row['status'];
     $about = $row['aboutme'];
 echo"<tr>";
 echo"<td>"; ?>
 <div class = "mai" >
 <img src="<?php echo $row["profpic"];?>" height="300" width="300">
 </div>
 <?php  
  echo"</td>";
  echo"</tr>";
  ?>
  <div class="container">
  <header>
   <h3 style ="font-style: italic; color:#719dab ;margin-top: 100px ; padding:0; font-size:35px; margin-left :10px;">
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
<div class="sha3er">
<a href= "edit.php" >
<input class="buttom" name="submit" id="submit" tabindex="12" value="Edit Info" type="submit">
</a>
<a href = "image.php">
<input class="buttom" name="submit" id="submit" tabindex="12" value="Edit Picture" type="submit">
</a>
<a href = "remove.php">
<input class="buttom" name="submit" id="submit" tabindex="12" value="Remove Picture" type="submit">
</a>
</div>
<div class="merrr">

<?php

   $res = mysql_query("SELECT * FROM post WHERE email='$email' ORDER BY time DESC");
   $u=1;
  while($r=mysql_fetch_array($res)){
 ?> <!<div style="border-style:double; width:700px;" > 
 <form id="contactform" action="like.php" method="POST" > 
 
 <?php
    $caption=$r['caption'];
    $user=$r['name'];
    $time=$r['time'];
    ?>
    <div class="T">
    <?php
       //echo "Email: $email";
    echo "<div class='nam'><strong>$user</strong></div> <div class='no'>$time</div>";
    ?>
    </br>
  </br>
    <?php       
       echo "<div class='so'><strong>$caption</strong></div>";
       ?>
    </br>
  </br>
    <?php 
    if(strpos($r['image'],'.') !== false)
       echo "<div class='marmero'><img src={$r['image']} height='500' width='500'></div>"; 
        $_SESSION['img']=null;
       $rt="SELECT * FROM `Likes` where id='{$r['id']}' AND email='$email'";   
  $fe=mysql_query($rt) or die(mysql_error());   
 if (mysql_fetch_array($fe)==0)

        {echo " <div class='nono' ><button class='buttom' name='like' id='like' value='$u' type='submit'> LIKE </button></div>";}
      else
        {echo " <div class='nono' ><button class='buttom' name='unlike' id='unlike' value='$u' type='submit'> Unlike </button></div>";}
      $rt="SELECT * FROM `Likes` where id='{$r['id']}'";   
  $fe=mysql_query($rt) or die(mysql_error()); 
      $co=0;
 while( $row = mysql_fetch_assoc($fe) )
 {
  $co=$co+1;
 }

        echo "<div class='maaay'><button class='buttom' name='view' id='view' value='$u' type='submit'> View Likes $co </button></div>";


    ?>
  </form>
      </div>
    <?php
    mysql_query("INSERT INTO `likeid`(`idp`, `id`) VALUES ('{$r['id']}','$u')") or die(mysql_error());
    $u=$u+1;
  }

    ?> 
</table>
</div>
</div>
</body>
</html>