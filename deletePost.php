<!-- Remove Post-->

<?php

include 'include/connection.php';

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