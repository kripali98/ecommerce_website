<?php
include("includes/db.php");
session_start();
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Log In</title>
	<link rel="stylesheet" href="login.css" media="all">
</head>
<body>
	
	<div class="login">
	<h1>Admin Login</h1>
    <form method="post">
    	<input type="text" name="admin_email" placeholder="Username" required="required" />
        <input type="password" name="admin_pass" placeholder="Password" required="required" />
        <button type="submit" name="submit" class="btn btn-primary btn-block btn-large">Log In</button>
    </form>
</div>
<h2 style="color:white;text-align:center;padding:40px"><?php echo @$_GET['logout'];?></h2>
</body>
</html>
<?php
if(isset($_POST['submit']))
{
	$email=$_POST['admin_email'];
	$pass=$_POST['admin_pass'];
	$get="select * from admin_login where email='$email' and pass='$pass'";
	$run=mysqli_query($con,$get);
	if(mysqli_num_rows($run)==1)
	{
		$_SESSION['admin_email']=$email;
		echo "<script>window.open('index.php?logged_in=You are successfully logged in!!','_self')</script>";
	}
	else
	{
		echo "<script>alert('Wrong email-id or password')</script>";
	}
}
?>