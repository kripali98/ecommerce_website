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
	<style>
	table,img
	{
		border:1px solid black;
	}
	tr,th ,td
	{
		border:1px groove black;
	}
	</style>
</head>
<body>
<?php
if(isset($_GET['view_cats']))
{
	?>
<br>
<h1><center>View All Categories</center></h1>
<br>
	<table width="794px" align="center" >
	<tr>
	<th>Category ID</th>
	<th> Category Title</th>
	<th>Edit</th>
	<th>Delete</th>
	</tr>
	<?php 
	include("includes/db.php");
	$getcat="select * from categories";
	$runcat=mysqli_query($con,$getcat);
	$i=0;
	while($rowcat=mysqli_fetch_array($runcat))
	{
		$cat_id=$rowcat['cat_id'];
		$cat_title=$rowcat['cat_title'];
		 $i++;
	?>
	<tr align="center">
	<td><?php echo $i;?></td>
	<td><?php echo $cat_title;?></td>
	 <td><a href="index.php?edit_cat=<?php echo $cat_id;?>">Edit</a></td>
	 <td><a href="delete_cat.php?delete_cat=<?php echo $cat_id;?>">Delete</a></td>
	 </tr>
	<?php }?>
	</table>
	<?php
}
?>
</body>
</html>
<?php
}
?>