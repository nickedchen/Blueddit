<?php
    function getConn(){
        $servername = "localhost";
        $username = "51832087";
        $password = "51832087";
        $dbname = "db_51832087";


        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            echo "CONNECTION FAILED";
        }

        return $conn;
    }
?>