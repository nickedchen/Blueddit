<!-- Sublueddit -->

<html lang="en" class="home">

<head>

    <?php
    $sid = $_GET['sid'];
    $userid = $_SESSION['userid'];
    include 'include/head.php';
    //get all sublueddit details
    $sql = "SELECT s.sid, s.title, s.description
            FROM sublueddits s
            WHERE s.sid = ?;";
    $result = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($result, 'i', $sid);
    mysqli_stmt_execute($result);
    mysqli_stmt_bind_result($result, $sid, $sname, $sdescription);
    mysqli_stmt_fetch($result);

    // check if user is already subscribed by checking sid is in user's subscribed list subscribedSublueddits
    
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
                                <button class="btn btn-outline-secondary rounded-pill w-auto text-light" type="button" id="subscribeBtn"
                                    onclick="window.location.href='subscribe.php?sid=<?= $sid ?>'">
                                    Unsubscribe
                                </button>
                            <?php else: ?>
                                <button class="btn btn-secondary rounded-pill w-auto " type="button" id="subscribeBtn"
                                    onclick="window.location.href='subscribe.php?sid=<?= $sid ?>'">
                                    Subscribe
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
                    foreach ($posts as $post) { ?>
                        <div class="post">

                            <img src="<?= $post['profilepath'] ?>" alt="ppl" width="40" height="40"
                                class="rounded-circle me-2" />
                            <div class="content">

                                <span class="post-title">
                                    <?= $post['title'] ?>
                                </span>

                                <span class="post-text">
                                    <?= $post['content'] ?>
                                </span>

                                <?php

                                //if link is empty
                                if ($post['link'] == null) {
                                    ?>
                                <?php }
                                // if link is a picture
                                else if ($post['link'] != null && (strpos($post['link'], '.jpg') !== false || strpos($post['link'], '.png') !== false)) {
                                    ?>
                                        <span class="post-link">
                                            <img src="<?= $post['link'] ?>" alt="post image" width="100%" height="auto" />
                                        </span>
                                <?php } else if ($post['link'] != null) { ?>
                                            <span class="post-link">
                                                <a href="<?= $post['link'] ?>" class="text-muted">
                                                    ⎋ External Link
                                                </a>
                                            </span>
                                <?php } ?>

                                <div id="<?= $post['pid'] ?>" class="upvotes">
                                    <form method="post" action="upvotes.php">
                                        <input type="hidden" name="pid" value="<?= $post['pid'] ?>">
                                        <input type="hidden" name="upvoted" value="1">
                                        <input class="border-0 bg-info px-3 arrow text-light rounded-pill fw-bolder"
                                            type="submit" name="vote" value="&uparrow;"
                                            onclick="markArrowClickedUp(this)" />
                                    </form>
                                    <p>
                                        <?= $post['upvotes'] ?>
                                    </p>
                                    <form method="post" action="upvotes.php">
                                        <input type="hidden" name="pid" value="<?= $post['pid'] ?>">
                                        <input type="hidden" name="downvoted" value="1">
                                        <input class="border-0 bg-warning px-3 arrow text-light rounded-pill fw-bolder"
                                            type="submit" name="vote" value="&downarrow;"
                                            onclick="markArrowClickedDown(this)" />
                                    </form>
                                </div>

                                <p>Posted by
                                    <?= $post['username'] ?>
                                </p>

                                <?php if ($_SESSION['isAdmin'] == 1) { ?>
                                    <a style="float:right;" href="deletePost.php?pid=<?= $post['pid'] ?>">Delete Post</a>
                                <?php } ?>

                            </div>
                            <div class="icon"><a class="text-dark" href="post.php?pid=<?= $post['pid'] ?>">→</a></div>
                        </div>
                    <?php }
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