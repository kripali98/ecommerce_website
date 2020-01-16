<?php
@session_start();
if(!isset($_SESSION['admin_email']))
{
	echo "<script>window.open('login.php','_self')</script>";
}
else
{
?>
<?php
include("includes/db.php");
if(isset($_GET['delete_c']))
{
	$id=$_GET['delete_c'];
	$query="delete from customers where customer_id='$id'";
	$run=mysqli_query($con,$query);
	if($run)
	{
		$queryc="delete from customer_orders where customer_id='$id'";
	$runc=mysqli_query($con,$queryc);
		echo "<script>alert('1 customer deleted successfully!!')</script>";
		echo "<script>window.open('index.php?view_customers','_self')</script>";
	}
}
}
?>
		