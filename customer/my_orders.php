<?php
include("includes/db.php");
if(!isset($_SESSION['customer_email']))
echo "<h1>Please Log In to See Your Orders</h1>";
else
{
$c=$_SESSION['customer_email'];
	$get_c="select * from customers where customer_email='$c'";
	$runc=mysqli_query($con,$get_c);
	$row_c=mysqli_fetch_array($runc);
	$customer_id=$row_c['customer_id'];

?>
<h1 style="color:#114668;padding:20px">Your Orders</h1>
<table width="760px" align="center" bgcolor="#F1BB80" style="border:1px solid black">
<tr>
<th>Order No</th>
<th>Due Amount</th>
<th>Invoice No</th>
<th>Total Products</th>
<th>Order Date</th>
<th>Paid/Unpaid</th>
<th>Status</th>
</tr>
<?php
$get_order="select * from customer_orders where customer_id='$customer_id'";
$run_order=mysqli_query($con,$get_order);
$i=0;
while($row_order=mysqli_fetch_array($run_order))
{
	$order_id=$row_order['order_id'];
	$due_amount=$row_order['due_amount'];
	$invoice_no=$row_order['invoice_no'];
	$products=$row_order['total_products'];
	$date=$row_order['order_date'];
	$status=$row_order['order_status'];
	if($status=='Pending')
		$order_status='Unpaid';
	else
$order_status='Paid';
$i++;		
	echo "<tr></tr><tr></tr><tr></tr><tr align='center'>
	<td>$i</td>
	<td>$due_amount</td>
	<td>$invoice_no</td>
	<td>$products</td>
	<td>$date</td>
	<td>$order_status</td>
    <td><a href='confirm.php?order_id=$order_id'>Confirm if Paid</a></td>	
	</tr>";
}
?>
</table>
<?php }?>