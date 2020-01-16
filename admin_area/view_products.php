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
if(isset($_GET['view_products']))
{
	?>
<br>
<h1><center>View All Products</center></h1>
<br>
	<table width="794px" align="center" >
	<tr>
	<th>Product ID</th>
	<th>Title</th>
	<th>Image</th>
	<th>Price</th>
	<th>Total Sold</th>
	<th>Status</th>
	<th>Edit</th>
	<th>Delete</th>
	</tr>
	<?php 
	include("includes/db.php");
	$getpro="select * from product";
	$runpro=mysqli_query($con,$getpro);
	$i=0;
	while($row=mysqli_fetch_array($runpro))
	{
		$p_id=$row['product_id'];
		$p_title=$row['product_title'];
		$p_price=$row['product_price'];
	     $p_img=$row['product_img1'];
		 $status=$row['status'];
		 $i++;
		 $qty=0;
	 $get="select * from sp where pro_id='$p_id'";
	 $run=mysqli_query($con,$get);
	 while($r=mysqli_fetch_array($run))
	 {
		 $qty=$qty+$r['qty'];
	 }
	?>
	<tr align="center">
	<td><?php echo $i;?></td>
	<td><?php echo $p_title;?></td>
	<td><img src="product_images/<?php echo "$p_img";?>" height="80" width="80" /></td>
     <td>&#8377;<?php echo $p_price;?></td>
	 <td>
	 <?php
	 echo $qty;
	 ?>
	 </td>
	 <td>
	 <?php 
	echo $status; ?>
	 </td>
	 <td><a href="index.php?edit_pro=<?php echo $p_id;?>">Edit</a></td>
	 <td><a href="delete_pro.php?delete_pro=<?php echo $p_id;?>">Delete</a></td>
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