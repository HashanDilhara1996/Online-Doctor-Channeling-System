
<?php session_start(); ?>
<?php require_once('connection.php') ; ?>

<?php 

$errors=array(); 

if(isset($_POST['submit'])){



        $req_fields=array('username','password','address','telephone');
        foreach ($req_fields as $field) {
            if(empty(trim($_POST[$field]))){

                $errors[]=$field . ' is required.<br>';
            }
        }

        //cheking max length 
        $max_len_fields=array('username'=> 40,'password'=> 20,'address'=>70,'telephone'=>10);
        foreach ($max_len_fields as $field=>$max_len) {
            if(strlen(trim($_POST[$field])) > $max_len){
                $errors[]=$field . ' must be less than' . $max_len .'characters<br>';
            }
        }

        //checking username already exist
        $username=mysqli_real_escape_string($connection,$_POST['username'])  ;
        $query="SELECT * FROM patient WHERE username ='{$username}' LIMIT 1";
        $result_set=mysqli_query($connection,$query);
        if($result_set){
            if(mysqli_num_rows($result_set) ==1)
                $errors[]='User Name already Exists';
        }

    if(empty($errors)){
            $Username=mysqli_real_escape_string($connection,$_POST['username']);
            $Password=mysqli_real_escape_string($connection,$_POST['password']);
            $Address=mysqli_real_escape_string($connection,$_POST['address']);
            $Telephone=mysqli_real_escape_string($connection,$_POST['telephone']);
            $type="p";

    $sql ="INSERT INTO patient (username,password,user_type,address,telephone) VALUES ('$Username', '$Password', '$type','$Address','$Telephone')";
    $result=mysqli_query($connection,$sql);
    if($result){
        //echo "Add New patient To System";
        echo "you are successfully log in To System";
    }
    else{
       echo mysqli_error($connection);
    }
    }   

}
 
 ?>
<!DOCTYPE html>
<html>
<head>
        <style>
        body  {

  background-color: #cceeff;
}
</style>
    <title>register_patient</title>
    <link rel="stylesheet" type="text/css" href="css/reg.css">
</head>
<body>
    <?php if(!empty($errors)){
        echo '<div class="nav-link">';
        echo '<b>There were error(s) on your form.</b><br>';
        foreach ($errors as $error) {
            echo $error;
        }
        echo '</div>';
    } ?>
<form action="register_p.php" method="post">
  <div class="container">
    <h1>Register For Patient</h1>

    <p>Please fill in this form to create an account.</p>

    <hr>

    <label for="UserName"><b>UserName</b></label>
    <input type="text" placeholder="Enter Username" name="username" >

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" >

    <label for="Address"><b>Address</b></label>
    <input type="text" placeholder="Enter Address" name="address" >

    <label for="your Speciality"><b>Telephone Number</b></label>
    <input type="text" placeholder="tele number" name="telephone" >




    
    <hr>

   
    <button type="submit" class="registerbtn" name="submit">Register</button>
  </div>

  <div class="container signin">
    <p>Already have an account? <a href="login.php">Sign in</a>.</p>
  </div>
</form>
</body>
</html>