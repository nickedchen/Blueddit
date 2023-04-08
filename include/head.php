<?php

include "connection.php";

//Check for guest
if (isset($_SESSION['guestError']) && $_SESSION['guestError'] == true) {
    ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>You are currently logged in as a guest.</strong> Please log in or sign up to access all features.
        <a href="auth.php" class="alert-link">Log in/sign up here</a>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
    $_SESSION['guestError'] = false;
}

//Check for login success
if ($_SESSION['signupFailed'] == 'true') {
    ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Account already exists.</strong> Please log in or try again with a different email.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
    $_SESSION['failedLogin'] = 'false';
}

//Check for login success
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
    header('Location: auth.php');
    die();
}

//Check for post success
if (isset($_SESSION['posted']) && $_SESSION['posted'] == true) {
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Post successfully created.</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
    unset($_SESSION['posted']);
}

if (isset($_SESSION['posted']) && $_SESSION['posted'] == false) {
    ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Post could not be created.</strong> Please try again later.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
    unset($_SESSION['posted']);
}
// Check for duplicated upvote
if (isset($_SESSION['duplicatedUpvote']) && $_SESSION['duplicatedUpvote'] == true) {
    unset($_SESSION['duplicatedUpvote']);
    ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>You have already upvoted/downvoted this post.</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
    unset($_SESSION['duplicatedUpvote']);
}

// Check for subscription success

if (isset($_SESSION['subscribed']) && $_SESSION['subscribed'] == true) {
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>You have now subscribed to this Sublueddit!</strong> Welcome to the club!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
    unset($_SESSION['subscribed']);
}

if (isset($_SESSION['subscribed']) && $_SESSION['subscribed'] == false) {
    ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <Strong>Succesfully unsubscribed from this Sublueddit.</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
    unset($_SESSION['subscribed']);
}

// Check for edit success
if (isset($_SESSION['editError']) && $_SESSION['editError'] == true) {
    ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Post could not be edited.</strong> Please try again later.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
    unset($_SESSION['editError']);
}
?>

<meta charset="utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="apple-touch-icon" href="res/favicon/Logo.svg" sizes="180x180" />

<!-- Favicons -->
<link rel="icon" href="res/favicon/Logo.ico">

<!-- Bootstrap CSS -->
<link href="res/bootstrap/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="res/css/base.css" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="res/js/sidebars.js"></script>