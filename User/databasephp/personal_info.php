<?php
session_start();
include "connect.php";
$conn=make_connection();
$id=$_SESSION['user_id'];

$user_name=$_POST['name'];
$gender=$_POST['gender'];
$dob=$_POST['date'];
// $query= "UPDATE `user_details` SET `user_id`='[value-1]',`user_name`='[value-2]',`user_email_id`='[value-3]',`user_mobile`='[value-4]',`user_password`='[value-5]' WHERE user_id = 3";
$query="UPDATE `user_details` SET `user_name`='$user_name',`user_gender`='$gender' WHERE user_id='$id' ";
mysqli_query($conn,$query);

$msg="done";
header("Location:../account.php?msg=$msg");
?>