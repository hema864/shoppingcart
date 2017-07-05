<?php 
   include("dbconnect.php");
   session_start();
   if(!isset($_SESSION["name"])){
	  header("Location: login.php");
 }
 $person_id=$_SESSION["id"];
   if(isset($_GET["a"])){
   $product_id=$_GET["a"];
   
   
   $res1=mysqli_query($con,"select * from wishlist e where e.product_id=$product_id and e.person_id=$person_id");
   if($res1 ){
	   if(mysqli_num_rows($res1)>0){
		  
	   }
	   else{
	       $res=mysqli_query($con,"insert into wishlist(product_id,person_id) values('$product_id','$person_id')");	   
	   }
   }
   }
?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta name="veiwport" content="width:device-width">
        <meta charset="UTF-8">
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css">  
        <style>
        </style>      
    </head>
    <body>
	
	 <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">flipzon</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="home.php">Home <span class="sr-only">(current)</span></a></li>
        
        </ul>
    <!-----    <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Courses <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      ---->
      <ul class="nav navbar-nav navbar-right">
        <li><a href="update.php"><?php echo $_SESSION["name"] ; ?></a></li>
        <li >
          <a href="wishlist.php"  >wishlist</a>    
        </li>
		<li >
          <a href="cart.php"  >cart</a>    
        </li>
		<li >
          <a href="logout.php" class="dropdown-toggle"  >logout</a>    
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
	
	<div class="container-fluid div1 ">
    <div class="products" >
		    <?php
			
			$res=mysqli_query($con," SELECT * FROM products p,wishlist e where e.product_id=p.id and e.person_id=$person_id");
			if($res){
							
				while($result=mysqli_fetch_array($res)){
				    //var_dump($result);
			
			echo "<div class='col-md-3 wrap' >";
			
				    $pro= $result["photo"];
					$pro_id=$result["id"];
					
					echo "<img src=filetest2.php?a=$pro width=80% height=250px>";
		            echo "<div class='danger'><span style='color:grey'> cost : </span>".$result["cost"]."</div>";
					echo "<a href='details.php?a=$pro_id' class='btn' >details</a>";
					echo "<a href='update_wishlist.php?a=$pro_id' class='btn' >Remove</a>";
		    echo " </div>";
			}
			}
			?>
		 </div>
	
</div>
       
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script> 
   
    </body>
</html>

