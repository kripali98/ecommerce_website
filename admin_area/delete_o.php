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
if(isset($_GET['delete_o']))
{
	$id=$_GET['delete_o'];
	$query="delete from customer_orders where order_id='$id'";
	$run=mysqli_query($con,$query);
	if($run)
	{
		
		echo "<script>alert('1 order deleted successfully!!')</script>";
		echo "<script>window.open('index.php?view_orders','_self')</script>";
	}
}
}

?>
		