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
	<a href="../index.php"><img src="images/logo.png" style="height:200px;width:200px;float:left;"/></a>
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
  var myIndex = 0;
carousel();
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
function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 2000); // Change image every 2 seconds
}
  </script>
</div>
<br>

	</div>
	<!--navigation-->
	<div class="nav">
	<ul id="list">
	<li><a href="../index.php">Home</a></li>
	<li><a href="../all_products.php">All Products</a></li>
	<li><a href="../customer/my_account.php">My Account</a></li>
	<?php
	if(!isset($_SESSION['customer_email']))
	{
		?>
	<li><a href="../customer_register.php">Sign Up</a></li>
	<?php }?>
	<li><a href="../cart.php">Shopping Cart</a></li>
    <li><a href="../contact.php">Contact Us</a></li>
	</ul>
	<div id="form">
	<form method="get" action="../result.php" enctype="multipart/form-data">
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
	Manage Account :
	</div>
	<div id="cats">
	<ul>
	<?php
	if(isset($_SESSION['customer_email']))
	{
		$c_mail=$_SESSION['customer_email'];
		$getpic="select * from customers where customer_email='$c_mail'";
		$runp=mysqli_query($con,$getpic);
		$r=mysqli_fetch_array($runp);
		$pic=$r['customer_image'];
		echo "<img src='../customer_photos/$pic' width='200px' height='auto' style='border:2px solid #0F3068  ;'><br>";
	}
	?>
	<li><b><a href='my_account.php?change_pic'>Change Photo</a></b></li>
	<br/>
	<li><a href="my_account.php?my_orders">My Orders</a></li>
	<li><a href="my_account.php?edit_account">Edit Account</a></li>
	<li><a href="my_account.php?change_pass">Change Password</a></li>
	<li><a href="my_account.php?delete_account">Delete Account</a></li>
	<li><a href="logout.php">Logout</a></li>		
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
         <div id="head1">
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
&nbsp; &nbsp;
		<?php
		if(isset($_SESSION['customer_email']))
		{
		echo '<a href="logout.php" style="color:orange">Logout</a>';
		}
		else
		{
			echo '<a href="../checkout.php" style="color:orange">Login</a>';
		}
?>
</div>
		</div>
	<div id="product_box">
	<?php
	getDefault();
	?>
	<?php
	if(isset($_GET['change_pic']))
	{
		include("change_pic.php");
	}
	if(isset($_GET['my_orders']))
	{
		include("my_orders.php");
	}
	if(isset($_GET['edit_account']))
	{
		include("edit_account.php");
	}
	if(isset($_GET['change_pass']))
	{
		include("change_pass.php");
	}
	if(isset($_GET['delete_account']))
	{
		include("delete_account.php");
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