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
	<h2>Insert New Category</h2>
	<br/>
	<input type="text" name="cat_title"/>
	<br/>
	<br>
	<input type="submit" name="insert_cat" value="Insert Category"/>
	</form>
	<?php
	include("includes/db.php");
	if(isset($_POST['insert_cat']))
	{
		$cat_title=$_POST['cat_title'];
		$insert_cat="INSERT INTO `categories`(`cat_title`) VALUES ('$cat_title')";
		$run=mysqli_query($con,$insert_cat);
		if($run)
		{
			echo "<script>alert('New Category has been added')</script>";
			echo "<script>window.open('index.php?view_cats','_self')</script>";
		}
	}
	
	?>
</body>
</html>
<?php
}
?>