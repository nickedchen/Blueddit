<?php

//get connection

include 'include/connection.php';

// get userid from get

$userid = $_GET['userid'];

//ban user

//get ban status

$sql = "SELECT isbanned FROM users WHERE userid = $userid";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$isbanned = $row['isbanned'];

//if banned, unban

if ($isbanned == 1) {
    $sql = "UPDATE users SET isbanned = 0 WHERE userid = $userid";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        // head back to public profile
        header("Location: publicProfile.php?userid=$userid");
    } else {
        $_SESSION['banError'] = "Error unbanning user";
    }
    exit();
}

//if not banned, ban

if ($isbanned == 0) {
    $sql = "UPDATE users SET isbanned = 1 WHERE userid = $userid";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        // head back to public profile
        header("Location: publicProfile.php?userid=$userid");
    } else {
        $_SESSION['banError'] = "Error banning user";
    }
    exit();
}