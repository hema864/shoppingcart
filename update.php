<?php 
   include("dbconnect.php");
   session_start();
   
   if(!isset($_SESSION["name"])){
	  header("Location: login.php");
 }
 $id=$_SESSION["id"];
   $dir="uploads/customers".$id;
   $folder="customers".$id;
   
 
   
   if(isset($_POST["submit"])){
	
	$name=$_POST["name"];
	$email=$_POST["email"];
	if(!file_exists($dir) || !is_dir($dir)){
		mkdir($dir);
	}
	$pic_name=$_FILES["file"]["name"] ;
	if(!$pic_name=='')
	{
	if($_FILES["file"]["type"]=='image/jpeg'){
	if($_FILES["file"]["error"]==0){
		$res=move_uploaded_file($_FILES["file"]["tmp_name"],$dir."/".$_FILES["file"]["name"]);		
	}
	}
	else{
		echo "please upload jpeg files only";
	}
	
	
	
	$res=mysqli_query($con,"UPDATE `customers` SET `name` = '$name',email='$email',photo='$pic_name' WHERE `customers`.`id` = $id");
	if($res){
		$_SESSION["name"]=$_POST["name"];
		$_SESSION["email"]=$_POST["email"];
		$_SESSION["photo"]=$pic_name;
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
		
		 body{
                background: lightgrey;
            }
            .heading{
                text-align: center;
            }
            .wrap-1{
              
                margin-top: 10px;
                 background: grey;
				 width:50%;
				 height:400px;
				 float:right;
				 display:inline-block;
                 align: right;
                 text-align: center;
				 
				 
            }
            .wrap{
                
                margin-top: 20px;
                height: 50px;
                line-height: 30px;
                display: inline-block;
            }
			.wrap-1 label{
			     width:200px;
				text-align: right; 
                padding-right: 20px;
			}
            .wrap input{
                width: 250px;
                padding: 5px;
                border: 0px ;
                border-top-left-radius: 5px;
                border-top-right-radius: 5px;
                border-bottom-left-radius: 5px;
                border-bottom-right-radius: 5px;
            }
            .wrap:last-child input{
                background: lightskyblue;
                color: #313131;
                margin-left: 40px;
                font-weight: bold;
                width: 100px;
                opacity: 0.7;
            }
			.wrap-2{
				margin-top: 10px;
                 
				 width:50%;
				 height:400px;
				 float:right;
				 display:inline-block;
                 align: right;
                 text-align: center;
				 
			}
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
	    <li >
          <a href="wishlist.php"  >wishlist</a>    
        </li>
		<li >
          <a href="cart.php"  >cart</a>    
        </li>
        <li><a href="update.php"><?php echo $_SESSION["name"] ; ?></a></li>
        <li >
          <a href="logout.php" class="dropdown-toggle"  >logout</a>
		  
     
        </li>
		
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

	
	<div class=" wrap-1 " >
	<?php echo $_SESSION["id"]; ?>
            <div class="col-sm-10">
                <form class="form" action="" method="POST"enctype="multipart/form-data">
                   
                    <div class="username wrap">
                        <label>
                            name
                        </label>
                        <input type="text"name="name" value="<?php echo $_SESSION["name"] ?>" required autofocus>
                    </div>
                    <div class="password wrap">
                        <label>
                            email
                        </label>
                        <input type="email"name="email" value="<?php echo $_SESSION["email"] ?>" required>
                    </div>
					<br>
					<div class="password wrap">
                        <label>
                           photo
                        </label>
                        <input type="file"name="file">
                    </div>
                   
                    <br>
                    <div class="wrap">
                        <input type="submit" value="update"name="submit">
                    </div>
                </form>
            </div>
        </div>
       
	   
	<div class=" wrap-2 " >
	     <div class="profile" >
		    <?php
			
			$res=mysqli_query($con," SELECT * FROM `customers` e WHERE e.id=$id  limit 1");
			if($res){
							
				if(mysqli_num_rows($res)>0){
				
					$result=mysqli_fetch_array($res);
						$name= $result["photo"];
					
					$path=$dir."/".$name;
		           echo "<img src=filetest1.php?a=$path width=100% height=400px >";
				  
			}
			}
			?>
		 </div>
    </div>
     
   
    </body>
</html>  