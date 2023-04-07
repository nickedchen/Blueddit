<?php
	session_start();
	include "include/connection.php";

    $email = $_POST['email'];
    $username = $_POST['username'];  
    $password = $_POST['pass']; 
      
        //to prevent form mysqli injection  
    $email = stripcslashes($email);
    $email = mysqli_real_escape_string($conn, $email);
    $username = stripcslashes($username);
    $username = mysqli_real_escape_string($conn, $username); 
    $password = stripcslashes($password);
    $password = mysqli_real_escape_string($conn, $password);
    $hash = md5($password);

    //Check if user already exists
    $sql = "select * from users where email = '$email'";  
    $result = mysqli_query($conn, $sql); 
    $count = mysqli_num_rows($result);  
          
    if($count != 0){  
        $_SESSION['emailIssue'] = true;
	    header('Location: registration.php');
        mysqli_close($conn); 
	    die();
    }

    $sql = "select * from users where username = '$username'";  
    $result = mysqli_query($conn, $sql); 
    $count = mysqli_num_rows($result);  
          
    if($count != 0){  
        $_SESSION['userIssue'] = true;
	    header('Location: registration.php');
        mysqli_close($conn); 
	    die();
    }
    
    //Insert into database and determine if successful
    $sql = "INSERT INTO users (username, email, password)
    Values ('$username', '$email', '$hash')"; 
    $success = mysqli_query($conn, $sql);


    //If successful
    if (!$success){
        $_SESSION['registered'] = false;
	    header('Location: registration.php');
        mysqli_close($conn); 
	    die();
    }else{
        //Track usage
        $sql = "INSERT INTO usageTracking (type, entryDate)
        Values ('REGISTRATION', CURDATE())";
        mysqli_query($conn, $sql);

        $_SESSION['registered'] = true;
	    header('Location: auth.php');
        mysqli_close($conn); 
	    die();
    }
?>  