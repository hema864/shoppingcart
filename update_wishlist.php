<?php 
  include("dbconnect.php");
  session_start();
  if(!isset($_SESSION["name"])){
	  header("Location: login.php");
 }
  $product_id=$_GET["a"];
  $person_id=$_SESSION["id"];
  $res=mysqli_query($con,"DELETE from wishlist  where product_id=$product_id AND person_id=$person_id ");
  header("Location:wishlist.php");
?>