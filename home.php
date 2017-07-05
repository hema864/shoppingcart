<!DOCTYPE HTML>
<?php 
 session_start();
 if(!isset($_SESSION["name"])){
	  header("Location: login.php");
 }
 include("dbconnect.php");

?>
<html lang="en" ng-app="home">
    <head>
        <meta name="veiwport" content="width:device-width">
        <meta charset="UTF-8">
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css">  
        <style>
            .div1{
                
				
				
                
                margin: 5px;
                position: relative;
                color: wheat;
            }
             .class1{
                position: relative;
            }
            
           
            .content{
                height: 400px;
            }
			.wrap{
				height:500px;
				background: #313131;
			    margin:10px 5px;
				padding:10px;
			}
			.wrap .danger {
				color:lightgreen;
				padding:10px;
				font-size:20px;
			}
			.wrap .btn{
				padding: 0px;
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
		    
			
		</script>
		<script src="angular.min.js"></script>
        <script src="home.js"></script>
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
      <a class="navbar-brand" href="home.php">flipzon</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="home.php">Home <span class="sr-only">(current)</span></a></li>
        
        </ul>
   
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
			
			$res=mysqli_query($con," SELECT * FROM products");
			if($res){
							
				while($result=mysqli_fetch_array($res)){
				    //var_dump($result);
			
			echo "<div class='col-md-3 wrap' >";
			
				    $pro= $result["photo"];
					$pro_id=$result["id"];
					
					echo "<img src=filetest2.php?a=$pro width=100% height=300px>";
		            echo "<div class='danger'><span style='color:grey'> cost : </span>".$result["cost"]."</div>";
					echo "<a href='wishlist.php?a=$pro_id' class='btn' >Add To WishList</a>";
					echo "<a href='details.php?a=$pro_id' class='btn' >details</a>";
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