<?php 
    include('dbconnect.php');
	$email=mysql_escape_string( $_GET["email"]);
	$hash=mysql_escape_string($_GET["hash"]);
	$search=mysqli_query($con,"select * from customers where email=$email AND hash=$hash AND active=0");
	$num=mysqli_num_rows($search);
	if($num>0){
		$query=mysqli_query($con,"update customers SET active=1 where email=$email");
		echo "thanks for registrations .you can login now using your credentials";
		
	}
	else{
		
	}
?>