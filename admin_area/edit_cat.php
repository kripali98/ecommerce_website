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
if(isset($_GET['edit_cat']))
{
	$edit_id=$_GET['edit_cat'];
	$get_edit="select * from categories where cat_id='$edit_id'";
	$rune=mysqli_query($con,$get_edit);
	$row=mysqli_fetch_array($rune);
	$update_id=$row['cat_id'];
	$cat_title=$row['cat_title'];
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
	<h2>Update Category</h2>
	<br/>
	<input type="text" value="<?php echo $cat_title;?>" name="cat_title"/>
	<br/>
	<br>
	<input type="submit" name="update_cat" value="Update Category"/>
	</form>
</body>
</html>
<?php
if(isset($_POST['update_cat']))
{
	$cat_title=$_POST['cat_title'];
		$pr_query="UPDATE `categories` SET `cat_title`='$cat_title' WHERE cat_id='$update_id'";
		$run=mysqli_query($con,$pr_query);
		if($run)
		{
			echo "<script>alert('category has been updated successfully!!')</script>";
			echo "<script>window.open('index.php?view_cats','_self')</script>";
		}
		else
		{
			echo "<script>alert('error')</script>";
		}
	}
}
	?>