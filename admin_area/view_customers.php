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
if(isset($_GET['view_customers']))
{
	?>
<br>
<h1><center>View All Customers</center></h1>
<br>
	<table width="794px" align="center" >
	<tr>
	<th>S.No</th>
	<th>Name</th>
	<th>Image</th>
	<th>E-mail</th>
	<th>Country</th>
	<th>Delete</th>
	</tr>
	<?php 
	include("includes/db.php");
	$getc="select * from customers";
	$runc=mysqli_query($con,$getc);
	$i=0;
	while($row=mysqli_fetch_array($runc))
	{
		$customer_id=$row['customer_id'];
		$customer_name=$row['customer_name'];
		$customer_image=$row['customer_image'];
		$customer_email=$row['customer_email'];
		$customer_country=$row['customer_country'];
		 $i++;
		 
	?>
	<tr align="center">
	<td><?php echo $i;?></td>
	<td><?php echo $customer_name;?></td>
	<td><img src="../customer_photos/<?php echo "$customer_image";?>" height="100" width="100" /></td>
     <td><?php echo $customer_email;?></td>
	 <td>
	 <?php
	 echo $customer_country;
	 ?>
	 </td>
	 <td><a href="delete_c.php?delete_c=<?php echo $customer_id;?>">Delete</a></td>
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