<?php @session_start();
 if(!isset($_SESSION['customer_email']))
echo "<h1>Please Log In to Delete Your Account</h1>";
else
{?>
<form method="post" action="">
<table width="750" align="center">
<tr align="center">
<td colspan="2"><h2>Do you really want to delete your account?</h2></td>
</tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr align="center">
<td><input type="submit" name="yes" value="Yes,I want to delete my account">
<input type="submit" name="no" value="No,I don't want to delete my account"></td>
</tr>
</table>
</form>
<?php
include("includes/db.php");
$c=$_SESSION['customer_email'];
if(isset($_POST['yes']))
{
	$get="delete from customers where customer_email='$c'";
	$run=mysqli_query($con,$get);
	if($run)
	{
		echo "<script>alert('Your account is deleted!!GoodBye!!')</script>";
		echo "<script>window.open('logout.php','_self')</script>";
	}
	else
	{
		echo "<script>alert('Account could not be deleted!!')</script>";
	}
	}
	if(isset($_POST['no']))
{
		echo "<script>window.open('my_account.php','_self')</script>";
}

}

?>