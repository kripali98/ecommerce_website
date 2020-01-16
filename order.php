<?php
include("includes/db.php");
include("functions/function.php");
if(isset($_GET['c_id']))
{
	$customer_id=$_GET['c_id'];
	$sel="select * from customers where customer_id='$customer_id'";
	$q1=mysqli_query($con,$sel);
	$row=mysqli_fetch_array($q1);
	$email=$row['customer_email'];
}
	$total=0;
	$totalquant=0;
	$qry="select * from cart where email='$email'";
     $run1=mysqli_query($db_con,$qry);
	 $status='Pending';
	 $invoice_no=mt_rand();
	 $count_pro=mysqli_num_rows($run1);
	 while($record=mysqli_fetch_array($run1))
	 {
	
		 $qty=$record['qty'];
		 if($qty==0)
			 $qty=1;
		 $totalquant=$totalquant+$qty;
		 $pro_id=$record['p_id'];
		   $inserts="INSERT INTO `sp`(`pro_id`, `qty`) VALUES ('$pro_id','$qty')";
			  $runs=mysqli_query($con,$inserts);  
		 $pro_price="select * from product where product_id='$pro_id'";
		 $run2=mysqli_query($db_con,$pro_price);
		 while($p_price=mysqli_fetch_array($run2))
		 {
			 $t_price=$p_price['product_price']*$qty;
			 $product_price=array($t_price);
			 $values=array_sum($product_price);
			 $total+=$values;
		 }
		 
	}
	$insertp="INSERT INTO `customer_orders`(`customer_id`, `due_amount`, `invoice_no`, `total_products`, `order_date`, `order_status`)
	VALUES('$customer_id','$total','$invoice_no','$count_pro',NOW(),'$status')";
      $runp=mysqli_query($con,$insertp);
	  if($runp)
	  {
		  echo "<script>alert('Order is placed successfully!!!!Please check your e-mail for the invoice....Thanks!!')</script>";
		  echo "<script>window.open('customer/my_account.php','_self')</script>";
		  $emptyp="delete from cart where email='$email'";
		  $rp=mysqli_query($con,$emptyp);
		  $getp="select * from customer_orders where customer_id='$customer_id' and invoice_no='$invoice_no'";
		  $run4=mysqli_query($con,$getp);
		  $order_id1=mysqli_fetch_array($run4);
		  $order_id=$order_id1['order_id'];
		  $insert="INSERT INTO `pending_orders`(`customer_id`, `invoice_no`, `order_id`, `qty`, `order_status`) 
		                                      VALUES ('$customer_id','$invoice_no','$order_id','$totalquant','$status')";
			$runpe=mysqli_query($con,$insert);
			$r="select * from customer_orders where invoice no='$invoice_no'";
			$run=mysqli_query($con,$r);
			$row=mysqli_fetch_row($run);
			$date=$row['order_date'];
			$from="goshopgo.000webhostapp.com";
			$subject="Your Order";
			$message="
			Invoice Generated:
			Invoice No : $invoice_no
			Total Products Ordered : $count_pro
			Amount : $total
			Thank You for placing order.....
			Continue Shopping on goshopgo.000webhostapp.com";
			mail($email,$subject,$message,$from);
			
	  }
	  else
	  {
		  echo "<script>alert('Sorry!!Order could not be placed')</script>";
	  }
	  ?>