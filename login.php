<?php
	session_start();
	$servername = "localhost";
        $username = "51832087";
        $password = "51832087";
        $dbname = "db_51832087";

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
    $email = $_POST['user'];  
    $password = $_POST['pass']; 
      
        //to prevent from mysqli injection  
        $email = stripcslashes($email);  
        $password = stripcslashes($password);
      
        $sql = "select * from users where email = '$email' and password = '$password'";  
        $result = mysqli_query($conn, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
          
        if($count == 1){  
            $_SESSION['loggedin'] = true;
    	    $_SESSION['username'] = $email;
	    header('Location: index.php');
	    die();
        }  
        else{  
            header('Location: auth.php');
	    die();
 
        }     
?>  