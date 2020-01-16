<?php
include("includes/db.php");
include("functions/function.php");
session_start();
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>GoShop</title>
	<link rel="stylesheet" href="styles/style.css" media="all"/>
</head>
<body>
	<!--main-->
	<div class="main">
	<!--header-->
	<div class="header">
	<a href="index.php"><img src="images/logo.png" style="height:200px;width:200px;float:left;"/></a>
	<!-- Slideshow container -->
<div class="slideshow-container">

  <!-- Full-width images with number and caption text -->
  <div class="mySlides fade">
    <img src="images/banner.jpg" style="height:200px;width:800px;float:right;">
 <!--v class="text">Caption Text</div>-->
  </div>

  <div class="mySlides fade">
    <img src="images/banner20.jpg" style="height:200px;width:800px;float:right;">
   <!--v class="text">Caption Two</div>-->
  </div>
<div class="mySlides fade">
    <img src="images/banner3.jpg" style="height:200px;width:800px;float:right;">
   <!--v class="text">Caption Three</div>-->
  </div>
  <div class="mySlides fade">
    <img src="images/banner40.jpg" style="height:200px;width:800px;float:right;">
   <!--v class="text">Caption Three</div>-->
  </div>
  <div class="mySlides fade">
    <img src="images/banner50.jpg" style="height:200px;width:800px;float:right;">
   <!--v class="text">Caption Three</div>-->
  </div>
  <div class="mySlides fade">
    <img src="images/banner60.jpg" style="height:200px;width:800px;float:right;">
   <!--v class="text">Caption Three</div>-->
  </div>
  <div class="mySlides fade">
    <img src="images/banner70.jpg" style="height:200px;width:800px;float:right;">
   <!--v class="text">Caption Three</div>-->
  </div>
  <div class="mySlides fade">
    <img src="images/banner80.jpg" style="height:200px;width:800px;float:right;">
   <!--v class="text">Caption Three</div>-->
  </div>
  <div class="mySlides fade">
    <img src="images/banner90.jpg" style="height:200px;width:800px;float:right;">
   <!--v class="text">Caption Three</div>-->
  </div>

  <!-- Next and previous buttons -->
  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>
  <script>
  var slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1} 
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none"; 
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block"; 
  dots[slideIndex-1].className += " active";
}

  </script>
</div>
<br>

	</div>
	<!--navigation-->
	<div class="nav">
	<ul id="list">
	<li><a href="index.php">Home</a></li>
	<li><a href="all_products.php">All Products</a></li>
	<li><a href="customer/my_account.php">My Account</a></li>
	<?php
	if(!isset($_SESSION['customer_email']))
	{
		?>
	<li><a href="customer_register.php">Sign Up</a></li>
	<?php }?>
	<li><a href="cart.php">Shopping Cart</a></li>
    <li><a href="contact.php">Contact Us</a></li>
	</ul>
	<div id="form">
	<form method="get" action="result.php" enctype="multipart/form-data">
	<input type="text" placeholder="Search Product" name="product">
	<input type="submit" value="Search" name="search">
	</form>
	</div>
	</div>
	<!--content-->
		<div class="content">
		<!--left-->
		<div class="left">
		<div class="category">
	Categories
	</div>
	<div id="cats">
	<ul>
	<?php
	getCat();
	?>
	</ul>
	</div>
	<div class="category">
	Brands
	</div>
	<div id="cats">
	<ul>
	<?php
	getBrand();
	?>
	</ul>
	</div>
	</div>
<!--left closes-->
	<!--right-->
		<div class="right">
		<?php
		cart();
		?>
		<div id="headline">
		<?php
		if(isset($_SESSION['customer_email']))
		{
			$mail=$_SESSION['customer_email'];
			$q2="select * from customers where customer_email='$mail'";
			$run=mysqli_query($con,$q2);
			$run_v=mysqli_fetch_array($run);
			$username=$run_v['customer_username'];
			echo '<font size="4px" style="padding-left:5px"><b>Welcome :<b> &nbsp;'.$username.'</b></font>';
		}
		else
		{
			echo '<font size="5px" style="padding-left:35px"><b>Welcome Customer</b></font>';
		}
		?>
		<div id="head1">
		<?php
		if(isset($_SESSION['customer_email']))
		{
			echo '<font color="yellow" size="4px" style="padding-right:5px">Your Shopping Cart:</font>';		}
		else
		{
			echo '<font color="yellow" size="4px" style="padding-right:5px">Shopping Cart:</font>';
		}
		?>
		 
		<font size="4px">Total Items: <?php item();?>
		Total Price: &#8377; <?php echo price();?><a href="cart.php" style="color:yellow;padding-left:5px;">Go To Cart</a></font>
		&nbsp;
		<?php
		if(isset($_SESSION['customer_email']))
		{
		echo '<a href="logout.php" style="color:orange">Logout</a>';
		}
		else
		{
			echo '<a href="checkout.php" style="color:orange">Login</a>';
		}
