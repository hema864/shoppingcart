<!DOCTYPE HTML>

<?php 
    include('dbconnect.php');
	
    if(isset($_POST['submit'])){
		$name=mysql_escape_string(trim($_POST["name"]));
		$email=mysql_escape_string(trim($_POST["email"]));
		$pwd=mysql_escape_string(trim($_POST["pwd"]));
		$name=mysql_escape_string(addslashes($name));
		//if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){
        if(! $email){			
    // Return Error - Invalid Email
	     echo "invalid email";
        }else{
			$search=mysqli_query($con,"select * from customers where email='$email'");
			$exist=mysqli_num_rows($search);
			if($exist>0){
				echo "sorry ! already this account is in use";
			}
			else{
		//		header("Location:sendmail.php");
    // Return Success - Valid Email
	    // echo 'Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.';
		// $hash=md5(rand(0,1000));
         
		 /////////////// email sending
/*		 $to=$email;
		 $subject='email verification';
		 $from="hema@gmail.com";
		 
		 $msg='
		      thanks for registration.
			  your account has been created.you can login with the following credentials after you have activated your account by clicking the following link
			  
			  ---------------
			  
			  username='.$name.';
			  password='.$pwd.';
			  
			  ------------------------
			  
			  please click this following link to activate your account.
			  
			  localhost:8080/project/p1/verify.php?hash='.$hash.' email='.$email;
			  
		 


$headers = "From: hema@gmail.com" . "\r\n" .
"CC: somebodyelse@example.com";

$sent=mail($to,"hii","hii");	*/ 
$sent=true;

		if($sent){
			
		
		$res=mysqli_query($con,"insert into customers(name,email,password) values('$name','$email','$pwd')");
		if($res){
			$q=mysqli_query($con,"select * from customers where email='$email'");
			$row=mysqli_fetch_array($q);
			$your_id=$row["id"];
			echo "<span style='font-size:30px;font-weight:bold;color:yellow'>your id is $your_id</span>";
			echo "<br/>";
			echo "you can login now using your id and password";
			//header("Location:login.php");
		}
		}
		
		else{
			echo "";
		}
		}
		}
	}

?>
<html lang="en">
    <head>
        <meta name="veiwport" content="width:device-width">
        <meta charset="UTF-8">
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css">  
        <style>
		  body{
		     background:brown;
		  }
		  form .i1{
		      padding:5px;
			  border-radius:5px;
			  width:300px;
			  
		  }
		  form tr{
		      height:40px;
			  
		  }
        </style>      
    </head>
    <body>
	<h1 align="center" color="">registration</h1>
	<br><br>
	
	<form action="" method="post" enctype="multipart/form-data">
	<table align="center" width="500px" height="100px;">
	<tr ><td><b>Email:</b></td><td><input type="email" placeholder="@gmail.com" name="email"required autofocus class="i1"></td></tr>
	<tr ><td><b>Name:</b></td><td><input type="text" placeholder="" name="name" required class="i1"> </td></tr>
	<tr ><td><b>Password:</b></td><td><input type="password" placeholder="***" name="pwd"required  class="i1"></td></tr>
	
    <tr><td colspan="1"></td><td  align="left"><input type="submit" name="submit" value="R E G I S T E R"></td><td><button onclick="window.location.href='login.php'"style='width:100px;height:30px'>login</button></a></td></tr>
	</table>
    </form>   
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script> 
    
    </body>
</html>