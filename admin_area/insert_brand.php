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
</head>
<body>
	<form action="" method="post" align="center" style="padding:70px">
	<h2>Insert New Brand</h2>
	<br/>
	<input type="text" name="brand_title"/>
	<br/>
	<br>
	<input type="submit" name="insert_brand" value="Insert Brand"/>
	</form>
	<?php
	include("includes/db.php");
	if(isset($_POST['insert_brand']))
	{
		$brand_title=$_POST['brand_title'];
		$insert_b="INSERT INTO `brands`(`brand_title`) VALUES ('$brand_title')";
		$run=mysqli_query($con,$insert_b);
		if($run)
		{
			echo "<script>alert('New Brand has been added')</script>";
			echo "<script>window.open('index.php?view_brands','_self')</script>";
		}
	}
	
	?>
</body>
</html>
<?php
}
?>