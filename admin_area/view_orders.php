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
if(isset($_GET['view_orders']))
{
	?>
<br>
<h1><center>View All Orders</center></h1>
<br>
	<table width="794px" align="center" >
	<tr>
	<th>S.No</th>
	<th>Customer</th>
	<th bgcolor="#FCFA90">Invoice No</th>
	<th>Total Products</th>
	<th>Status</th>
	<th>Delete</th>
	</tr>
	<?php 
	include("includes/db.php");
	$getc="select * from customer_orders";
	$runc=mysqli_query($con,$getc);
	$i=0;
	while($row=mysqli_fetch_array($runc))
	{
		$order_id=$row['order_id'];
		$invoice_no=$row['invoice_no'];
		$total_products=$row['total_products'];
		$status=$row['order_status'];
		$customer_id=$row['customer_id'];
		$gete="select * from customers where customer_id='$customer_id'";
	   $rune=mysqli_query($con,$gete);
	   $rowe=mysqli_fetch_array($rune);
	   $customer_email=$rowe['customer_email'];
		 $i++;
		 
	?>
	<tr align="center">
	<td><?php echo $i;?></td>
	<td><?php echo $customer_email;?></td>
	<td bgcolor="#FCFA90  "><?php echo $invoice_no;?></td>
     <td><?php echo $total_products;?></td>
	 <td>
	 <?php
	 echo $status;
	 ?>
	 </td>
	 <td><a href="delete_o.php?delete_o=<?php echo $order_id;?>">Delete</a></td>
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