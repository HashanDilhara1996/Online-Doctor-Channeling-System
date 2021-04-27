
<?php session_start(); ?>
<?php require_once('connection.php') ; ?>
<?php if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
} 
?>

<?php 




if(isset($_GET['user_id'])){
  //getting the user info
  $user_id=mysqli_real_escape_string($connection,$_GET['user_id']);
 //deleting the user
  $query="UPDATE patient SET is_deleted=1 WHERE id={$user_id} LIMIT 1";
  $result=mysqli_query($connection,$query);
  if($result){
    //user deleted
    header('Location:admin.php?msg=patient_deleted');

  }else{ 
    header('Location:admin.php?err=delete_failed');
  }





}else{
  header('Location:admin.php');
  }

?>