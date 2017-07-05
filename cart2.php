<?php 
  include("dbconnect.php");
  session_start();
  if(!isset($_SESSION["name"])){
	  header("Location: login.php");
 }
 $person_id=$_SESSION["id"];
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
		.table{
			width:60%;
			margin:10px ;
			margin-bottom:10px;
			border-top:1px solid brown;
		}
		
		.img{
			width:40%;
			height:auto;
			
		}
		.details_div{
			width:40%;
		}
		.cost_div{
			width:30%;
			
		}
		.quant_div{
			width:10%;
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
	
	
		    <?php
			
			
			$res=mysqli_query($con," SELECT * FROM products p,cart e where e.product_id=p.id and e.person_id=$person_id");
			if($res&&mysqli_num_rows($res)>0){
					$total=0;	$no_of_items=0;	
				while($result=mysqli_fetch_array($res)){
				    //var_dump($result);
			
			//echo "<div class='col-md-2 wrap' >";
			
				    $pro= $result["photo"];
					$pro_id=$result["id"];
					$quantity=$result["quantity"];
					$cost=$result['cost'];
					if($quantity>0){
					$total=$total+$cost*$quantity;
					$no_of_items++;
					
					?>
	   <table class="table">
	   <tr>
	   <td class="col-sm-2"><div class="img_div" ><?php echo "<img src=filetest2.php?a=$pro class='img'>"; ?></td>
	   <td class="col-sm-6"><div class="details_div">sai</div></td>
	   <td class="col-sm-3"><div  class="cost_div"><?php echo $cost ?></div></td>
	   <td class="col-sm-1"><div class="quant_div"><?php echo "<form action='update_cart.php' method='post' id='form".$pro_id."' name='form'><input type='number' value='$quantity' min='1' max='3' name='quantity' onchange='submit1($pro_id)'><input type='hidden'value='$pro_id' name='id'><input type='hidden'value='$cost' name='cost'></form>";
		 ?></div></td>
	   </tr>
	   </table>
					<?php
					
				//	echo "<img src=filetest2.php?a=$pro width=100% height=200px>";
		         //  echo "<div class='danger'id='cost'><span style='color:grey'>cost : </span>$cost</div>";
			//		echo "<div class='danger'id='cost'><span style='color:grey'>total cost : </span><script>change($cost,$quantity)</script></div>";
				//	echo "<form action='update_cart.php' method='post' id='form".$pro_id."' name='form'><input type='number' value='$quantity' min='1' max='3' name='quantity' onchange='submit1($pro_id)'><input type='hidden'value='$pro_id' name='id'><input type='hidden'value='$cost' name='cost'></form>";
				//	echo "<a href='cart_delete.php?a=$pro_id 'class='btn' >Remove</a>";
					
					}
					else{
						mysqli_query($con,"DELETE from cart where quantity=0");
						header("refresh");
					}
			
			}echo "<a href='home.php'class='btn' >continue shopping</a>";
			  echo "<div >total value : $total</div>";
			  echo "<div >no of items: $no_of_items</div>";
			}
			?>
		 </div>	 
	
	
	
       

    </body>
</html>