<?php
include("dbconnect.php");
   session_start();
   if(!isset($_SESSION["name"])){
	  header("Location: login.php");
 }
 if(isset($_POST["quantity"])){
	 $person_id=$_SESSION["id"];
 $product_id=$_POST["id"];
 $q=$_POST["quantity"];
 $c=$_POST["cost"];
 if($q>0 && $q<=3){
 mysqli_query($con,"update cart set quantity=$q where product_id=$product_id and person_id=$person_id");
 }
 elseif($q>3){
	 $error=3;
 }
 else{
	 $error=0;
 }
 header("Location:cart.php?error=$error");
 }

 ?>
