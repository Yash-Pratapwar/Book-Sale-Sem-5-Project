<?php
session_start();
error_reporting(0);
include "connect.php";
$conn=make_connection();
$email=$_POST['email'];
$pass=$_POST['password'];

$_SESSION['email']=$email;
$query="Select * from admin_details where admin_email_id='$email' and admin_password='$pass';";
$result=mysqli_query($conn,$query);
if(mysqli_num_rows($result)){
	$data=mysqli_fetch_array($result);
	$_SESSION['admin_id']=$data['admin_id'];
		header("Location:../total_book.php");
}
else{
	$msg = "wrong";
	header("Location:../login.php?msg=$msg");
}

?>