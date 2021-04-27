
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
$address='';
$telephone=''; 
$user_id='';

if(isset($_GET['user_id'])){
  //getting the user info
  $user_id=mysqli_real_escape_string($connection,$_GET['user_id']);
 // $query="SELECT doctor.password, patient.password, doctor.id,patient.id ,doctor.address,patient.address ,doctor.speciality,patient.telephone FROM doctor INNER JOIN patient ON doctor.id=patient.id;"
  //$query="SELECT * FROM doctor JOIN patient ON doctor.id=patient.id WHERE id={$user_id} LIMIT 1";
  $query="SELECT * FROM patient WHERE id={$user_id} LIMIT 1";
  $result_set= mysqli_query($connection,$query);
  if($result_set)
  {
    if(mysqli_num_rows($result_set) ==1){
      // user found
      $result= mysqli_fetch_assoc($result_set);
      $username =$result['username'];
      $password =$result['password'];
      $address =$result['address'];
      $telephone =$result['telephone'];
     
    }else{
      //user not found
      header('Location:admin.php?err=user_not_found');
    }

  }else{
    //query unsuccessful
    header('Location:admin.php?err=query_faild');
  }

}
if(isset($_POST['submit'])){
		$user_id=$_POST['user_id'];
    $password=$_POST['password'];
		//cheking requred fields

		$req_fields=array('user_id','password');
		foreach ($req_fields as $field) {
			if(empty(trim($_POST[$field]))){

				$errors[]=$field . ' is required.<br>';
			}
		}

		//cheking max length 
		$max_len_fields=array('password'=> 20);
		foreach ($max_len_fields as $field=>$max_len) {
			if(strlen(trim($_POST[$field])) > $max_len){
				$errors[]=$field . ' must be less than' . $max_len .'characters<br>';
			}
		}

	


		if(empty($errors)){
			//no errors
			$password=mysqli_real_escape_string($connection,$_POST['password'])  ;
		


			$sql = "UPDATE patient SET password='{$password}' WHERE id={$user_id} LIMIT 1";
			   			
			   // $sql="UPDATE doctor SET";
			   // $sql .="username ='{$username}',";
			   // $sql .="address ='{$address}',";
			   // $sql .="speciality ='{$speciality}'";
			   // $sql .="WHERE id ={$user_id} LIMIT 1";
			  
			    $result=mysqli_query($connection,$sql);
			    if($result){
			        header ('Location:admin.php?password_updated=true');
			    }
			    else{
			    	$errors[]='Failed to update the record.';
			    	echo mysqli_error($connection);
			    }
		}
	}


 ?>

<!DOCTYPE html>
<html>
<head>  <style>
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
<script src="js/bootstrap.min.js"  crossorigin="anonymous"></script>
<br>
<h3>(PATIENT)Change Password</h3>
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


    <form action="change_password_p.php" method="post">
     <input type="hidden" name="user_id" value="<?php echo $user_id   ?>">
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
      <input type="text" name="username" placeholder="Enter Username"class="form-control" <?php echo 'value="'. $username .'"'; ?> disabled>
      <br>
       <label>Address :</label>
      <input type="text" name="address" placeholder="Enter Address"class="form-control" <?php echo 'value="'. $address .'"'; ?>disabled>
      <br>
       <label>Telephone :</label>
      <input type="text" name="speciality" placeholder="Enter tel num"class="form-control" <?php echo 'value="'. $telephone .'"'; ?>disabled>
      <br>
      <label>New Password :</label>
      <input type="password" name="password" placeholder="Enter The New Password"class="form-control">
  <br>
      
      
      <button class="registerbtn1 " type="submit" name="submit">Update Password</button>
      
    </form>
    
  </div>
  




<a  class="button" href="modify_patient.php"> Back</a>



</body>
</html>