<!DOCTYPE html>
<html>
<title>El 3M'S w nourhan</title>
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" type="text/css" href="style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="demo.css" media="all" />
</head>
<style>
p {text-align: center; font-style: italic; color:#719dab ;margin:0; padding:0; font-size:30px;}
</style>
<body>
<?php
session_start();
$email=$_SESSION['email'];
$c = mysql_connect("localhost", "root", ""); 
 if (!$c) {
 die("Database connection failed: " . mysql_error());
 }
 $db_select = mysql_select_db("user",$c);
  if (!$db_select) {
 die("Database failed: " . mysql_error());}
   $result = mysql_query("SELECT * FROM register", $c);
  if (!$result) {
   die("Database query failed: " . mysql_error());
  }
    $res = mysql_query("SELECT * FROM register WHERE email='$email'");
    $row=mysql_fetch_array($res);

     $fname1=$_POST['fname'];
      if ($fname1=="")
     {
        $fname=$row['fname'];
     }
     else
     {
          $fname=$fname1;     
      }
     
      $lname1=$_POST['lname'];
      if ($lname1=="")
     {
        $lname=$row['lname'];
     }
     else
     {
          $lname=$lname1;     
      }
     $email=$row['email'];
     $phone1 = $_POST['phone'];
     if ($phone1=="")
     {
     	$phone = $row['phone'];
     }
     else
     {
          $phone=$phone1;     
      }
     $gender1 = $_POST['gender'];
     if ($gender1=="")
     {
     	$gender = $row['gender'];
     }
     else 
     {
     	$gender=$gender1;
     }
     $month1 = $_POST['BirthMonth'];
     $day1 = $_POST['BirthDay'];
     $year1 = $_POST['BirthYear'];
     $birthdate1= $year1.'-'.$month1.'-'.$day1;
     if ($year1=="" || $day1=="" || $month1=="")
     {
     	$birthdate = $row['birthdate'];
     }
     else
     {
         $birthdate=$birthdate1;
     }
     $town1 = $_POST['hometown'];
     if ($town1=="")
     {
        $town = $row['hometown'];
     }
     else 
     {
     	$town=$town1;
     }
     $status1=$_POST['marital'];
     if ($status1=="")
     {
     	
     $status=$row['status'];
     }
     else
     {
     	$status=$status1;
     }
     $about1=$_POST['me'];
      if ($about1=="")
     {
     	
       $about=$row['aboutme'];
     }
     else
     {
     	$about=$about1;
     }
     $img=$row['profpic'];
     echo $img;
     if ($img=="male.png" OR $img=="female.png")
     {
       $malepic = "male.png";
      $femalepic = "female.png";
     }
    else 
    {
     $malepic = $img;
      $femalepic = $img; 
    }
   if($gender=="Male")
   {

      mysql_query("UPDATE `register` SET `fname`='$fname',`lname`='$lname',`phone`='$phone',`gender`='$gender',`birthdate`='$birthdate',`hometown`='$town',`status`='$status',`aboutme`='$about',`profpic`='$malepic' WHERE email='$email' ") or die(mysql_error());
     }
     else{
      mysql_query("UPDATE `register` SET `fname`='$fname',`lname`='$lname',`phone`='$phone',`gender`='$gender',`birthdate`='$birthdate',`hometown`='$town',`status`='$status',`aboutme`='$about',`profpic`='$femalepic' WHERE email='$email'") or die(mysql_error());
     }
   header( "Location: Profile.php" ); die;
?>
</body>	
</html>