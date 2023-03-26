<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['userid'])) {
    header('Location: login.php');
    exit();
}

// Check if form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Connect to database
    $servername = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "database_name";
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check for errors in database connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $about = mysqli_real_escape_string($conn, $_POST['about']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $userid = $_SESSION['userid'];

    // Update user data in database
    $sql = "UPDATE users SET username=?, email=?, password=?, about=?, country=? WHERE userid=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, $username, $email, $password, $about, $country, $userid);

    if (mysqli_stmt_execute($stmt)) {
        // Success message
        $_SESSION['success'] = "Profile updated successfully";
    } else {
        // Error message
        $_SESSION['error'] = "Error updating profile: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

// Redirect back to profile page
header("Location: profile.php");
exit();
?>
