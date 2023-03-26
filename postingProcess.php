<?php
	session_start();
	include "include/connection.php";

    $title = $_POST['newTitle'];
    $description = $_POST['newDescription'];
    $userid = $_SESSION['userid'];
      
    //to prevent form mysqli injection  
    $title = stripcslashes($title);
    $title = mysqli_real_escape_string($conn, $title);
    $description = stripcslashes($description);
    $description = mysqli_real_escape_string($conn, $description);
    
    //Insert into database and determine if successful
    //For now all posts go into the subblueddit with ID 1,
    //but this should be changed once subblueddits work. 
    $sql = "INSERT INTO posts (title, content, userid, sid)
    Values ('$title', '$description', $userid, 1)"; 
    $success = mysqli_query($conn, $sql);


    //If successful
    if (!$success){
        $_SESSION['posted'] = false;
	    header('Location: newPost.php');
        mysqli_close($conn); 
	    die();
    }else{
        $_SESSION['posted'] = true;
	    header('Location: index.php');
        mysqli_close($conn); 
	    die();
    }
?>  