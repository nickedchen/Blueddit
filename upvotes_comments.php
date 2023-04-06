<?php
include "include/connection.php";

// Check if connection to database is successful
if ($error != null) {
    exit("<p>Unable to reach the database!</p>");
}

// Get cid and user id
$cid = $_POST['cid'];
$userid = $_SESSION['userid'];

// Check if user has already upvoted the comment
$stmt = $conn->prepare("SELECT upvoted_users FROM comments WHERE cid = ?");
$stmt->bind_param("i", $cid);
$stmt->execute();
$upvoted_users = $stmt->get_result()->fetch_assoc()['upvoted_users'];
if (strpos($upvoted_users, $userid) !== false) {
    $_SESSION['duplicatedUpvote'] = True;
    exit(header("Location: " . $_SERVER['HTTP_REFERER']));
}

// Check if comment is upvoted or downvoted
$upvoted = isset($_POST['upvoted']);
$downvoted = isset($_POST['downvoted']);
$_SESSION['duplicatedUpvote'] = False;


if ($upvoted) {
    // Increment upvotes and user's total upvotes
    $conn->query("UPDATE comments SET upvotes = upvotes + 1 WHERE cid = $cid");
    $conn->query("UPDATE users SET totalUpvotes = totalUpvotes + 1 WHERE userid = (SELECT userid FROM comments WHERE cid = $cid)");
} else if ($downvoted) {
    // Decrement upvotes and user's total upvotes
    $conn->query("UPDATE comments SET upvotes = GREATEST(upvotes - 1, 0) WHERE cid = $cid");
    $conn->query("UPDATE users SET totalUpvotes = GREATEST(totalUpvotes - 1, 0) WHERE userid = (SELECT userid FROM comments WHERE cid = $cid)");
}

// Add user to upvoted_users list
$conn->query("UPDATE comments SET upvoted_users = CONCAT(upvoted_users, '$userid,') WHERE cid = $cid");

// Close the connection and redirect to the last page
$conn->close();
exit(header("Location: " . $_SERVER['HTTP_REFERER']));