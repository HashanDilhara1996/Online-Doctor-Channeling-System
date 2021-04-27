
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
$speciality=''; 


$user_id='';

if(isset($_GET['user_id'])){
  //getting the user info
  $user_id=mysqli_real_escape_string($connection,$_GET['user_id']);
  $query="SELECT * FROM doctor WHERE id={$user_id} LIMIT 1";
  $result_set= mysqli_query($connection,$query);
  if($result_set)
  {
    if(mysqli_num_rows($result_set) ==1){
      // user found
      $result= mysqli_fetch_assoc($result_set);
      $username =$result['username'];
      $password =$result['password'];
      $address =$result['address'];
      $speciality =$result['speciality'];
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
		$username=$_POST['username'];
		$address=$_POST['address']; 
		$speciality=$_POST['speciality']; 
		//cheking requred fields

		$req_fields=array('user_id','username','address','speciality');
		foreach ($req_fields as $field) {
			if(empty(trim($_POST[$field]))){

				$errors[]=$field . ' is required.<br>';
			}
		}

		//cheking max length 
		$max_len_fields=array('username'=> 40,'address'=>70,'speciality'=>20);
		foreach ($max_len_fields as $field=>$max_len) {
			if(strlen(trim($_POST[$field])) > $max_len){
				$errors[]=$field . ' must be less than' . $max_len .'characters<br>';
			}
		}

		//checking username already exist
		$username=mysqli_real_escape_string($connection,$_POST['username'])  ;
		$query="SELECT * FROM doctor WHERE username ='{$username}' AND id !={$user_id}  LIMIT 1";
		$result_set=mysqli_query($connection,$query);
		if($result_set){
			if(mysqli_num_rows($result_set) ==1)
				$errors[]='User Name already Exists';
		}


		if(empty($errors)){
			//no errors
			$username=mysqli_real_escape_string($connection,$_POST['username'])  ;
			$address=mysqli_real_escape_string($connection,$_POST['address']); 
			$speciality=mysqli_real_escape_string($connection,$_POST['speciality']); 
			$sql = "UPDATE doctor SET username='{$username}',address ='{$address}',speciality ='{$speciality}' WHERE id={$user_id} LIMIT 1";
			   			
			   // $sql="UPDATE doctor SET";
			   // $sql .="username ='{$username}',";
			   // $sql .="address ='{$address}',";
			   // $sql .="speciality ='{$speciality}'";
			   // $sql .="WHERE id ={$user_id} LIMIT 1";
			  
			    $result=mysqli_query($connection,$sql);
			    if($result){
			        header ('Location:admin.php?Doctor_modified=true');
			    }
			    else{
			    	$errors[]='Failed to modify the record.';
			    	echo mysqli_error($connection);
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
<script src="js/bootstrap.min.js"  crossorigin="anonymous"></script>
<br>
<h3>Modify Doctors</h3>
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


    <form action="modify_doctor.php" method="post">
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
      <input type="text" name="username" placeholder="Enter Username"class="form-control" <?php echo 'value="'. $username .'"'; ?>>
      <br>
       <label>Address :</label>
      <input type="text" name="address" placeholder="Enter Address"class="form-control" <?php echo 'value="'. $address .'"'; ?>>
      <br>
       <label>Speciality :</label>
      <input type="text" name="speciality" placeholder="Enter Speciality"class="form-control" <?php echo 'value="'. $speciality .'"'; ?>>
      <br>
      <label>Password :</label>
      <span>**********</span> | <a href="change_password_d.php?user_id=<?php echo $user_id; ?>">Change Password</a>
      <br>
  
      
      
      <button class="registerbtn1 " type="submit" name="submit">Save</button>
      
    </form>
    
  </div>
  



<a  class="button" href="admin.php"> Back</a>



</body>
</html>