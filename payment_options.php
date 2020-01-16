<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php 
	include("includes/db.php");
//include("functions/function.php");
	?>
</head>
<body>
	<div align="center" style="padding:20px;">
<h1>Payment Options for You</h1>
<br>
<?php
$email=$_SESSION['customer_email'];
$get_c="select * from customers where customer_email='$email'";
$run_c=mysqli_query($con,$get_c);
$customer=mysqli_fetch_array($run_c);
$customer_id=$customer['customer_id'];
?>
<b><font size="4px">Pay With</font> </b>
<br><br><a href="https://www.paypal.com"><img src="images/paypal.png"/></a>
<br><br><font size="4px"><b>Or</b></font><br><br><a href="order.php?c_id=<?php echo $customer_id;?>"><b><font size="4px">Pay Offline</font></b></a>
<br>
<br>
<b><font size="4px">If you select 'pay offline', please check your e-mail or account to find the invoice no of your order</font></b>
</div>
</body>
</html>