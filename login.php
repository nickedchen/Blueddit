<?php

session_start();
$servername = "localhost";
$username = "80611197";
$password = "80611197";
$dbname = "db_80611197";

$conn = mysqli_connect($servername, $username, $password, $dbname);
$email = $_POST['user'];
$password = $_POST['pass'];

$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$count = mysqli_num_rows($result);


if ($count == 1) {
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $row['username']; // update session username
    $_SESSION['userid'] = $row['userid']; // update session userid
    
    header('Location: index.php');
    die();
} else {
    header('Location: auth.php');
    die();

}
?>
