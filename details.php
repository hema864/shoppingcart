<?php 
   include("dbconnect.php");
   session_start();
   if(!isset($_SESSION["name"])){
	  header("Location: login.php");
 }
 $person_id=$_SESSION["id"];
   if(isset($_GET["a"])){
   $product_id=$_GET["a"];
   
   
   $res1=mysqli_query($con,"select * from products where id=$product_id");
   if($res1 ){
	   $res=mysqli_fetch_array($res1);
	   $product_name=$res["name"];
	   $product_cost=$res["cost"];
	   if($res["quantity"]==0){
		   echo "out of stock";
	   }
	   else{
		   
		   
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
		.wrap{
				height:400px;
				background: #313131;
			    margin:10px 5px;
				padding:10px;
			}
			.wrap .danger {
				color:lightgreen;
				padding:10px 1px;
				font-size:20px;
			}
			.wrap .btn{
				
                width: 120px;
                height: 40px;
				line-height:40px;
                color: white;
                text-align: center;
                font-size: 15px;
                font-weight: bold;
                background:orange;
                margin:5px;				
			}
		
        </style>      
		<script>
		   var submit=function(){
			   document.submit.submit();
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
		    <?php
			
			$res=mysqli_query($con," SELECT * FROM products  where id=$product_id");
			if($res){
							
				while($result=mysqli_fetch_array($res)){
				    //var_dump($result);
			
			echo "<div class='col-md-5 wrap' >";
			
				    $pro= $result["photo"];
					$pro_id=$result["id"];
					
					echo "<img src=filetest2.php?a=$pro width=100% height=400px style=''>";
		           
		    echo " </div>";
			echo "<div class='col-md-6 wrap' >";
			
		            echo "<div class='danger'><span style='color:grey'> cost : </span>".$result["cost"]."</div>";
					echo "<form action='cart.php'method='post' ><input type='number' value='1' name='q' min='1' max='3' style='width:40px;margin-bottom:10px;'>";
					echo "<input type='hidden' name='id'value=".$pro_id.">";
					echo "<br>";
					echo "<input type='submit' value='ADD TO CaRT' name='submit' ></form>";
					
		    echo " </div>";
			}
			}
			?>
		 </div>
	   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script> 
  
    </body>
</html>