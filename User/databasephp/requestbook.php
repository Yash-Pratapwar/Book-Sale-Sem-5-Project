<?php
include "connect.php";
session_start();
$conn=make_connection();	

$id=$_SESSION['user_id'];
$book_title=$_POST['book_title'];
$book_isbn=$_POST['book_isbn'];
$book_publisher=$_POST['book_publisher'];
$book_edition=$_POST['book_edition'];
$query="INSERT INTO `book_request`(`user_id`, `book_name`, `isbn_no`, `publisher`, `edition`,`status`) VALUES ('$id','$book_title',$book_isbn,'$book_publisher','$book_edition','pending');";

mysqli_query($conn,$query);

$msg="done";
header("Location:../requestbook.php?msg=$msg");
?>