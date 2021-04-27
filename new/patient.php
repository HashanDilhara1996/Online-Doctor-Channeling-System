<?php session_start(); ?>
<?php require_once('connection.php') ; ?>

<?php if (!isset($_SESSION['username'])) {
  header('Location: login.php');
} ?>

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
      Welcome  <?php echo $_SESSION['username'];?>   !!!...
    </span>
   
</div>

<script src="js/jquery.js"  crossorigin="anonymous"> </script>
<script src="js/popper.js"  crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"  crossorigin="anonymous"></script>
<br>
<h3>Choose Your Doctor....</h3>
<br>

<?php 
$user_list='';
//getting the list o doctors
$query="SELECT * FROM doctor WHERE is_deleted=0 ORDER BY username";
//$query="SELECT  id,username,password,address,speciality FROM doctor";

$doctors=mysqli_query($connection,$query);

  if($doctors){

      while($doc=mysqli_fetch_assoc($doctors)){
        $user_list .="<tr>";
        $user_list .="<td>{$doc['id']}</td>";
        $user_list .="<td>{$doc['username']}</td>";
        $user_list .="<td>{$doc['address']}</td>";
        $user_list .="<td>{$doc['speciality']}</td>";
        $user_list .="<td><a href=\"form.php?d_id={$doc['id']}\">Choose</a></td>";
        

        $user_list .="</tr>";

      }
  }
else
  {
      echo "database query fail"; 
  }
 

mysqli_close($connection);
?>
<table id="customers">
  <tr>
    <th>Doctor id</th>
    <th>Username</th>
    <th>Address</th>
    <th>Speciality</th>
    <th>Choose</th>
  


 </tr>

<?php    echo $user_list ;     ?>
</body>
</html>