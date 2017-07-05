<?php 
  include("dbconnect.php");
  session_start();
  if(!isset($_SESSION["name"])){
	  header("Location: login.php");
 }
 $person_id=$_SESSION["id"];
   if(isset($_POST["submit"])){
   $product_id=$_POST["id"];
   $quantity=$_POST["q"];
   
   
   $res1=mysqli_query($con,"select * from cart e where e.product_id=$product_id and e.person_id=$person_id");
   if($res1 ){
	   if(mysqli_num_rows($res1)>0){
		  $num=mysqli_fetch_array($res1);
		  if($quantity+$num["quantity"]<=3){
			  $quantity=$num["quantity"]+$quantity;
			  $error="";
			  
			  mysqli_query($con,"update cart set quantity='$quantity' where product_id='$product_id' and person_id='$person_id'");
		  }
		  else
		  {
			  $quantity=3;
			  $error="quanti";
			 // echo $error;
			   mysqli_query($con,"update cart set quantity='$quantity' where product_id='$product_id' and person_id='$person_id'");
			   
		  }
	   }
	   else{
		   if($quantity<=3){
	       $res=mysqli_query($con,"insert into cart(product_id,person_id,quantity) values('$product_id','$person_id','$quantity')");	   
		   }
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
		
		 .msg{
			 color:white;
			 background:#1fa;
			 padding:10px 5px;
			 font-size:17px;
			 font-weight:bold;
			 margin:10px 0px;;
		 }
		 nav{
			 border:1px solid red;
			 margin-bottom:0px;
		 }
        </style>      
		<script>
		  var change=function(c,q){
			  var x=c*q;
			 // document.write(c);
			  document.write(x);
		  }
		  
		  var submit1=function(el){
			  var x="form"+el;
			  document.getElementById(x).submit();
		  }
		   
		</script>
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
     
      <div class="products" >
	       <div class="msg">
		       <?php
			  // echo $_GET[$error];
			   //  if(isset($error)){
					//if($_==3){
					  //echo "more than 3 products are not allowed";
					//}//}
					  //else if($_GET["error"]==0){
						//  echo "minimum one product should be maintained";
		 
				//  }
			   ?>
		   </div>
		    <?php
			
			
			$res=mysqli_query($con," SELECT * FROM products p,cart e where e.product_id=p.id and e.person_id=$person_id");
			if($res&&mysqli_num_rows($res)>0){
					$total=0;	$no_of_items=0;	
				while($result=mysqli_fetch_array($res)){
				    //var_dump($result);
			
			echo "<div class='col-md-2 wrap' >";
			
				    $pro= $result["photo"];
					$pro_id=$result["id"];
					$quantity=$result["quantity"];
					$cost=$result['cost'];
					if($quantity>0){
					$total=$total+$cost*$quantity;
					$no_of_items++;
					
					
					echo "<img src=filetest2.php?a=$pro width=100% height=200px>";
		             echo "<div class='danger'id='cost'><span style='color:grey'>cost : </span>$cost</div>";
					echo "<div class='danger'id='cost'><span style='color:grey'>total cost : </span><script>change($cost,$quantity)</script></div>";
					echo "<form action='update_cart.php' method='post' id='form".$pro_id."' name='form'><input type='number' value='$quantity' min='1' max='3' name='quantity' onchange='submit1($pro_id)'><input type='hidden'value='$pro_id' name='id'><input type='hidden'value='$cost' name='cost'></form>";
					echo "<a href='cart_delete.php?a=$pro_id 'class='btn' >Remove</a>";
					echo "<a href='home.php'class='btn' >continue shopping</a>";
		    echo " </div>";
					}
					else{
						mysqli_query($con,"DELETE from cart where quantity=0");
						header("refresh");
					}
			
			}
			  echo "<div >total value : $total</div>";
			  echo "<div >no of items: $no_of_items</div>";
			}
			?>
		 </div>	 
	 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script> 
  
    </body>
</html>