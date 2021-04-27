<?php session_start(); ?>
<?php require_once('connection.php') ; ?>

<?php if (!isset($_SESSION['username'])) {
  header('Location: login.php');
} 
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
        $user_list .="<td>{$doc['password']}</td>";
        $user_list .="<td>{$doc['address']}</td>";
        $user_list .="<td>{$doc['speciality']}</td>";
        $user_list .="<td><a href=\"modify_doctor.php?user_id={$doc['id']}\">Edit</a></td>";
        $user_list .="<td><a href=\"delete_doctor.php?user_id={$doc['id']}\"
        onclick=\"return confirm('Are you sure ?');\">Delete</a></td>";

        $user_list .="</tr>";

      }
  }
else
  {
      echo "database query fail"; 
  }

?>
<?php 
$user_list2='';
//getting the list o doctors
//$query="SELECT  id,username,password,address,telephone FROM patient";
$query="SELECT * FROM patient WHERE is_deleted=0 ORDER BY username";
$patients=mysqli_query($connection,$query);

  if($patients){

      while($pat=mysqli_fetch_assoc($patients)){
        $user_list2 .="<tr>";
        $user_list2 .="<td>{$pat['id']}</td>";
        $user_list2 .="<td>{$pat['username']}</td>";
        $user_list2 .="<td>{$pat['password']}</td>";
        $user_list2 .="<td>{$pat['address']}</td>";
        $user_list2 .="<td>{$pat['telephone']}</td>";
        $user_list2 .="<td><a href=\"modify_patient.php?user_id={$pat['id']}\">Edit</a></td>";
        $user_list2 .="<td><a href=\"delete_patient.php?user_id={$pat['id']}\"
        onclick=\"return confirm('Are you sure ?');\">Delete</a></td>";
        //$user_list2 .="<td><a href=\"delete_patient.php?user_id={$pat['id']}\">Delete</a></td>";
        $user_list2 .="</tr>";

      }
  }
else
  {
      echo "database query fail"; 
  }
 ?>

<!DOCTYPE html>
<html>
<head>	
  <style>
		body  
    {

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
     <span class="active"><a href="add_admin.php"> + Add New Admin</span></a>
    <span class="active"><a href="register_p.php"> + Add New Patient</span></a>
   <span class="active"><a href="register_d.php"> + Add New Doctor</span></a>
</div>




<script src="js/jquery.js"  crossorigin="anonymous"> </script>
<script src="js/popper.js"  crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"  crossorigin="anonymous"></script>
<br>
<h3>Doctors Who Use The System</h3>
<br>

  


<table id="customers">
  <tr>
    <th>Doctor id</th>
    <th>Username</th>
    <th>Password</th>
    <th>Address</th>
    <th>Speciality</th>
    <th>Edit</th>
    <th>Delete</th>


 </tr>

<?php    echo $user_list ;     ?>

</table>
<br><br>
<h3>Patient Who Use The System</h3>
<table id="customers">
  <tr>
    <th>Patient id</th>
    <th>Username</th>
    <th>Password</th>
    <th>Address</th>
    <th>Tele-Phone</th>
    <th>Edit</th>
    <th>Delete</th>


 </tr>

<?php    echo $user_list2 ;     ?>

</table>





</body>
</html>