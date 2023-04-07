<?php
session_start();
include "include/connection.php";

$email = $_POST['user'];
$password = $_POST['pass'];

//to prevent from mysqli injection  
$email = stripcslashes($email);
$email = mysqli_real_escape_string($conn, $email);
$password = stripcslashes($password);
$password = mysqli_real_escape_string($conn, $password);

$hash = md5($password);

$sql = "select * from users where email = '$email' and password = '$hash'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$count = mysqli_num_rows($result);


if ($count == 1) {
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $row['username'];
    $_SESSION['userid'] = $row['userid'];
    $_SESSION['profilePath'] = $row['profilepath'];
    $_SESSION['isguest'] = $row['isguest'];
    $_SESSION['isadmin'] = $row['isadmin'];
    
    //Track Usage
    $sql = "INSERT INTO usageTracking (type, entryDate)
    Values ('LOGIN', CURDATE())";
    mysqli_query($conn, $sql);
    
    header('Location: index.php');
    die();
} else {
    header('Location: auth.php');
    die();
}
?>