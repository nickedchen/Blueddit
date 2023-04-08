<!-- Sublueddit -->

<html lang="en" class="home">

<head>

    <?php
    include 'include/head.php';
    $sid = $_GET['sid'];
    $userid = $_SESSION['userid'];
    
    //get all sublueddit details
    $sql = "SELECT s.sid, s.title, s.description
            FROM sublueddits s
            WHERE s.sid = ?;";
    $result = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($result, 'i', $sid);
    mysqli_stmt_execute($result);
    mysqli_stmt_bind_result($result, $sid, $sname, $sdescription);
    mysqli_stmt_fetch($result);
    mysqli_stmt_close($result);

    $sql = "INSERT INTO usageTracking (type, sid, entryDate)
  Values ('VIEWSUB', $sid, CURDATE())";
  mysqli_query($conn, $sql);

    // check if user is already subscribed by checking sid is in user's subscribed list subscribedSublueddits
    
    $sql = "SELECT subscribedSublueddits FROM users WHERE userid = ?;";
    $result2 = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($result2, 'i', $userid);
    mysqli_stmt_execute($result2);
    mysqli_stmt_bind_result($result2, $subscribedSublueddits);
    mysqli_stmt_fetch($result2);
    mysqli_stmt_close($result2);

    if (strpos($subscribedSublueddits, $sid."") > -1) {
        $subscribed = True;
    } else {
        $subscribed = False;
    }
    ?>
    <title>
        <?= $sname ?> - Blueddit
    </title>
</head>

<main>

    <body>
        <!-- Navigation bar -->
        <?php include 'include/navBar.php'; ?>

        <!-- Content -->
        <div class="container-fluid">
            <div class="row pt-4">

                <?php include 'include/sidebar.php'; ?>

                <!-- Sublueddit -->

                <div class="col-md-6 overflow-auto">
                    <!-- Arrow to go back to Home -->
                    <a href="javascript:history.back()" role="button"
                        class="btn-block text-dark col-md-1 mb-1 text-dark text-decoration-none fs-6">
                        &LeftArrow; Back
                    </a>

                    <!-- Two column grid, description on the left and subscribe button on the right -->

                    <div class="row justify-content-md-between">
                        <div class="col-md-8 text-dark">
                            <h2 class="my-4">
                                <?= $sname ?>
                            </h2>
                            <h6 class="text-muted">
                                <?= $sdescription ?>
                            </h6>
                        </div>

                        <div class="col-md-2 align-self-end">
                            <!-- Check if user is subscribed to sublueddit -->
                            <?php if ($subscribed): ?>
                                <button class="btn btn-outline-secondary rounded-pill  text-dark" type="button"
                                    id="subscribeBtn" onclick="window.location.href='subscribe.php?sid=<?= $sid ?>'">
                                    Leave
                                </button>
                            <?php else: ?>
                                <button class="btn btn-secondary rounded-pill " type="button" id="subscribeBtn"
                                    onclick="window.location.href='subscribe.php?sid=<?= $sid ?>'">
                                    Join
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Posts -->
                    <h6 class="mt-5 text-dark">Recent Posts</h6>

                    <?php
                    //get all posts from sublueddit
                    $sql = "SELECT p.pid, p.title, p.content, p.upvotes, p.link, u.username, u.profilepath
                            FROM posts p
                            INNER JOIN users u ON p.userid = u.userid
                            WHERE p.sid = ?
                            ORDER BY p.upvotes DESC;";
                    $result = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($result, 'i', $sid);
                    mysqli_stmt_execute($result);
                    mysqli_stmt_bind_result($result, $pid, $title, $content, $upvotes, $link, $username, $profilepath);

                    $posts = array();
                    while (mysqli_stmt_fetch($result)) {
                        $posts[] = array(
                            'pid' => $pid,
                            'title' => $title,
                            'content' => $content,
                            'link' => $link,
                            'upvotes' => $upvotes,
                            'username' => $username,
                            'profilepath' => $profilepath,
                        );
                    }

                    //display all posts
                    foreach ($posts as $post) {
                        include 'postRow.php';
                    }
                    ?>
                </div>

                <div class="col-md-3">
                    <?php include 'include/panel.php'; ?>
                </div>
            </div>
        </div>
    </body>
</main>

</html>