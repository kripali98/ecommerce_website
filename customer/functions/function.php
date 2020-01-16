<?php
$db_con=mysqli_connect("localhost","root","","goshop");

function getDefault()
{
	global $db_con;
	if(isset($_SESSION['customer_email']))
	{
	$c=$_SESSION['customer_email'];
	$get_c="select * from customers where customer_email='$c'";
	$runc=mysqli_query($db_con,$get_c);
	$row_c=mysqli_fetch_array($runc);
	$customer_id=$row_c['customer_id'];
	$customer_name=$row_c['customer_name'];
	if(!isset($_GET['my_orders']))
	{
		if(!isset($_GET['change_pic']))
	{
		if(!isset($_GET['edit_account']))
	{
		if(!isset($_GET['change_pass']))
	{
		if(!isset($_GET['delete_account']))
	{
		$getorder="select * from customer_orders where customer_id='$customer_id' and order_status='Pending'";
		$runorder=mysqli_query($db_con,$getorder);
		$countorder=mysqli_num_rows($runorder);
		if($countorder>0)
		{
			echo "<div style='padding:20px'><br/>
			<h1 style='color:blue'>HELLO<font color='#2BB734'> $customer_name </font>!!</h1>
			<br/><br><h1 style='color:red'>Important!!</h1><br>
			<h2> You have $countorder orders pending</h2><br>
			<h3>Please see your order details by clicking <a href='my_account.php?my_orders'>here</a><br> and pay offline by clicking on this <a href='pay_offline.php'>link</a></h3>";
		}
		else
		{
			echo "<div style='padding:20px'><br/>
			<h1 style='color:blue'>HELLO<font color='#2BB734'> $customer_name </font>!!</h1>
			<br/><br><h1 style='color:red'>Important!!</h1><br>
			<h2> You have no orders pending</h2><br>
			<h3>You can see the history of your order details by clicking <a href='my_account.php?my_orders'>here</a></h3>";
	
		}
	}
	}}}}}
}
function getPro()
{
	global $db_con;
	if(!isset($_GET['cat']))
	{
		if(!isset($_GET['brand']))
		{
	$get_p="select * from product order by rand() LIMIT 0,6";
	$run_p=mysqli_query($db_con,$get_p);
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
function getBrandPro()
{
	global $db_con;
		if(isset($_GET['brand']))
		{
	$b_id=$_GET['brand'];
	$get_b_p="select * from product where brand_id='$b_id'";
	$run_b_p=mysqli_query($db_con,$get_b_p);
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

function getCatPro()
{
	global $db_con;
		if(isset($_GET['cat']))
		{
	$c_id=$_GET['cat'];
	$get_c_p="select * from product where cat_id='$c_id'";
	$run_c_p=mysqli_query($db_con,$get_c_p);
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
		global $db_con;
		$p_id=$_GET['add_cart'];
		$ip_add=getRealIPAddr();
		$q1="select * from cart where ip_add='$ip_add' and p_id='$p_id'";
		$runq=mysqli_query($db_con,$q1);
		if(mysqli_num_rows($runq)>0)
		{
			echo "<script>window.open('index.php','_self')</script>";
		}
		else
		{
			$q2="insert into cart(p_id,ip_add) values('$p_id','$ip_add')";
			mysqli_query($db_con,$q2);
			echo "<script>window.open('index.php','_self')</script>";
	}
	}
}
function item()
{
	if(isset($_GET['add_cart']))
	{
      global $db_con;
	  $qu="select * from cart where ip_add='getRealIPAddr()'";
	  $run=mysqli_query($db_con,$qu);
	  $count1=mysqli_num_rows($run);
	  echo $count1;
}
	else
	{
		global $db_con;
	  $qu="select * from cart where ip_add='getRealIPAddr()'";
	  $run=mysqli_query($db_con,$qu);
	  $count1=mysqli_num_rows($run);
	  echo $count1;
	}
}
function price()
{
	global $db_con;
	$total=0;
	$qry="select * from cart where ip_add='getRealIPAddr()'";
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
?>