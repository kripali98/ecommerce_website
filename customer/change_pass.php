<?php @session_start();
 if(!isset($_SESSION['customer_email']))
echo "<h1>Please Log In to Change Your Password</h1>";
else
{?>
<form method="post" action="">
<table width="750" align="center">
<tr align="center">
<td colspan="2"><h2>Change Password</h2></td>
</tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr>
<td align="right">Enter Current Password : </td>
<td align="left"><input type="password" name="old_pass" ></td>
</tr>
<tr></tr>
<tr></tr>
<tr>
<td align="right">Enter New Password : </td>
<td align="left"><input type="password" name="new_pass" ></td>
</tr>
<tr></tr>
<tr></tr>
<tr>
<td align="right">Confirm Password : </td>
<td align="left"><input type="password" name="new_pass_again" ></td>
</tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr align="center">
<td colspan="2"><input type="submit" name="change_pass" value="Change Password"></td>
</tr>
</table>
</form>
<?php
include("includes/db.php");
$c=$_SESSION['customer_email'];
if(isset($_POST['change_pass']))
{
	$old_pass=$_POST['old_pass'];
	$new_pass=$_POST['new_pass'];
	$new_pass_again=$_POST['new_pass_again'];
	$get="select * from customers where customer_pass='$old_pass' and customer_email='$c'";
	$run=mysqli_query($con,$get);
	if(mysqli_num_rows($run)==0)
	{
		echo "<script>alert('Invalid current password!!Try Again')</script>";
		exit();
	}
	if($new_pass!=$new_pass_again)
	{
			echo "<script>alert('New password did not match!!Try Again')</script>";
			exit();
	}
	else
	{
		$update_pass="update customers set customer_pass='$new_pass' where customer_email='$c'";
		$runc=mysqli_query($con,$update_pass);
		if($runc)
		{
			echo "<script>alert('Your password has been updated successfully')</script>";
			echo "<script>window.open('my_account.php','_self')</script>";
	}
	else
	{
		echo "<script>alert('Password not changed!!')</script>";
	}
	}
}
}?>