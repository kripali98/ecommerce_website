<?php
include("includes/db.php");
function getRealIPAddress()
{
	if (!empty($_SERVER["HTTP_CLIENT_IP"]))
{
//check for ip from share internet
$ip = $_SERVER["HTTP_CLIENT_IP"];
}
elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
{
// Check for the Proxy User
$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
}
else
{
$ip = $_SERVER["REMOTE_ADDR"];
}
return $ip;
}
@session_start();
?>
<div>
<form method="post" action="checkout.php">
<h1>Login</h1>
<br>
<table width="1000px" align="center">
<tr><td  align="right"><b>Email : </b></td><td align="left"><input type="text" name="c_email"></td></tr>
<tr></tr><tr></tr>
<tr><td  align="right"><b>Password : </b></td><td align="left"><input type="password" name="c_pass"></td></tr>
</table>
<br>
<a href="checkout.php?forgot_pass">Forgot Password</a>
<br><br><input type="submit" value="Login" name="c_login">
<br><br>
<a href="customer_register.php"><h2>Register Here</h2></a>
</table>
</form>
<?php
if(isset($_GET['forgot_pass']))
{
echo "
<br>
<div align='center'>
<b>Enter your e-mail and we'll send your password to your e-mail</b><br><br>
<form action='' method='post'>
<input type='text' name='mail' placeholder='Enter your e-mail' required/><br><br>
<input type='submit' name='forgot_pass' value='Send Password'/>
</form>
</div>
";
if(isset($_POST['forgot_pass']))
{
$mail=$_POST['mail'];
$sel="select * from customers where customer_email='$mail'";
$run=mysqli_query($con,$sel);
$check=mysqli_num_rows($run);
$row=mysqli_fetch_array($run);
$pass=$row['customer_pass'];
$name=$row['customer_name'];
if($check==0)

{
	echo "<script>alert('This e-mail has not been registered.....Please try again!!')</script>";
exit();
}
else
{
$from='www.goshop.com';
$subject='Your Password';
$message=
"Dear $name ,
You requested for your password at www.goshop.com
Your Password is $pass 
Thank you for using our website!!";
mail($mail,$subject,$message,$from);
echo "<script>alert('Password is sent to your e-mail....Please check your inbox !!')</script>";
echo "<script>window.open('checkout.php','_self')</script>";
}
}
}

?>
</div>
<?php
if(isset($_POST['c_login']))
{
	$user=$_POST['c_email'];
	$pass=$_POST['c_pass'];
	$query="select * from customers where customer_email='$user' and customer_pass='$pass'";
	$runc=mysqli_query($con,$query);
	$checkcust=mysqli_num_rows($runc);
	$selc="select * from cart where email='$user'";
	$runcart=mysqli_query($con,$selc);
	$checkcart=mysqli_num_rows($runcart);
	if($checkcust==0)
	{
		echo "<script>window.alert('Wrong e-mail or password!!!!Try again')</script";
	}
	else if($checkcust==1 and $checkcart==0)
	{
		$_SESSION['customer_email']=$user;
		echo "<script>window.open('customer/my_account.php','_self')</script>";
	}
	else
	{
		$_SESSION['customer_email']=$user;
		echo "<script>window.alert('You are logged in successfully!!!! You can order now')</script>";
	    echo "<script>window.open('checkout.php','_self')</script>";
		//include("payment_options.php");
	}
	
}
?>