?>
		</div>
		</div>
<div id="product_box">
<?php 
if(isset($_SESSION['customer_email']))
{?>
	<form method="post" action="cart.php" enctype="multipart/form-data">
	<table width="780px" align="center" style="padding-top:5px">
	<tr><td><b><font size="5px">Remove</font></b></td>
	<td><b><font size="5px">Products</font></b></td>
	<td><b><font size="5px">Quantity</font></b></td>
	<td><b><font size="5px">Total Price</font></b></td>
	</tr>
	<tr>
	</tr>
	<tr>
	</tr>
	<tr>
	</tr>
	<tr>
	</tr>
	<tr>
	</tr>
	<tr>
	<?php
	$total=0;
	$email=$_SESSION['customer_email'];
	$qry="select * from cart where email='$email'";
     $run1=mysqli_query($db_con,$qry);
	 while($record=mysqli_fetch_array($run1))
	 {
		 $pro_id=$record['p_id'];
		 $qty1=$record['qty'];
		 if($qty1==0)
			$qty1=1; 
		 $pro_price="select * from product where product_id='$pro_id'";
		 $run2=mysqli_query($db_con,$pro_price);
		 while($p_price=mysqli_fetch_array($run2))
		 {
			 $product_price=array($p_price['product_price']);
			 $only_price=$p_price['product_price'];
			 $product_title=$p_price['product_title'];
			 $product_img=$p_price['product_img1'];
			 $values=array_sum($product_price);
			 $total+=$values;
			 ?>
    <td><input type="checkbox" name="remove[]" value="<?php echo $pro_id?>"></td>
	<td><?php echo "<font size='4px'><b>$product_title</b></font>"?><br><img src="admin_area/product_images/<?php echo $product_img?>" width="200px" height="200px"></td>
	<td><?php echo $qty1?><br><br>
	<a href="index.php?editq=<?php echo $pro_id;?>">Edit Quantity</a></td>
	 <td><?php echo "<font size='4px'><b>&#8377; $only_price</b></font>"?></td>
	</tr>
	 <?php }}?>
	 <tr>
	 </tr>
	 <tr>
	 </tr>
	 <tr>
	 </tr>
	 <tr>
	 </tr>
	 <tr align="right">
     <td colspan="3" align="right"><font size='5px'><b>Sub Total :</b></font></td>
	 <td align="center"><?php $total1=price();echo "<font size='5px'><b>&#8377 $total1</b></font>"?></td>
	 </tr>
	 <tr></tr>
	 <tr></tr>
	 <tr></tr>
	 <tr></tr>
	 <tr></tr>
	 <tr></tr>
	 <tr align="center"><td align="right"><input type="submit" value="Remove Products" name="update"/></td>
	 <td align="right"><input type="submit" value="Continue Shopping" name="continue"/></td>
	 <td colspan="2" align="right"><button><a href="checkout.php" style="text-decoration:none;color:black;">Checkout</a></button></td>
	 </tr>
	</table>
	</form>
	<?php
	function f1()
	{
		global $con;
	if(isset($_POST['update']))
	{
		foreach($_POST['remove'] as $remove_id)
		{
			$q5="delete from cart where p_id='$remove_id'";
			$run5=mysqli_query($con,$q5);
			if($run5)
			{
				echo "<script>window.open('cart.php','_self')</script>";
			}
		}
	}
	if(isset($_POST['continue']))
	{
			echo "<script>window.open('index.php','_self')</script>";
	}
	}
	 @f1();
}
else
{
	echo "<script>alert('First Login to see and add in the cart')</script>";
	include('customer/customer_login.php');
}
	?>
	</div>
	</div>
	</div>
	<!--footer-->
	<div class="footer">
	 
	</div>
	</div>
</body>
</html>