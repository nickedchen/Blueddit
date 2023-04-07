<?php
session_start();
$_SESSION['loggedin'] = false;
if (isset($_SESSION['admin']))
    unset($_SESSION['admin']);
header("Location: auth.php");
die();

?>