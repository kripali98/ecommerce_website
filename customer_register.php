<?php
session_start();
include("includes/db.php");
include("functions/function.php");
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
	<li><a href="user_register.php">Sign Up</a></li>
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
		<font size="5px" style="padding-left:35px"><b>Welcome Customer</b></font>
		<div id="head1">
		<font color="yellow" size="4px" style="padding-right:5px">Shopping Cart:</font> 
		<font size="4px">Items: <?php item();?>
		Price: &#8377; <?php echo price();?><a href="cart.php" style="color:yellow;padding-left:5px;">Go To Cart</a></font>
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
	<form method="post" action="customer_register.php" enctype="multipart/form-data">
	<h1>Create An Account</h1>
	<br>
	<table align="center" width="1500px">
	<tr></tr><tr><td align="right"><b>User_Name:</b></td><td align="left"><input type="text" name="c_u_name" maxlength="10" required/></td></tr>
	<tr></tr><tr><td align="right"><b>Full_Name:</b></td><td align="left"><input type="text" name="c_name" required/></td></tr>
	<tr></tr><tr><td align="right"><b>E-mail:</b></td><td align="left"><input type="text" name="c_email" required/></td></tr>
	<tr></tr><tr><td align="right"><b>Country:</b></td><td align="left"><input type="text" name="c_country" required/></td></tr>
	<tr></tr><tr><td align="right"><b>City:</b></td><td align="left"><input type="text" name="c_city" required/></td></tr>
	<tr></tr><tr><td align="right"><b>Address:</b></td><td align="left"><input type="text" name="c_address" required/></td></tr>
	<tr></tr><tr><td align="right"><b>Mobile No:</b></td><td align="left"><input type="text" name="c_contact" required/></td></tr>
	<tr></tr><tr><td align="right"><b>Password:</b></td><td align="left"><input type="password" name="c_pass" required/></td></tr>
	<tr></tr><tr><td align="right"><b>Image:</b></td><td  align="left"><input type="file" name="c_image" required/></td></tr>
	<tr></tr>
	</table>
	<br>
	<input type="submit" name="register" value="Submit"/>
	</form>
	</div>
	</div>
	</div>
	<!--footer-->
	<div class="footer">
    
	</div>
	</div>
</body>
</html>
<?php
if(isset($_POST['register']))
{
	$c_name=$_POST['c_name'];
	$c_u_name=$_POST['c_u_name'];
	$c_email=$_POST['c_email'];
	$c_contact=$_POST['c_contact'];
	$c_password=$_POST['c_pass'];
	$c_country=$_POST['c_country'];
	$c_city=$_POST['c_city'];
	$c_image=$_FILES['c_image']['name'];
	$c_tmp_image=$_FILES['c_image']['tmp_name'];
	$c_address=$_POST['c_address'];
	$c_ip=getRealIPAddr();
	$c_q="INSERT INTO `customers`(`customer_username`,`customer_name`, `customer_email`, `customer_pass`, `customer_country`, `customer_city`, `customer_contact`, `customer_address`, `customer_image`, `customer_ip`) 
	                              VALUES ('$c_u_name','$c_name','$c_email','$c_password','$c_country','$c_city','$c_contact','$c_address','$c_image','$c_ip')";
		$run_c=mysqli_query($con,$c_q);
if($run_c==true)
{
	//move_uploaded_file($c_tmp_image,"ecom/customer\customer_photos\$c_image");
	move_uploaded_file($c_tmp_image,"customer_photos/$c_image");
	$selc="select * from cart where ip_add='$c_ip'";
	$runcart=mysqli_query($con,$selc);
	$checkcart=mysqli_num_rows($runcart);
	if($checkcart>0)
	{
		$_SESSION['customer_email']=$c_email;
		echo "<script>window.alert('You are registered successfully!!')</script>";
		echo "<script>window.open('checkout.php','_self')</script>";		
	}
	else
	{
		echo "<script>window.alert('You are registered successfully!!')</script>";
		echo "<script>window.open('index.php','_self')</script>";
	}
}
else
{
	echo "<script>window.alert('Already registered with this e-mail or Incorrect information')</script>";
}
}
?>