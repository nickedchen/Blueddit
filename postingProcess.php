<?php
session_start();
include "include/connection.php";

$title = $_POST['newTitle'];
$description = $_POST['newDescription'];
$sid = $_POST['sublueddit'];
$link = $_POST['link'];
$userid = $_SESSION['userid'];

//to prevent form mysqli injection  
$title = stripcslashes($title);
$title = mysqli_real_escape_string($conn, $title);
$description = stripcslashes($description);
$description = mysqli_real_escape_string($conn, $description);

$link = stripcslashes($link);
$link = mysqli_real_escape_string($conn, $link);

$sql = "INSERT INTO posts (title, content, userid, sid, link)
    Values (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssiss", $title, $description, $userid, $sid, $link);
$success = mysqli_stmt_execute($stmt);

//If not successful
if (!$success) {
    $_SESSION['posted'] = false;
    header('Location: newPost.php');
    mysqli_close($conn);
    die();
} else {
    //Track usage
    $sql = "INSERT INTO usageTracking (type, sid, entryDate)
    Values ('POST', $sid, CURDATE())";
    mysqli_query($conn, $sql);

    $_SESSION['posted'] = true;
    header('Location: index.php');
    mysqli_close($conn);
    die();
}
?>
