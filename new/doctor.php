<?php session_start(); ?>
<?php require_once('connection.php') ; ?>

<?php if (!isset($_SESSION['username'])) {
  header('Location: login.php');
} ?>



<?php 

  $query = "SELECT * FROM channeling WHERE id = '{$_SESSION['user_id']}'";
  $result = mysqli_query($connection,$query);

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
      Welcome Dr.<?php echo $_SESSION['username'];?>   !!....
    </span>
   
</div>

<table>
  <tr>
    <td>NAME</td>
    <td>BIRTH DAY</td>
    <td>SESSION</td>
    <td>CHANNELING DATE</td>
    <td>MESSAGE</td>                
  </tr>

<?php 
  if($result){

    if(mysqli_num_rows($result)>0){
      while($row=mysqli_fetch_assoc($result)){

        echo "<tr>";
          echo "<td>".$row['p_name']."</td>";
          echo "<td>".$row['DOB']."</td>";
          echo "<td>".$row['session']."</td>";
          echo "<td>".$row['Date']."</td>";
          echo "<td>".$row['message']."</td>";                                 
        echo "</tr>";
          }

        }
  }

  
?>
</table>
</body>
</html>