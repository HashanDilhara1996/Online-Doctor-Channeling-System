<?php
    require_once('connection.php') ;
    session_start();

    if (!isset($_SESSION['username'])){
        header('Location: login.php');
    }
    $d_id=$_SESSION['d_id'];
    $p_name=$_SESSION['username'];


if(isset($_POST['submit'])){


    $bday=$_POST['bday'];
    $session=$_POST['session'];
    $message=$_POST['message'];
    $date=$_POST['date'];//date("Y-m-d");
    $query="INSERT INTO channeling (p_name, id, session, DOB, message, Date) VALUES ('{$p_name}', '{$d_id}', '$session', '$bday', '$message', '$date')";
    
    //$result =mysqli_query($connection,$query);
    if (mysqli_query($connection,$query)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connection);
    }

}    

?>