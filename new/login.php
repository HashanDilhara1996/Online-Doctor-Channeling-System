<?php session_start(); ?>
<?php require_once('connection.php') ; ?>
<?php 

$error=0;

if(isset($_POST['submit'])){
	$Username=mysqli_real_escape_string($connection,$_POST['Username']);
	$Password=mysqli_real_escape_string($connection,$_POST['Password']);
	$query="SELECT * FROM admin WHERE username='{$Username}' AND password='{$Password}' LIMIT 1";	
	$query_d="SELECT * FROM doctor WHERE username='{$Username}' AND password='{$Password}' LIMIT 1";
	$query_p="SELECT * FROM patient WHERE username='{$Username}' AND password='{$Password}' LIMIT 1";

	$result_set=mysqli_query($connection,$query);
	$result_set_d=mysqli_query($connection,$query_d);
	$result_set_p=mysqli_query($connection,$query_p);

	if($result_set){
		if(mysqli_num_rows($result_set)==1){
			$this_user=mysqli_fetch_assoc($result_set);
			$this_user_type=$this_user['user_type'];
 			$_SESSION['user_id']=$this_user['id'];
			$_SESSION['username']=$this_user['username'];

		
			if($this_user_type=="a"){
				header('Location:admin.php');
			}
				
		}
		else{
		$error=1;
		}
	}
	if($result_set_d){
		if(mysqli_num_rows($result_set_d)==1){
			$this_user=mysqli_fetch_assoc($result_set_d);
			$this_user_type=$this_user['user_type'];
 			$_SESSION['user_id']=$this_user['id'];
			$_SESSION['username']=$this_user['username'];

		
			if($this_user_type=="d"){
				header('Location:doctor.php');
			}
				
		}
		else{
		$error=1;
		}
	}
	if($result_set_p){
		if(mysqli_num_rows($result_set_p)==1){
			$this_user=mysqli_fetch_assoc($result_set_p);
			$this_user_type=$this_user['user_type'];
			$_SESSION['user_id']=$this_user['id'];
			$_SESSION['username']=$this_user['username'];
		
		
			if($this_user_type=="p"){
				header('Location:patient.php');
			}
				
		}
		else{
		$error=1;
		}

	}





}


 ?>



<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/reg.css">
</head>
<body>

<style type="text/css">
	.box{border: 2px solid black;width: 400px;padding: 30px;margin: 0 auto;margin-top: 100px;}
		body  {
		 background-image: url("css/qq.jpg");
		  background-size:  1700px 800px;
		   background-blend-mode: lighten;
 
}

</style>

<div class="container">
	
	<div class="box">
		<form action="login.php" method="post">
			<h1>DoC Channel</h1>
			<?php 
			if(isset($_GET['logout'])){
          
          	//'<p class="info alert alert-success">you have succesfully logout from the system</p>';
          	} ?>
			<h3><label>Username(doctor/patient) :</label></h3>
			<input type="text" name="Username" placeholder="Enter Username"class="form-control" required>
			<br>
			<h3><label>Password :</label></h3>
			<input type="password" name="Password" placeholder="Enter Password" class="form-control">
			<br>
			<?php if($error==1){
				echo "<p class=\"error alert alert-danger\">Invalid username or password</p>";
			} ?>
			
			
			<div><button class="registerbtn" type="submit" name="submit">LOG IN</button></div>
			<p>For Patients ?  <a href="register_p.php">Register Patient Now</a></p>
			<p>For Doctors ?  <a href="register_d.php">Register Doctor Now</a></p>
		

		</form>
		
	</div>	



</div>

<script src="js/jquery.js"  crossorigin="anonymous"> </script>
<script src="js/popper.js"  crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"  crossorigin="anonymous"></script>

</body>
</html>