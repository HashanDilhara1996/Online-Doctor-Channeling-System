<?php 

	$connection=mysqli_connect('localhost','root','','login');

	if(mysqli_errno($connection)){
		die('database connection error' . mysqli_error());
	}else{
		//echo "connection succesfull";
	}

 ?>