<?php
include("includes/db.php");
@session_start();
if(!isset($_SESSION['customer_email']))
echo "<h1>Please Log In to Edit Your Account</h1>";
else
{
$customer_email=$_SESSION['customer_email'];
$getc="select * from customers where customer_email='$customer_email'";
$run_c=mysqli_query($con,$getc);
$row=mysqli_fetch_array($run_c);
$id=$row['customer_id'];
$name=$row['customer_name'];
$email=$row['customer_email'];
$pass=$row['customer_pass'];
$country=$row['customer_country'];
$city=$row['customer_city'];
$contact=$row['customer_contact'];
$address=$row['customer_address'];
$username=$row['customer_username'];
?>
<form action="edit_account.php?update_id=<?php echo $id;?>" method="post" enctype="multipart/form-data">
<h2>Update Your Account</h2>
<br/>
<table align="center" width="1000px">
<tr></tr>
<tr></tr>
<tr>
<td align="right">User_Name : </td>
<td align="left"> <input type="text" maxlength="10" name="c_u_name" value="<?php echo $username;?>"></td>
</tr>
<tr></tr>
<tr>
<td align="right">Full_Name : </td>
<td align="left"> <input type="text" name="c_name" value="<?php echo $name;?>"></td>
</tr>
<tr></tr>
<tr>
<td align="right">E-mail : </td>
<td align="left"> <input type="text" name="c_email" value="<?php echo $email;?>"></td>
</tr>
<tr></tr>
<tr>
<td align="right">Country : </td>
<td align="left"> <input type="text" name="c_country" value="<?php echo $country;?>"></td>
</tr>
<tr></tr>
<tr>
<td align="right">City : </td>
<td align="left"> <input type="text" name="c_city" value="<?php echo $city;?>"></td>
</tr>
<tr></tr>
<tr>
<td align="right">Mobile No : </td>
<td align="left"> <input type="text" name="c_contact" value="<?php echo $contact;?>"></td>
</tr>
<tr></tr>
<tr>
<td align="right">Address : </td>
<td align="left"><input type="text" name="c_address" value="<?php echo $address;?>"></td>
</tr>
<tr></tr>
<tr></tr>
</table>
<br/>
 <input type="submit" name="update_account" value="Update Now">
</form>
<?php
if(isset($_POST['update_account']))
{
	$update_id=$_GET['update_id'];
	$c_u_name=$_POST['c_u_name'];
	$c_name=$_POST['c_name'];
	$c_country=$_POST['c_country'];
	$c_city=$_POST['c_city'];
	$c_contact=$_POST['c_contact'];
	$c_address=$_POST['c_address'];
	$c_email=$_POST['c_email'];
	$update="UPDATE `customers` SET `customer_username`='$c_u_name',`customer_name`='$c_name',`customer_email`='$c_email',`customer_country`='$c_country',`customer_city`='$c_city',`customer_contact`='$c_contact',`customer_address`='$c_address' WHERE customer_id='$update_id'";
	$run_c=mysqli_query($con,$update);
	if($run_c==true)
	{
		echo "<script>alert('Your account has been updated!!Please login again to your account!!')</script>";
		echo "<script>window.open('../logout.php','_self')</script>";
	
		
	}
	else
	{
			echo "<script>alert('Already registered with this e-mail or wrong information!!Account fails to update!!')</script>";
echo "<script>window.open('my_account.php','_self')</script>";
			}
}
?>
<?php }?>