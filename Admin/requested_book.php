<!DOCTYPE html>
<?php 
	include "connect.php";
	error_reporting(0);
	$conn=make_connection();

	if(isset($_GET['page'])){
		$page=$_GET['page'];
	}
	else{
		$page=1;
	}
	$num_per_page=10;
	$start_from=($page-1)*10;
 ?>

<html>
<head>
	<title>Bookistan</title>
		<link rel="stylesheet" type="text/css" href="css/side_navigation.css">
		<link rel="stylesheet" type="text/css" href="css/card.css">
</head>
<body>
	<div id="mySidenav" class="sidenav" style="width:250px;float: right">
	<span style="color: white;font-size: 40px">BOOKISTAN</span><br><br>
 <!-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>-->
  <!-- <a href="admin_homepage.php">Home</a> -->
  <a href="total_book.php">Total Books</a>
  <a href="book_genre.php">Books By Genre</a>
  <a href="book_sale_request.php">Book Sale Request</a>
  <a href="add_remove.php">Add or Remove a book</a>
  <a href="order.php">Ordered Books</a>
  <a href="#">Requested Book</a>
</div>
<span style="text-align: center;margin-left: 600px;font-size: 30px">Requested Book</span>
	
			<form action="databasephp/approved.php" method="post">
			<table width="1000" style="box-shadow: 1px 1px 10px;margin-left: 300px;margin-top: 50px;border-style: solid;border-width: 1px;font-size: 18px" cellspacing="10">
		<th width="60" >S.no</th>
		<th width="197" >Book Name</th>
		<th width="200" >Book ISBN No</th>
		<th width="138" >Publisher</th>
		<th width="138" >Edition</th>
		<?php  
				$query="Select * from `book_request` where `status`='pending';";
				$result=mysqli_query($conn,$query);
				while($data=mysqli_fetch_array($result)){
			?>
		<tr>
			<td style="text-align: center;"><?php echo $data['user_id'];?><input type="text" hidden name="user_id" value="<?php echo $data['user_id'];?>"></td>
			<td style="text-align: center;"><?php echo $data['book_name'];?></td>
			<td style="text-align: center;"><?php echo $data['isbn_no'];?></td>
			<td style="text-align: center;"><?php echo $data['publisher'];?></td>
			<td style="text-align: center;"> <?php echo $data['edition'];?></td>
			<td style="text-align: center;"><input type="submit" name="" value="Approved" style="border-radius: 5px;box-shadow: 1px 1px 10px;height: 30px;font-size: 15px"></td></form>
		<?php } ?> 
		</tr>
	</table><br>
	<center>
		<?php 
				$prquery = "Select * from `book_request` where `status`='pending';";
				$prresult=mysqli_query($conn,$query);
				$totalrecord = mysqli_num_rows($prresult);

				$totalpages = ceil($totalrecord/$num_per_page);
				for($i=1;$i<=$totalpages;$i++)
				{
				  echo "<a href='requested_book.php?page=".$i."' class='btn btn-success'>$i</a>";
				}
		?>
	
</center>
</body>
</html>
<?php 
 if($_GET['msg']=="approved"){
  echo '<script language="javascript">';
  echo 'alert("BOOK APPROVED :-)")';
  echo '</script>';
}
?>