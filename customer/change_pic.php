<?php @session_start();
 if(!isset($_SESSION['customer_email']))
echo "<h1>Please Log In to Change Your Photo</h1>";
else
{?>
<?php
$customer_email=$_SESSION['customer_email'];
$getc="select * from customers where customer_email='$customer_email'";
$run_c=mysqli_query($con,$getc);
$row=mysqli_fetch_array($run_c);
$image=$row['customer_image'];
?>
<form method="post" action="" enctype="multipart/form-data">
<h2>Change Photo</h2>
<br/>
<br/>
<img src="../customer_photos/<?php echo $image;?>" height="100" width="auto">
<br/>
<br/>
<input type="file" name="c_image" value="<?php echo $image;?>" required>
<br/>
<br/>
<input type="submit" name="change_pic" value="Change Photo">

</form>
<?php
include("includes/db.php");
$c=$_SESSION['customer_email'];
if(isset($_POST['change_pic']))
{
	$c_image=$_FILES['c_image']['name'];
	$c_image_tmp=$_FILES['c_image']['tmp_name'];
	$update="UPDATE `customers` SET `customer_image`='$c_image' WHERE customer_email='$c'";
	$run_c=mysqli_query($con,$update);
	if($run_c==true)
	{
		move_uploaded_file($c_image_tmp,"../customer_photos/$c_image");
		echo "<script>alert('Your profile photo has been updated!!')</script>";
		echo "<script>window.open('my_account.php','_self')</script>";
	
		
	}
}
}?>