<?php
include "include/connection.php";

// Check if connection to database is successful
if ($error != null) {
    exit("<p>Unable to reach the database!</p>");
}

// Get post id and user id
$pid = $_POST['pid'];
$userid = $_SESSION['userid'];

//if guest, guest error
if ($_SESSION['isguest'] == true) {
    $_SESSION['guestError'] = true;
    exit(header("Location: " . $_SERVER['HTTP_REFERER']));
}

// Check if user has already upvoted the post
$stmt = $conn->prepare("SELECT upvoted_users FROM posts WHERE pid = ?");
$stmt->bind_param("i", $pid);
$stmt->execute();
$upvoted_users = $stmt->get_result()->fetch_assoc()['upvoted_users'];
if (strpos($upvoted_users, $userid) > -1) {
    $_SESSION['duplicatedUpvote'] = True;
    exit(header("Location: " . $_SERVER['HTTP_REFERER']));
}

//Get SID
$stmt = $conn->prepare("SELECT sid FROM posts WHERE pid = ?");
$stmt->bind_param("i", $pid);
$stmt->execute();
$sid = $stmt->get_result()->fetch_assoc()['sid'];

// Check if post is upvoted or downvoted
$upvoted = isset($_POST['upvoted']);
$downvoted = isset($_POST['downvoted']);
$_SESSION['duplicatedUpvote'] = False;

if ($upvoted) {
    // Increment upvotes and user's total upvotes
    $conn->query("UPDATE posts SET upvotes = upvotes + 1 WHERE pid = $pid");
    $conn->query("UPDATE users SET totalUpvotes = totalUpvotes + 1 WHERE userid = (SELECT userid FROM posts WHERE pid = $pid)");
} else if ($downvoted) {
    // Decrement upvotes and user's total upvotes
    $conn->query("UPDATE posts SET upvotes = GREATEST(upvotes - 1, 0) WHERE pid = $pid");
    $conn->query("UPDATE users SET totalUpvotes = GREATEST(totalUpvotes - 1, 0) WHERE userid = (SELECT userid FROM posts WHERE pid = $pid)");
}
//Track usage
$sql = "INSERT INTO usageTracking (type, sid, entryDate)
Values ('VOTES', $sid, CURDATE())";
mysqli_query($conn, $sql);

// Add user to upvoted_users list
$conn->query("UPDATE posts SET upvoted_users = CONCAT(upvoted_users, '$userid,') WHERE pid = $pid");

// Close the connection and redirect to the last page
$conn->close();
exit(header("Location: " . $_SERVER['HTTP_REFERER']));

?>