<?php
session_start();
error_reporting(0);
include "databasephp/connect.php";
$conn=make_connection();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Bookistan</title>
	<link rel="stylesheet" type="text/css" href="css/homepage.css">
	<link rel="stylesheet" type="text/css" href="css/dropdown.css">
	<link rel="icon" href="image/logo.jpg" type="image/x-icon">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">	

	<script>
		function clickCounter(){
			if(typeof(Storage)!="undefined"){
				if(localStorage.clickCount){
					localStorage.clickCount=Number(localStorage.clickCount)+1;
				}else{
					localStorage.clickCount=1;
				}
		}
		else{
		}
		}
	</script>
</head>
<body onload="clickCounter()">
	<!-- Header page-->

	<?php 

	if($_SESSION['user_id'])
		include "head.php";
	else
		include "header.php";
	
	?>

<ul id="menu">
  <ul>
    <center>
		<li>
			<div class="dropdown">
                <button class="dropbtn" style="color: #adad85">Categories</button>
                    <div class="dropdown-content">
						<a href="collection.php?data=education">Education</a>
                        <a href="collection.php?data=Literature">Literature</a>
                        <a href="collection.php?data=crime">Crime</a>
                        <a href="collection.php?data=romance">Romance</a>
                        <a href="collection.php?data=classic">Classic</a>
                        <a href="collection.php?data=science fiction">Science Fiction</a>
                        <a href="collection.php?data=fantasy">Fantasy</a>
                        <a href="collection.php?data=young adult">Young Adult</a>
                    </div>
          </div>
		</li>
		<!-- <li><a href="#">Best Sellers</a></li> -->
		<!-- <li><a href="#">Featured Books</a></li> -->
		<!-- <li><a href="#">Newly Added</a></li> -->
		<li><a href="sell_book.php">Sell</a></li>
		<li><a href="contact_us.php">Contact</a></li>
	</center>
	</ul>
</ul>