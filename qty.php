<?php
	if(isset($_POST['m']))
	{
		$qty=$_POST["m"];
		$p_id=$_GET['pro_id'];
		$insert="update cart set qty='$qty' where p_id='$p_id'";
		$runq=mysqli_query($con,$insert);
		$total=$total*$qty;
		if($runq)
			{
				echo "<script>window.open('cart.php','_self')</script>";
			}
		
	}
	?>