<?php
session_start();
error_reporting(0);
$flag;
$flag_wish;
$flag2;
$wish_flag;
$cart_flag;
$s_no=$_POST['s_no'];
if(!$s_no){
	$s_no=$_SESSION['book'];
}


$i=1;
print_r($_SESSION['wishlist']);
include "databasephp/connect.php";
$conn=make_connection();
if(in_array($s_no,$_SESSION['wishlist'])){
	$wish_flag=1;
}
if(in_array($s_no,$_SESSION['cart'])){
	$cart_flag=1;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Bookistan</title>
	<link rel="stylesheet" type="text/css" href="css/homepage.css">
	<link rel="stylesheet" type="text/css" href="css/dropdown.css">
	<link rel="stylesheet" type="text/css" href="css/rating.css">
	<link rel="stylesheet" href="css\font-awesome-4.7.0\css\font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">	

</head>
<body>
<?php
if($_SESSION['user_id']){
	$flag_wish=true;
	include "head.php";
}
else{
	include "header.php";
}
?>

<ul id="menu">
  <ul>
    <center>
		<li>
			<div class="dropdown">
                <button class="dropbtn" style="color: #adad85">Categories</button>
                    <div class="dropdown-content">
                        <a href="collection.php?data=literature">Literature</a>
                        <a href="collection.php?data=crime">Crime</a>
                        <a href="collection.php?data=romance">Romance</a>
                        <a href="collection.php?data=classic">Classic</a>
                        <a href="collection.php?data=science fiction">Science Fiction</a>
                        <a href="collection.php?data=fantasy">Fantasy</a>
                        <a href="collection.php?data=children">Children</a>
                        <a href="collection.php?data=young adult">Young Adult</a>
                    </div>
          </div>
		</li>
		<li><a href="#">Sell</a></li>
		<li><a href="#">Contact</a></li>
	</center>
	</ul>
</ul>
<hr>
<div style="background-color: white;height: 800px;width:1100px;margin-left: 10%;margin-top: 100px">
	<table>
		<?php 
			$query="Select * from book_details where `s_no` = $s_no;";
			$result=mysqli_query($conn,$query);
			while($data=mysqli_fetch_array($result)){
				if($data['quantity']==0){ $flag2==true;}
		?>
		<th>
			<img src="<?php echo $data['book_image']; ?>" height="400px" width="300px">
		</th>
		<th width="500px">
			<div style="background-color: white;margin-left: 10px;">
				<span style="text-align: left;font-size: 15px;float: left"><?php echo $data['book_name'];?></span><br>
				<span style="font-size: 15px;float: left">AUTHOR:<span style="font-size: 15px;"><?php echo $data['book_author'];?></span></span><br>
				<span style="font-size: 15px;float: right;">AVAILABILITY:<span><?php if($flag2){echo "not in stock";}else{echo "INSTOCK";}?></span></span><br><br><br>
				<p style="font-size: 15px;text-align: left;font-family: Times New Roman"><?php echo $data['book_description']; ?></p>
				<span style="float: left;font-size: 15px">ISBN:<span><?php echo $data['isbn_no']; ?></span></span>	
			</div>
		</th>
		<th>
			<table style="margin: 20px;">
				<th width="400px">
					<div style="background-color: blue;font-size: 15px;padding: 10px">
						<span style="float: left">BUY:</span><span style="margin-left: 10px">Rs.<?php echo $data['cost']; ?> <s style="color: red">Rs. <?php echo $data['cost']+50 ;?></s></span>
					</div>
				</th>

				<tr>

					<td >
						<div style="margin-left: -150px;">
						<form action="databasephp/wishlist_data.php" method="post">
							<input type="text" name="s_no" value="<?php echo $data['s_no']; ?>" hidden>
							<button  style="padding-left: 10px;" onclick="<?php if(!$wish_flag)?>" <?php if($wish_flag)echo "disabled";?>><?php if($wish_flag)echo "Added to wishlist";else echo "Add to Wishlist";?></button>
						</form>
						</div>
						<div style="margin-top:-43px ">
							<form action="cart.php" method="post">
							<button style="margin-left: 140px;margin-top:-250px " onclick="<?php if(!$cart_flag)?>" <?php if($cart_flag)echo "disabled";?>><?php if($cart_flag)echo "Already added";else echo "Add to Cart";?></button>
							<input type="text" name="s_no" value="<?php echo $data['s_no']; ?>" hidden>
							</form>
						</div>	
					</td>
				</tr>

				<tr>
					<td>
						<?php
								$var=$data['isbn_no'];
									$query2="Select * from book_rating where book_isbn=$var;";
									$result2=mysqli_query($conn,$query2);
									$data2=mysqli_fetch_array($result2);
									$avg;
									try {
										$avg=$data2['total_rating']/$data2['no_of_people_rated'];	
									} catch (Exception $e) {
										$avg=1;
									}
									

						?>
						
					</td>
				</tr>
				<tr>

				</tr>		
		</th>
	</table></th></table><br><br><br>
	<?php }?>
	Do you know what You should also try this!<br><br>
<!-- CARDS-->
			<?php 
				$query1="Select * from book_details order by rand() limit 5;";
				$result1=mysqli_query($conn,$query1);
				while($data1=mysqli_fetch_array($result1))
				{
			?>	
	<div class="img_recommend">
		<form action="book_buy.php" method="post">
					<input type="text" name="s_no" value="<?php echo $data1['s_no']; ?>" hidden>
					<button class="img_but"><img src="<?php echo $data1['book_image'];?>" width="100%" height="200px">
					</button>
					<center><span style="font-size: 10px"><?php echo $data1['book_name'];?></span></center><br>
					<span style="font-size: 13px">Rs. <?php echo $data1['cost']?></span><span style="float: right;font-size: 13px;color: red">Rs.<s><?php echo $data1['cost']+50;?></s></span>
		</form>
	</div>
				<?php } ?>
		
</div>
<!-- CARDS END-->
<br><br><br><br><br><br><br><br><br><br><br><br>
			<footer style="background-color: #111109 ;color: white">
				<table width="874" height="318" border="0">
						  <tr>
						    <th width="390" height="37" scope="col">ABOUT US</th>
						    <th width="17" scope="col">&nbsp;</th>
						    <th width="297" scope="col">INFORMATION</th>
						    
						    <th width="152" scope="col">Contact Us</th>
						  </tr>
						  <tr>
						    <th height="146" scope="row">Ever wanted to buy a book but could not because it was too expensive? worry not! because <strong>Bookistan</strong> is here! <strong>Bookistan</strong>, these days in news,is being called as the Robinhood of the world of books. <strong>Bookistan</strong> team is committed to bring to you all kinds of best books at the minimal prices ever seen anywhere. Yes, we are literally giving you away a steal.</th>
						    <td>&nbsp;</td>
						    <td>&nbsp;</td>
						    <td>&nbsp;</td>
						  </tr>
						  <tr>
						    <th scope="row">&nbsp;</th>
						    <td>&nbsp;</td>
						    <td>&nbsp;</td>
						    <td>&nbsp;</td>
						  </tr>
				</table>
			</footer>
</body>
</html>
<?php
	if($_GET['msg']=='done'){
		echo "<script>alert('Thank u for your valuable rating');</script>";
	}
?>