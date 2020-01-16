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
if(isset($_GET['delete_pro']))
{
	$id=$_GET['delete_pro'];
	$query="delete from product where product_id='$id'";
	$run=mysqli_query($con,$query);
	if($run)
	{
		$queryc="delete from cart where p_id='$id'";
	$runc=mysqli_query($con,$queryc);
		echo "<script>alert('1 product deleted successfully!!')</script>";
		echo "<script>window.open('index.php?view_products','_self')</script>";
	}
}
}
?>
		