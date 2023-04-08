<?php
session_start();

include 'include/connection.php';

// get the form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = md5($_POST['password']);
$about = $_POST['about'];
$country = $_POST['country'];
$profilepath = $_POST['profilepath'];
$userid = $_SESSION['userid'];

// if password is empty, set it to the current password
if (empty($password)) {
    $password = $_SESSION['password'];
}


if (mysqli_connect_errno()) {
    $output = "<p>Unable to connect to the database: " . mysqli_connect_error() . "</p>";
    exit($output);
}

// Get the user data from the database
$sql = "UPDATE users SET username = ?, email = ?, password = ?, about = ?, country = ?, profilepath = ? WHERE userid = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssssssi", $username, $email, $password, $about, $country, $profilepath, $userid);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

// Close the database connection
mysqli_close($conn);

// Update the session variables
$_SESSION['username'] = $username;
$_SESSION['email'] = $email;
$_SESSION['password'] = $password;

// Redirect the user to the profile page
header('Location: profile.php');
exit();
?>
