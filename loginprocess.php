<?php

session_start ();
include("connection.php"); 

if(isset($_REQUEST['sub']))
{
$a = $_REQUEST['email'];
$b = $_REQUEST['password'];

$res = mysqli_query($conn,"select * from login where email_id='$a'and password='$b'");
$result=mysqli_fetch_array($res);
if($result)
{
	
	$_SESSION["login"]="1";
	header("location:trioperation.php");
}
else	
{
	header("location:login.php?err=1");
	
}
}
?>
