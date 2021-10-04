<?php
	include "connect.php";
	$conn=make_connection();
	$email=$_POST['email'];
	$pass=$_POST['password'];


	$query1="Select * from admin_details;";
	$result=mysqli_query($conn,$query1);
	if(mysqli_num_rows($result)==0){
		$query2="INSERT INTO `admin_details` (`admin_id`, `admin_name`, `admin_email_id`, `admin_mobile`, `admin_password`) VALUES (1, '', '$email', '', '$pass')";
		mysqli_query($conn,$query2);
		header("location:../login.php");
	}
	else{
		$query3="SELECT MAX(admin_id) from admin_details;";
		$count=mysqli_query($conn,$query3);
		$result=mysqli_fetch_array($count);
		$id=$result['MAX(admin_id)']+1;
		$query4="INSERT INTO `admin_details` (`admin_id`, `admin_name`, `admin_email_id`, `admin_mobile`, `admin_password`) VALUES ('$id','', '$email', '', '$pass')";
		if(!mysqli_query($conn,$query4)){echo "failed";}
		$msg="done";
		header("location:../login.php?msg=$msg");
	}
?>