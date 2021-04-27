<?php
session_start();
if (!isset($_SESSION['username'])){header('Location: login.php');}
$_SESSION['d_id']=$_GET['d_id'];
?>    


<html>
<body>
<form action="formsubmit.php" method="post">
 
Birthday:<input type="date" name="bday">
<br>channeling date:<input type="date" name="date">
<br>session: 
<select name="session" >
  <option value="m">Morning</option>
  <option value="a">Afternoon</option>
  <option value="e">Evening</option>
   
</select>
<br>Message:
<textarea rows="4" cols="50" name="message">
Enter message here...</textarea>
<br><input type="submit" name="submit" value="submit">
</form>
</body>
</html>
