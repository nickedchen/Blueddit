<?php
session_start();
$_SESSION['loggedin'] = false;
if (isset($_SESSION['isadmin']))
    unset($_SESSION['isadmin']);
header("Location: auth.php");
die();

?>