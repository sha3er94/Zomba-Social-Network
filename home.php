<!DOCTYPE html>
<html>
<head> <title> Home</title> 
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
  $c=0;
$nots=mysql_query("select * from `notifications` where sender='$email5' AND seen='1' ORDER BY time DESC") or die(mysql_error());
while( $row = mysql_fetch_assoc($nots))
{
  $c=$c+1;
}
 ?>
<div class="container">
            <div class="back-to-reg">
              <a href="profile.php" target="_self"><strong>My Profile</strong></a>
               <a href="view.php" target="_self"><strong>View Friends</strong></a>
               <a href="notifications.php" target="_self">
                    <strong> NOTIFICATIONS <?= $c ?> </strong>
                    </a>
               <a href="request.php" target="_self">
                 <strong> View Friend Requests <?= $count ?> </strong>  
                 </a>
                <span class="right">
                    <a href="login.php" target="_self">
                    <strong> Sign out </strong>
                    </a>
                </span> 
                <div class="clr">

                </div>
            </div>
 <div class = "orange">
<form id="contactform" action="search.php" method="POST" > 
  <p style ="margin-left:50px;" ><strong>Search Here</strong></p> 
  <input id="search" name="search" placeholder="Search Here" type="text" onkeyup="showResult(this.value)" required>
  <br>
  <div id="results"></div> 
  <input class="buttom" name="submit" id="submit" tabindex="12" value="Search!" type="submit">
</form>
  </div>

<body>
<?php
 $email=$_SESSION['email'];
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
    $_SESSION['page']="home";
 echo"<tr>";
 echo"<td>"; ?>
 <div class = "red" >
 <img src="<?php echo $row["profpic"];?>" height="150" width="150s">
 </div>
 <?php  
  echo"</td>";
  echo"</tr>";
  ?>
  <div class="container">
  <header>
   <h3 style ="font-style: italic; color:#719dab ;margin-top: 50px ; padding:0; font-size:15px; margin-left :-15px;">
  <?php
       echo "<div class='lolo'>$name</div>";
  ?>
 </h3>
  </header>
<div class="purple">
<?php
$u=1;
$res1 = mysql_query("SELECT * FROM `relation` where email='$email'") or die(mysql_error());
    $items = array();
    while ($result1=mysql_fetch_array($res1)){
    $items[] = $result1['email1'];   
}
$arrlength = count($items);
for($x=0;$x<$arrlength;$x++)
{
  $email1=$items[$x];
    $re="SELECT * FROM `post` where ((email='$email1') AND privacy=2) ORDER BY time DESC ";
$fl=mysql_query($re) or die(mysql_error());
 if(mysql_num_rows($res1)==0){
   echo"<div class='galb'>You have no friends yet to show their posts</div> ";
  }
  else{
  while ($r1=mysql_fetch_array($fl)){
?> <!<div style="border-style:double; width:700px;"> 
 <form id="contactform" action="like.php" method="POST" > 
 <?php
    $caption1=$r1['caption'];
    $user1=$r1['name'];
    $time1=$r1['time'];
    ?>
    <div class="Tss">
    <?php
    echo "<div class='namee'><strong>$user1 posted at $time1<strong></div>";
    ?>
    </br>
  </br>
    <?php       
       echo "<div class='so'><strong>$caption1</strong></div>";
       ?>
    </br>
  </br>
    <?php 
    $s=strpos($r1['image'],'.');
  if(strpos($r1['image'],'.') !== false)
       echo "<div class='marmero'><img src={$r1['image']} height='500' width='500'></div>"; 
       ?>
     </br>
       <?php 
$rt="SELECT * FROM `Likes` where id='{$r1['id']}' AND email='$email'";   
  $fe=mysql_query($rt) or die(mysql_error());   
 if (mysql_fetch_array($fe)==0)

        {echo " <div class='roro' ><button class='buttom' name='like' id='like' value='$u' type='submit'> LIKE </button></div>";}
      else
        {echo " <div class='roro' ><button class='buttom' name='unlike' id='unlike' value='$u' type='submit'> Unlike </button></div>";}
      $rt="SELECT * FROM `Likes` where id='{$r1['id']}'";   
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
  mysql_query("INSERT INTO `likeid`(`idp`, `id`) VALUES ('{$r1['id']}','$u')") or die(mysql_error());
    $u=$u+1;
  }
} 
}
$re="SELECT * FROM `post` where ((privacy=1)  OR ((email='$email') AND (privacy=2)))ORDER BY time DESC ";
$fl=mysql_query($re) or die(mysql_error());
  while ($r1=mysql_fetch_array($fl)){
?> <!<div style="border-style:double; width:700px;"> 
 <form id="contactform" action="like.php" method="POST" > 
 </div>
 <div class="Ts">
 <?php
    $caption1=$r1['caption'];
    $user1=$r1['name'];
    $time1=$r1['time'];
    echo "<div class='namee'><strong>$user1 posted at $time1<strong></div>";
    ?>
    </br>
  </br>
    <?php       
       echo "<div class='so'><strong>$caption1</strong></div>";
       ?>
    </br>
  </br>
    <?php 
    $s=strpos($r1['image'],'.');
  if(strpos($r1['image'],'.') !== false)
       echo "<div class='marmero'><img src={$r1['image']} height='500' width='500'></div>"; 
       ?>
     </br>
       <?php 
$rt="SELECT * FROM `Likes` where id='{$r1['id']}' AND email='$email'";   
  $fe=mysql_query($rt) or die(mysql_error());   
 if (mysql_fetch_array($fe)==0)

        {echo " <div class='roro' ><button class='buttom' name='like' id='like' value='$u' type='submit'> LIKE </button></div>";}
      else
        {echo " <div class='roro' ><button class='buttom' name='unlike' id='unlike' value='$u' type='submit'> Unlike </button></div>";}
      $rt="SELECT * FROM `Likes` where id='{$r1['id']}'";   
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
  mysql_query("INSERT INTO `likeid`(`idp`, `id`) VALUES ('{$r1['id']}','$u')") or die(mysql_error());
    $u=$u+1;
  }
?>
     
</table>
</div>
</div>
</body>
</html>