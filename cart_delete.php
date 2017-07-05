<?php
include("dbconnect.php");
   session_start();
   if(!isset($_SESSION["name"])){
	  header("Location: login.php");
 }
 echo $_GET["a"];
 if(isset($_GET["a"])){
	 $person_id=$_SESSION["id"];
 $product_id=$_GET["a"];
 
 mysqli_query($con,"DELETE from cart where product_id=$product_id and person_id=$person_id");
 header("Location:cart.php");
 }
 //header("Location:cart.php");
 ?>
