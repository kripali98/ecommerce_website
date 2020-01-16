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
if(isset($_GET['delete_cat']))
{
	$id=$_GET['delete_cat'];
	$queryc="delete from categories where cat_id='$id'";
	$runc=mysqli_query($con,$queryc);
	if($runc)
	{
		
		echo "<script>alert('1 category deleted successfully!!')</script>";
		echo "<script>window.open('index.php?view_cats','_self')</script>";
	}
}
}
?>
		