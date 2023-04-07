<?php

// Database connection
if( empty(session_id()) && !headers_sent()){
    session_start();
}

// Mack's database
// $servername = "localhost";
// $username = "51832087";
// $password = "51832087";
// $dbname = "db_51832087";

//Nick's database
$servername = "localhost";
$username = "80611197";
$password = "80611197";
$dbname = "db_80611197";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

$error = mysqli_connect_error();

?>