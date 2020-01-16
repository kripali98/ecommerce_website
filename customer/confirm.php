<?php
include("includes/db.php");
session_start();
if(isset($_GET['order_id']))
{
	$order_id=$_GET['order_id'];
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>GoShop</title>
</head>
<body bgcolor="#34495E ">
	<form action="confirm.php?update_id=<?php echo $order_id;?>" method="post">
	<table width="600" align="center" border="2" bgcolor="#D0D3D4 ">
	<tr align="center"><td colspan="2"><h2>Please Confirm Your Payment</h2></td></tr>
	<tr>
	<td align="right"><b>Invoice No &nbsp;</b></td>
	<td><input type="text" name="invoice_no" required></td>
	</tr>
	<tr>
	<td align="right"><b>Amount Paid &nbsp;</b></td>
	<td><input type="text" name="amount" required></td>
	</tr>
	<tr>
	<td align="right"><b>Select Payment Mode &nbsp;</b></td>
	<td><select name="payment_method" required>
	<option>Select Payment Method</option>
	<option>Bank Transfer</option>
	<option>Paypal</option>
	<option>Paytm</option>
	<option>Mobile Payment</option>
	<option>Debit Card</option>
	</select></td>
	</tr>
	<tr>
	<td align="right"><b>Transaction/Reference ID &nbsp;</b></td>
	<td><input type="text" name="tr" required></td>
	</tr>
	<tr>
	<td align="right"><b>Payment Date &nbsp;</b></td>
	<td><input type="text" name="date" required></td>
	</tr>
	<tr align="center"><td colspan="2"><input type="submit" value="Confirm Payment" name="confirm"</td>
	</tr>
	</table>
	</form>
</body>
</html>
<?php
if(isset($_POST['confirm']))
{
	$update_id=$_GET['update_id'];
	$invoice=$_POST['invoice_no'];
	$amount=$_POST['amount'];
	$payment_method=$_POST['payment_method'];
	$ref_no=$_POST['tr'];
	$date=$_POST['date'];
	$complete='Complete';
	$insert="INSERT INTO `payments`(`invoice_no`, `amount`, `payment_mode`, `ref_no`, `payment_date`) 
	                                  VALUES ('$invoice','$amount','$payment_method','$ref_no','$date')";
		$run=mysqli_query($con,$insert);
if($run)
{
echo "<h1 style='text-align:center;color:white'>Payment received, your order will be completed within 24 hours</h1>";	
$update_order="update customer_orders set order_status='$complete' where order_id='$update_id'";
$run_order=mysqli_query($con,$update_order);
echo "<a href='my_account.php' style='text-decoration:none;color:white;'><h1 style='text-align:center;color:white'>Click here </a>to continue</h1>";
}
}
?>