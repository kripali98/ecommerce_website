
<?php
if(isset($_GET['editq']))
{
	include("includes/db.php");
	$id=$_GET['editq'];
	
?>
<form action="" method="post">
<input type="text" name="qty1" placeholder="Enter Quantity"/>
<input type="submit" name="submit" value="Update Quantity"/>
</form>
<?php
if(isset($_POST['submit']))
{
	$q=$_POST['qty1'];
	$update="update cart set qty='$q' where p_id='$id'";
	$run=mysqli_query($con,$update);
	echo "<script>alert('Quantity updated')</script>";
	echo "<script>window.open('cart.php','_self')</script>";
}
}?>