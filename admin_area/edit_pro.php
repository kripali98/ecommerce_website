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
if(isset($_GET['edit_pro']))
{
	$edit_id=$_GET['edit_pro'];
	$get_edit="select * from product where product_id='$edit_id'";
	$rune=mysqli_query($con,$get_edit);
	$row=mysqli_fetch_array($rune);
	$update_id=$row['product_id'];
	$p_title=$row['product_title'];
	$cat_id=$row['cat_id'];
	$brand_id=$row['brand_id'];
	$p_image1=$row['product_img1'];
	$p_image2=$row['product_img2'];
	$p_image3=$row['product_img3'];
	$p_price=$row['product_price'];
	$p_desc=$row['product_desc'];
	$p_keywords=$row['product_keywords'];
}
$getc="select * from categories where cat_id='$cat_id'";
$runc=mysqli_query($con,$getc);
$rowc=mysqli_fetch_array($runc);
$cat_title=$rowc['cat_title'];
$getb="select * from brands where brand_id='$brand_id'";
$runb=mysqli_query($con,$getb);
$rowb=mysqli_fetch_array($runb);
$brand_title=$rowb['brand_title'];
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin Area</title>
	<!--<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>-->
   <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
  </head>
<body bgcolor="#D7BDE2">
	<form method="post" action="" enctype="multipart/form-data">
<table width="794px" align="center" border="1" bgcolor="#EBDEF0">
<tr align="center"><td colspan="2"><h1><font color="#361051">Update Product</font></h1></td></tr>
<tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<td align="right">Product title</td>
<td><input type="text" name="product_title" value="<?php echo $p_title;?>" size="40" cols="60"/></td>
 </tr>
 <tr></tr>
 <tr></tr>
 <td align="right">Product Category</td>
<td>
<select name="product_cat">
<option value="<?php echo $cat_id;?>"><?php echo $cat_title;?></option>
<?php
	$c_query="Select * from categories";
	$c_run=mysqli_query($con,$c_query);
	while($get=mysqli_fetch_array($c_run))
	{
		$id=$get['cat_id'];
		$title=$get['cat_title'];
	echo "<option value='$id'>$title</option>";
	}
	?>
</select>
</td>
 </tr>
 <tr></tr>
 <tr></tr>
<tr>
<td align="right">Product Brand</td>
<td>
<select name="product_brand">
<option value="<?php echo $brand_id;?>"><?php echo $brand_title;?></option>
<?php
	$p_query="Select * from brands";
	$p_run=mysqli_query($con,$p_query);
	while($get=mysqli_fetch_array($p_run))
	{
		$brand_id=$get['brand_id'];
		$brand_title=$get['brand_title'];
	echo "<option value='$brand_id'>$brand_title</option>";
	}
	?>
</select>
</td>
 </tr>
 <tr></tr>
 <tr></tr>
 <tr>
<td align="right">Product Image1</td>
<td><input type="file" name="product_img1" required /><br>
<img src="product_images/<?php echo $p_image1;?>" height="80" width="80" style="border:1px solid black;"></td>
 </tr>
 <tr></tr>
 <tr></tr>
 <tr>
<td align="right">Product Image2</td>
<td><input type="file" name="product_img2" required /><br>
<img src="product_images/<?php echo $p_image2;?>" height="80" width="80" style="border:1px solid black;"></td>
 </tr>
 <tr></tr>
 <tr></tr>
 <tr>
<td align="right">Product Image3</td>
<td><input type="file" name="product_img3" required /><br>
<img src="product_images/<?php echo $p_image3;?>" height="80" width="80" style="border:1px solid black;"></td>
 </tr>
 <tr></tr>
 <tr></tr>
 <tr>
<td align="right">Product Price</td>
<td><input type="text" name="product_price" value="<?php echo $p_price;?>"/></td>
 </tr>
 <tr></tr>
 <tr></tr>
 <tr>
<td align="right">Product Description</td>
<td><textarea name="product_desc" rows="20" cols="50" ><?php echo $p_desc;?></textarea></td>
 </tr>
 <tr></tr>
 <tr></tr>
 <tr>
<td align="right">Product Keywords</td>
<td><input type="text" name="product_keyword" cols="50" size="80" value="<?php echo $p_keywords;?>"/></td>
 </tr>
 <tr></tr>
 <tr></tr>
 <tr align="center">
<td colspan="2"><input type="submit" name="update_product" value="Update Product"/></td>
 </tr>
</table>
	</form>
</body>
</html>
<?php
if(isset($_POST['update_product']))
{
	$product_title=$_POST['product_title'];
	$product_cat=$_POST['product_cat'];
	$product_brand=$_POST['product_brand'];
	$product_desc=mysqli_real_escape_string($con, $_POST['product_desc']);
	$product_price=$_POST['product_price'];
	$status='on';
	$product_keyword=$_POST['product_keyword'];
	//image names
	$product_img1=$_FILES['product_img1']['name'];
	$product_img2=$_FILES['product_img2']['name'];
	$product_img3=$_FILES['product_img3']['name'];
	//temp name
	$tempname1=$_FILES['product_img1']['tmp_name'];
	$tempname2=$_FILES['product_img2']['tmp_name'];
	$tempname3=$_FILES['product_img3']['tmp_name'];
		move_uploaded_file($tempname1,"product_images/$product_img1");
		move_uploaded_file($tempname2,"product_images/$product_img2");
		move_uploaded_file($tempname3,"product_images/$product_img3");
		$pr_query="UPDATE `product` SET `cat_id`='$product_cat',`brand_id`='$product_brand',`date`=NOW(),`product_title`='$product_title',`product_img1`='$product_img1',`product_img2`='$product_img2',`product_img3`='$product_img3',`product_price`='$product_price',`product_desc`='$product_desc',`product_keywords`='$product_keyword' WHERE product_id='$update_id'";
		$run=mysqli_query($con,$pr_query);
		if($run)
		{
			echo "<script>alert('product updated successfully!!')</script>";
			echo "<script>window.open('index.php?view_products','_self')</script>";
		}
		else
		{
			echo "<script>alert('error')</script>";
		}
	}
}
	?>