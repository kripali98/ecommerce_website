<?php
@session_start();
if(!isset($_SESSION['admin_email']))
{
	echo "<script>window.open('login.php','_self')</script>";
}
else
{
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin Area</title>
	<style>
	table,img
	{
		border:1px solid black;
	}
	tr,th ,td
	{
		border:1px groove black;
	}
	</style>
</head>
<body>
<?php
if(isset($_GET['view_payments']))
{
	?>
<br>
<h1><center>View All Payments</center></h1>
<br>
	<table width="794px" align="center" >
	<tr>
	<th>Payment No</th>
	<th bgcolor="#FCFA90">Invoice No</th>
	<th>Amount Paid</th>
	<th>Payment Method</th>
	<th>Ref.No</th>
	<th>Payment Date</th>
	</tr>
	<?php 
	include("includes/db.php");
	$getc="select * from payments";
	$runc=mysqli_query($con,$getc);
	$i=0;
	while($row=mysqli_fetch_array($runc))
	{
		$payment_id=$row['payment_id'];
		$invoice_no=$row['invoice_no'];
		$amount=$row['amount'];
		$payment_mode=$row['payment_mode'];
		$ref_no=$row['ref_no'];
		$payment_date=$row['payment_date'];
		 $i++;
		 
	?>
	<tr align="center">
	<td><?php echo $i;?></td>
	<td bgcolor="#FCFA90  "><?php echo $invoice_no;?></td>
	<td ><?php echo $amount;?></td>
     <td><?php echo $payment_mode;?></td>
	 <td>
	 <?php
	 echo $ref_no;
	 ?>
	 <td>
	 <?php
	 echo $payment_date;
	 ?>
	 </td>
	 </tr>
	<?php }?>
	</table>
	<?php
}
?>
</body>
</html>
<?php
}
?>