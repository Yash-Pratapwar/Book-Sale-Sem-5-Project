<?php 
	include "connect.php";
	$conn=make_connection();

	$user_id=$_POST['user_id'];
	echo $user_id;
	$query="update `book_request` set `status` ='approved' where `user_id`=$user_id;";
	mysqli_query($conn,$query);
	mysqli_close($conn);
	$msg="approved";
	header("Location:../requested_book.php?msg=$msg");
 ?>