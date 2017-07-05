<!DOCTYPE HTML>
<?php 
 session_start();
  if(isset($_SESSION["name"])){
	  header("Location: home.php");
 }
 else{
	 session_destroy();
 }
 
?>

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
              
                margin-top: 100px;
                 background: lightgray;
				 width:80%;
                 align-content: center;
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
            
        </style>      
    </head>
    <body>
        <div class="heading">
            <h1>Registation Desk</h1>
			<?php
			$uid=" ";
			$pwd="";
   if(isset($_POST["submit"])){
		$uid=trim($_POST['id']);
		$pwd=$_POST["pwd"]; 
		$auth=0;
		//$uid = addslashes($uid);
		include('dbconnect.php');
		$res = mysqli_query($con," SELECT * FROM `customers` e WHERE e.id=$uid and e.password='$pwd' limit 1");
       	
		if($res)
		{   
	       if(mysqli_num_rows($res)>0){
			 session_start();
			$col=mysqli_fetch_array($res);
		    $_SESSION["id"]= $col["id"];
			$_SESSION["email"]= $col["email"];
		    $_SESSION["name"]=$col["name"];
			//var_dump($col);
			header("Location:home.php");
		   }
		   else{
			   echo "check again your credentials";
		   }
		}
		else{
			echo "sorry";
		}
		
	}
  
 ?>
        </div>
        <div class="container wrap-1 ">
            <div class="col-sm-10">
                <form class="form" action="" method="POST">
                   
                    <div class="username wrap">
                        <label>
                            user id
                        </label>
                        <input type="number"name="id" value=<?php echo "$uid"; ?>>
                    </div>
                    <div class="password wrap">
                        <label>
                            password
                        </label>
                        <input type="password"name="pwd">
                    </div>
                   
                    <br>
                    <div class="wrap">
                        <input type="submit" value="sign in"name="submit">
                    </div>
                </form>
            </div>
        </div>
       
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script> 
    
    </body>
</html>