<?php

// Database connection

// try {
	$servername = "localhost";
	$username = "51832087";
	$password = "51832087";
	$dbname = "db_51832087";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);

	$connError = mysqli_connect_error();
	// Check connection
	// if ($connError != null) {
	// 	echo "CONNECTION FAILED: " . $connError;
	// 	die("Connection failed: " . $conn->connect_error);
	// } else {
	// 	echo "<h2>CONNECTION SUCCESS</h2>";
	// 	$result = mysqli_query($conn, "SELECT uname FROM useraccounts");
	// 	echo "<h3>Retrieved results</h3>";
	// 	$i = 0;

	// 	while ($row = mysqli_fetch_assoc($result)) {
	// 		echo "<p>Username: " . $row['uname'] . "</p>";
	// 		$i++;
	// 	}
	// }
// } catch (Exception $e) {
// 	echo "Not quite";
// }

// mysqli_close($conn); 
?>