<?php

// Get inputted comments from the form
$comment = $_POST['comment'];
$pid = $_POST['pid'];
session_start();
$userid = $_SESSION['userid'];

// Connect to the database
include 'include/connection.php';

// Check for database connection errors
if (mysqli_connect_errno()) {
    $output = "<p>Unable to connect to the database: " . mysqli_connect_error() . "</p>";
    exit($output);
}

//if guest, guest error
if ($_SESSION['isguest'] == true) {
    $_SESSION['guestError'] = true;
    exit(header('Location: post.php?pid=' . $pid));
}

// Prepare and execute the SQL statement to insert the comment
$sql = "INSERT INTO comments (content, pid, userid) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sii", $comment, $pid, $userid);
if (!mysqli_stmt_execute($stmt)) {
    $output = "<p>Unable to add comment to the database: " . mysqli_error($conn) . "</p>";
    exit($output);
}

// Close the statement
mysqli_stmt_close($stmt);

// Close the database connection
mysqli_close($conn);

// Redirect the user to the post page
header('Location: post.php?pid=' . $pid);
exit();

?>