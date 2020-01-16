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
	if(isset($_GET['search']))
	{
		$keyword=$_GET['product'];
	$get_p="select * from product where product_keywords like'%$keyword%'";
	$run_p=mysqli_query($con,$get_p);
	if(mysqli_num_rows($run_p)==0)
		echo "<h1>Products not found</h1>";
	else
	{
	while($row_p=mysqli_fetch_array($run_p))
	{
		$pro_id=$row_p['product_id'];
		$pro_title=$row_p['product_title'];
		$pro_price=$row_p['product_price'];
		$pro_img=$row_p['product_img1'];
		$pro_desc=$row_p['product_desc'];
		echo "<div id='sp'>
		<h3>$pro_title</h3>
		<img src='admin_area/product_images/$pro_img' width='200' height='200'/><br>
		<p><b>Price : &#8377; $pro_price</b></p>
		<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
		<a href='index.php?add_cart=$pro_id'><button style='float:right'>Add To Cart</button></a>
		</div>";
	}
	}
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