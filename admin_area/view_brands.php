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
if(isset($_GET['view_brands']))
{
	?>
<br>
<h1><center>View All Brands</center></h1>
<br>
	<table width="794px" align="center" >
	<tr>
	<th>Brand ID</th>
	<th> Brand Title</th>
	<th>Edit</th>
	<th>Delete</th>
	</tr>
	<?php 
	include("includes/db.php");
	$getb="select * from brands";
	$runb=mysqli_query($con,$getb);
	$i=0;
	while($rowb=mysqli_fetch_array($runb))
	{
		$brand_id=$rowb['brand_id'];
		$brand_title=$rowb['brand_title'];
		 $i++;
	?>
	<tr align="center">
	<td><?php echo $i;?></td>
	<td><?php echo $brand_title;?></td>
	 <td><a href="index.php?edit_brand=<?php echo $brand_id;?>">Edit</a></td>
	 <td><a href="delete_brand.php?delete_brand=<?php echo $brand_id;?>">Delete</a></td>
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