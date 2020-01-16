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
if(isset($_GET['edit_brand']))
{
	$edit_id=$_GET['edit_brand'];
	$get_edit="select * from brands where brand_id='$edit_id'";
	$rune=mysqli_query($con,$get_edit);
	$row=mysqli_fetch_array($rune);
	$update_id=$row['brand_id'];
	$brand_title=$row['brand_title'];
	}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin Area</title>
	</head>
<body>
	<form action="" method="post" align="center" style="padding:70px">
	<h2>Update Brand</h2>
	<br/>
	<input type="text" value="<?php echo $brand_title;?>" name="brand_title"/>
	<br/>
	<br>
	<input type="submit" name="update_b" value="Update Brand"/>
	</form>
</body>
</html>
<?php
if(isset($_POST['update_b']))
{
	$brand_title=$_POST['brand_title'];
		$pr_query="UPDATE `brands` SET `brand_title`='$brand_title' WHERE brand_id='$update_id'";
		$run=mysqli_query($con,$pr_query);
		if($run)
		{
			echo "<script>alert('brand has been updated successfully!!')</script>";
			echo "<script>window.open('index.php?view_brands','_self')</script>";
		}
		else
		{
			echo "<script>alert('error')</script>";
		}
	}
}
	?>