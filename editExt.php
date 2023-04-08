<?php
include 'include/connection.php';   
// For posts
if (isset($_POST['pid'])) {
    $pid = $_POST['pid'];
    $title = $_POST['title'];
    $link = $_POST['link'];
    $content = $_POST['content'];

    $sql = "UPDATE posts SET title = '$title', link = '$link', content = '$content' WHERE pid = $pid";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        $_SESSION['editError'] = true;
    }
    // redirect to post page
    header("Location: post.php?pid=$pid");
}

// For comments

if (isset($_POST['cid'])) {
    $cid = $_POST['cid'];
    $content = $_POST['content'];

    $sql = "UPDATE comments SET content = '$content' WHERE cid = $cid";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        $_SESSION['editError'] = true;
    }
    // get the corresponding pid
    $sql = "SELECT pid FROM comments WHERE cid = $cid";
    $result = mysqli_query($conn, $sql);
    $pid = mysqli_fetch_assoc($result)['pid'];
    // redirect to post page
    header("Location: post.php?pid=$pid");

}
?>