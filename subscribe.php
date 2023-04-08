<?php
include 'include/connection.php';

$userid = $_SESSION['userid'];
$sid = $_GET['sid'];

// if guest, guest error
if ($_SESSION['isguest'] == true) {
    $_SESSION['guestError'] = true;
    exit(header('Location: sublueddit.php?sid=' . $sid));
}

$sql = "SELECT subscribedSublueddits FROM users WHERE userid = ?;";
$result = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($result, 'i', $userid);
mysqli_stmt_execute($result);
mysqli_stmt_bind_result($result, $subscribedSublueddits);
mysqli_stmt_fetch($result);
mysqli_stmt_close($result);

if (strpos($subscribedSublueddits, $sid) !== False) {
    $subscribed = True;
} else {
    $subscribed = False;
}

if ($subscribed) {
  // User is already subscribed, so we need to unsubscribe them
  // remove the sid from the string
  $subscribedSublueddits = str_replace($sid . ', ', '', $subscribedSublueddits);
  $_SESSION['subscribed'] = False;
} else {
  // User is not subscribed, so we need to subscribe them
  if (!empty($subscribedSublueddits)) {
      // if the string is not empty, remove the last comma and space
      $subscribedSublueddits = substr($subscribedSublueddits, 0, -2);
      // append the sid to the end of the string
      $subscribedSublueddits .= ', ' . $sid . ', ';
  } else {
      // if the string is empty, just append the sid
      $subscribedSublueddits .= $sid . ', ';
  }
  $_SESSION['subscribed'] = True;
}
$sql = "UPDATE users SET subscribedSublueddits = ? WHERE userid = ?;";
$result = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($result, 'si', $subscribedSublueddits, $userid);
mysqli_stmt_execute($result);
mysqli_stmt_close($result);

// Redirect the user back to the sublueddit they were viewing
header("Location: sublueddit.php?sid=$sid");
exit();

?>