<?php session_start(); ?>
<?php require_once('connection.php') ; ?>
<?php if (!isset($_SESSION['username'])) {
  header('Location: login.php');
} 

?>
<?php 
$errors=array(); 

$username='';
$password=''; 
	if(isset($_POST['submit'])){

		$username=$_POST['username'];
		$password=$_POST['password']; 
		//cheking requred fields

		$req_fields=array('username','password');
		foreach ($req_fields as $field) {
			if(empty(trim($_POST[$field]))){

				$errors[]=$field . ' is required.<br>';
			}
		}

		//cheking max length 
		$max_len_fields=array('username'=> 10,'password'=>10);
		foreach ($max_len_fields as $field=>$max_len) {
			if(strlen(trim($_POST[$field])) > $max_len){
				$errors[]=$field . ' must be less than' . $max_len .'characters<br>';
			}
		}

		//checking username already exist
		$u_name=mysqli_real_escape_string($connection,$_POST['username'])  ;
		$query="SELECT * FROM admin WHERE username ='{$u_name}' LIMIT 1";
		$result_set=mysqli_query($connection,$query);
		if($result_set){
			if(mysqli_num_rows($result_set) ==1)
				$errors[]='User Name already Exists';
		}


		if(empty($errors)){
			//no errors
			$username=mysqli_real_escape_string($connection,$_POST['username'])  ;
			$password=mysqli_real_escape_string($connection,$_POST['password'])  ;
			$type="a";
   			$sql = "INSERT INTO admin (username,password,user_type) VALUES ('$username', '$password','$type')";
  			$result=mysqli_query($connection,$sql);
    		if($result){
        			
        			header('Location:admin.php?admin_added=true');
   			 }else{
   			 	$errors[]='Failed to add new admin'; 
       			 
    		}
		}
	}



 ?>



<!DOCTYPE html>
<html>
<head>	<style>
		body  {

  background-color: #cceeff;
}
</style>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/reg.css">
</head>
<body>



<div class="header">
  <a class="logo">DoC Channeling</a>
  <div class="header-right">
    <a  class="active" href="logout.php">Logout</a>
  </div>
  <span class="header-right">
      Wellcome  <?php echo $_SESSION['username'];?>   !!....
    </span>
   
</div>


<script src="js/jquery.js"  crossorigin="anonymous"> </script>
<script src="js/popper.js"  crossorigin="anonymous"></script>
<br>
<h3>New Admins</h3>
<br>
<div class="container">
  

  <div class="form-group">
  	<?php if(!empty($errors)){
  		echo '<div class="nav-link">';
  		echo '<b>There were error(s) on your form.</b><br>';
  		foreach ($errors as $error) {
  			echo $error;
  		}
  		echo '</div>';
  	} ?>


    <form action="add_admin.php" method="post">
     
      <?php if(isset($_GET['logout'])){
            echo 
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
       you have succesfully logout from the system
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
      </div>' ;

            //'<p class="info alert alert-success">you have succesfully logout from the system</p>';
            } ?>
      <label>UserName :</label>
      <input type="text" name="username" placeholder="Enter Username"class="form-control" <?php echo 'value="'. $username .'"'; ?>>
      <br>
      <label>Password :</label>
      <input type="password" name="password" placeholder="Enter Password" class="form-control"  >
      <br>
  
      
      
      <button class="registerbtn" type="submit" name="submit">Save</button>
      
    </form>
    
  </div>
  





<a  class="button" href="admin.php"> Back</a>



</body>
</html>