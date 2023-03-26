<?php
	session_start();
	include "include/connection.php";

    $email = $_POST['email'];
    $username = $_POST['username'];  
    $password = $_POST['pass']; 
      
        //to prevent from mysqli injection  
    $email = stripcslashes($email);
    $username = stripcslashes($username);    
    $password = stripcslashes($password);
    
    //Insert into database and determine if successful
    $sql = "INSERT INTO users (username, email, password)
    Values ('$username', '$email', '$password')"; 
    $success = mysqli_query($conn, $sql);


    //If successful
    if (!$success){
        $_SESSION['registered'] = false;
	    header('Location: registration.php');
        mysqli_close($conn); 
	    die();
    }else{
        $_SESSION['registered'] = true;
	    header('Location: auth.php');
        mysqli_close($conn); 
	    die();
    }
?>  