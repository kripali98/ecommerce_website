<?php
$db_con=mysqli_connect("localhost","root","","goshop");
function getPro()
{
	global $db_con;
	if(!isset($_GET['cat']))
	{
		if(!isset($_GET['brand']))
		{
	$get_p="select * from product order by rand() LIMIT 0,6";
	$run_p=mysqli_query($db_con,$get_p);
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
	}
}
function getBrandPro()
{
	global $db_con;
		if(isset($_GET['brand']))
		{
	$b_id=$_GET['brand'];
	$get_b_p="select * from product where brand_id='$b_id'";
	$run_b_p=mysqli_query($db_con,$get_b_p);
	if(mysqli_num_rows($run_b_p)==0)
		echo "<h1>Products not found</h1>";
	else
	{
	while($row_b_p=mysqli_fetch_array($run_b_p))
	{
		$pro_id=$row_b_p['product_id'];
		$pro_title=$row_b_p['product_title'];
		$pro_price=$row_b_p['product_price'];
		$pro_img=$row_b_p['product_img1'];
		$pro_desc=$row_b_p['product_desc'];
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
}

function getCatPro()
{
	global $db_con;
		if(isset($_GET['cat']))
		{
	$c_id=$_GET['cat'];
	$get_c_p="select * from product where cat_id='$c_id'";
	$run_c_p=mysqli_query($db_con,$get_c_p);
	if(mysqli_num_rows($run_c_p)==0)
		echo "<h1>Products not found</h1>";
	else
	{
	while($row_c_p=mysqli_fetch_array($run_c_p))
	{
		$pro_id=$row_c_p['product_id'];
		$pro_title=$row_c_p['product_title'];
		$pro_price=$row_c_p['product_price'];
		$pro_img=$row_c_p['product_img1'];
		$pro_desc=$row_c_p['product_desc'];
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
}
function getCat()
{
	global $db_con;
	$query="Select * from categories";
	$run=mysqli_query($db_con,$query);
	while($getc=mysqli_fetch_array($run))
	{
		$id=$getc['cat_id'];
		$title=$getc['cat_title'];
	echo "<li><a href='index.php?cat=$id'>$title</a></li>";
	}
}
function getBrand()
{
	global $db_con;
	$query="Select * from brands";
	$run=mysqli_query($db_con,$query);
	while($getb=mysqli_fetch_array($run))
	{
		$id=$getb['brand_id'];
		$title=$getb['brand_title'];
	echo "<li><a href='index.php?brand=$id'>$title</a></li>";
	}
}
function getRealIPAddr()
{
	if (!empty($_SERVER["HTTP_CLIENT_IP"]))
{
//check for ip from share internet
$ip = $_SERVER["HTTP_CLIENT_IP"];
}
elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
{
// Check for the Proxy User
$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
}
else
{
$ip = $_SERVER["REMOTE_ADDR"];
}
return $ip;
}
function cart()
{
	if(isset($_GET['add_cart']))
	{
		if(isset($_SESSION['customer_email']))
		{
		global $db_con;
		$p_id=$_GET['add_cart'];
		$email=$_SESSION['customer_email'];
		$q1="select * from cart where email='$email' and p_id='$p_id'";
		$runq=mysqli_query($db_con,$q1);
		if(mysqli_num_rows($runq)>0)
		{
			echo "<script>window.open('index.php','_self')</script>";
		}
		else
		{
			$q2="insert into cart(p_id,email) values('$p_id','$email')";
			mysqli_query($db_con,$q2);
			echo "<script>window.open('index.php','_self')</script>";
	}
		}
		else
		{
		
			echo "<script>window.open('cart.php','_self')</script>";
		}
	}
}

function item()
{
	if(isset($_SESSION['customer_email']))
	{
	$email=$_SESSION['customer_email'];
	if(isset($_GET['add_cart']))
	{
	 $email=$_SESSION['customer_email'];
      global $db_con;
	  $qu="select * from cart where email='$email'";
	  $run=mysqli_query($db_con,$qu);
	  $count1=mysqli_num_rows($run);
	  echo $count1;
}
	else
	{
		global $db_con;
	  $qu="select * from cart where email='$email'";
	  $run=mysqli_query($db_con,$qu);
	  $count1=mysqli_num_rows($run);
	  echo $count1;
	}
	}
	else 
	{
		echo "0";
	}
	}
function price()
{
		if(isset($_SESSION['customer_email']))
	{
	$email=$_SESSION['customer_email'];
	global $db_con;
	$total=0;
	$email=$_SESSION['customer_email'];
	$qry="select * from cart where email='$email'";
     $run1=mysqli_query($db_con,$qry);
	 while($record=mysqli_fetch_array($run1))
	 {
		 $qty=$record['qty'];
		 if($qty==0)
			 $qty=1;
		 $pro_id=$record['p_id'];
		 $pro_price="select * from product where product_id='$pro_id'";
		 $run2=mysqli_query($db_con,$pro_price);
		 while($p_price=mysqli_fetch_array($run2))
		 {
			 $t_price=$p_price['product_price']*$qty;
			 $product_price=array($t_price);
			 $values=array_sum($product_price);
			 $total+=$values;
		 }
		 
	}
	return $total;
	}
	else
	{
		return '0';
	}
}
?>