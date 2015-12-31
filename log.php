<HTML>
<Head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
<link rel="stylesheet" type="text/css" href="style.css" media="all" />
<link rel="stylesheet" type="text/css" href="demo.css" media="all" />
</Head>
<Body>
<?php
 $conn = mysql_connect("localhost", "root", ""); 
 if (!$conn) {
 die("Database connection failed miserably: " . mysql_error());
 }
 $db_select = mysql_select_db("user",$conn);
 if (!$db_select) {
 die("Database selection also failed miserably: " . mysql_error());
 }
?>

<?php
		$result = mysql_query("SELECT * FROM register", $conn);
		if (!$result) {
			die("Database query failed: " . mysql_error());
		}

        $email=$_POST['email'];
		$password2=md5($_POST['password']);
		$result = mysql_query("SELECT * FROM register WHERE email='$email' AND password='$password2'");
		if(mysql_num_rows($result)==0)
		{
			echo "<script> alert('WRONG user ID or Password');window.location.href='login.php'; </script>";
	    //header( "Location: registration.php" ); die;
		}
		else
		{ 
            $row = mysql_fetch_assoc( $result );
			$fname=$row['fname'];
			session_start();
		    $_SESSION['fname']=$fname;
		    $_SESSION['email']=$email;
		    header( "Location: home.php" ); die;
          
		}
?>

<?php
 mysql_close($conn);
?>
</Body>
</HTML>