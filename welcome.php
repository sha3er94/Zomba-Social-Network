<!DOCTYPE html>
<html>
<head> <title> Registration </title> 
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
<link rel="stylesheet" type="text/css" href="style.css" media="all" />
<link rel="stylesheet" type="text/css" href="demo.css" media="all" />
</head>
<body style="background-color:#FF9966">
  <?php 
$c = mysql_connect("localhost", "root", ""); 
 if (!$c) {
 die("Database connection failed: " . mysql_error());
 }
 $db_select = mysql_select_db("user",$c);
 if (!$db_select) {
 die("Database failed: " . mysql_error());}
?>  
<?php
session_start();
   $result = mysql_query("SELECT * FROM register", $c);
  if (!$result) {
      die("Database query failed: " . mysql_error());
    }
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];       
        $name= $fname.' '.$lname; 
         $_SESSION['name']=$name;
        $Em=$_POST['email'];
        $_SESSION['email']=$Em;
       
         if (!filter_var($Em, FILTER_VALIDATE_EMAIL)) {
           echo "ERROR WRONG EMAIL";
           echo "<script> alert('WRONG Email Format');window.location.href='index.html'; </script>";
          exit;
}
    $pass=$_POST['password'];
    $enc = md5($pass);
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];
        $month = $_POST['BirthMonth'];
        $day = $_POST['BirthDay'];
        $year = $_POST['BirthYear'];
        $birthdate= $year.'_'.$month.'_'.$day;
        $town = $_POST['hometown'];
        $status=$_POST['marital'];
        $about=$_POST['me'];
        $query = "SELECT * FROM register WHERE email = '$Em'";
		$malepic = "male.png";
		$femalepic = "female.png";
        $result = mysql_query($query) or die(mysql_error());
  if(mysql_num_rows($result)==0)
   { 
             
     if($gender=="Male"){
      mysql_query("INSERT INTO `register`(`fname`, `lname`, `password`, `email`, `phone`, `gender`, `birthdate`, `hometown`, `status`, `aboutme`, `profpic`) VALUES ('$fname','$lname','$enc','$Em','$phone','$gender','$birthdate','$town','$status','$about','$malepic')") or die(mysql_error());
     }
     else{
       mysql_query("INSERT INTO `register`(`fname`, `lname`, `password`, `email`, `phone`, `gender`, `birthdate`, `hometown`, `status`, `aboutme`, `profpic`) VALUES ('$fname','$lname','$enc','$Em','$phone','$gender','$birthdate','$town','$status','$about', '$femalepic')") or die(mysql_error());
     }
	 $res=mysql_query("SELECT * FROM register WHERE email='$Em'");
	 $row=mysql_fetch_array($res);
	echo"<tr>";
	echo"<td>"; ?>
	
	<img src="<?php echo $row["profpic"]; ?>" height="100" width="100">
	<?php	 
	 echo"</td>";
	 echo"</tr>";
            header( "Location: home.php" ); die;
   }
 else
    {
            echo "<script> alert('Pick another Email');window.location.href='index.html'; </script>";
    }

?>
</strong>
</p>
<?php
 mysql_close($c);
?>
 </body>
</html>