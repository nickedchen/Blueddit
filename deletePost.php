<!-- Remove Post-->

<?php

include 'include/connection.php';

//if post, delete post

if (isset($_GET['pid'])) {
  $pid = $_GET['pid'];
  $sql = "DELETE FROM posts WHERE pid = $pid";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    header("Location: index.php");
  } else {
    $_SESSION['deletePostError'] = "Error deleting post";
  }
}

//if comment, delete comment

if (isset($_GET['cid'])) {
  $cid = $_GET['cid'];
  $sql = "DELETE FROM comments WHERE cid = $cid";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    //get corresponding pid
    $sql = "SELECT pid FROM comments WHERE cid = $cid";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $pid = $row['pid'];
    header("Location: post.php?pid=$pid");
  } else {
    $_SESSION['deleteCommentError'] = "Error deleting comment";
  }
}

