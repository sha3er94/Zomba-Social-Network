<?php
    $c = mysql_connect("localhost", "root", ""); 
 if (!$c) {
 die("Database connection failed: " . mysql_error());
 }
 $db_select = mysql_select_db("user",$c);
  if (!$db_select) {
 die("Database failed: " . mysql_error());}
	$res=$_POST['res'];
	if(!empty($res)){
    $query=mysql_query("select * from register where fname LIKE '%{$res}%' or lname LIKE '%{$res}%'") or die(mysql_error());
	while($row=mysql_fetch_assoc($query))
    {
      echo'<div>'.$row['fname'].' '.$row['lname'].'</div>';
	  echo"<br/>";
    }
	}
?>