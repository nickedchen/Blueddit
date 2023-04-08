<!-- public profile page -->

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include 'include/head.php';
    $userid = $_GET['userid'];
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $error = mysqli_connect_error();

    //to prevent form mysqli injection
    $userid = stripcslashes($userid);
    $userid = mysqli_real_escape_string($conn, $userid);

    //get user details
    $sql = "SELECT userid, username, email, about, profilepath, isguest, isadmin, totalUpvotes, isbanned
            FROM users
            WHERE userid = $userid;"
    ;
    $result = mysqli_prepare($conn, $sql);
    mysqli_stmt_execute($result);
    mysqli_stmt_bind_result($result, $userid, $username, $email, $about, $profilepath, $isguest, $isadmin, $totalUpvotes, $isbanned );
    while (mysqli_stmt_fetch($result)) {
        $user = array(
            'userid' => $userid,
            'username' => $username,
            'email' => $email,
            'about' => $about,
            'profilepath' => $profilepath,
            'isguest' => $isguest,
            'isadmin' => $isadmin,
            'totalUpvotes' => $totalUpvotes, 
            'isbanned' => $isbanned
        );
    }
    ?>
    <title>
        <?php echo $user['username']; ?> - Blueddit
    </title>

</head>

<main>

    <body>
        <!-- Navigation bar -->
        <?php include 'include/navBar.php'; ?>

        <!-- Page Content -->
        <div class="container-fluid">
            <div class="row pt-4">
                <!-- Sidebar -->
                <?php include 'include/sidebar.php'; ?>
                <!-- Posts -->
                <div class="col-md-6">
                    <!--back button-->
                    <a href="javascript:history.back()" role="button" class="btn-block text-dark col-md-1 mb-1 text-dark text-decoration-none fs-6">
                        ← Back
                    </a>
                    <div class="card my-4" style="border-radius: 1.5rem;">
                        <div class="card-body pt-4">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="<?php echo $user['profilepath']; ?>" class="img-fluid rounded-circle"
                                        alt="Profile Picture" width="100px" height="100px">
                                </div>
                                <div class="col-md-9">
                                    <h2>
                                        <?php echo $user['username']; ?>
                                    </h2>
                                    <!-- if is admin, display an admin badge -->
                                    <?php if ($user['isadmin']) { ?>
                                        <span class="badge rounded-pill bg-danger">Admin</span>
                                    <?php } ?>
                                    <!-- if is banned user, display a banned badge -->
                                    <?php if ($user['isbanned'] == 1) { ?>
                                        <span class="badge rounded-pill bg-secondary">Banned</span>
                                    <?php } ?>

                                    <!-- display total upvotes -->
                                    <p class="mt-2">
                                        <span class="badge rounded-pill bg-primary">
                                            <?php echo $user['totalUpvotes']; ?> 
                                        </span>
                                        Total Upvotes
                                    </p>
                                    <p class="mt-2">
                                        <?php echo $user['about']; ?>
                                    </p>
                                    <!-- if signed in as admin, display a button to ban user -->
                                    <?php if (isset($_SESSION['isadmin']) && $_SESSION['isadmin']) { ?>
                                        <a href="banUser.php?userid=<?php echo $user['userid']; ?>" class="btn btn-danger">Ban/Unbanned User</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ml-2 mt-4">
                        <h4 text-dark> Recent Posts</h4>

                        <?php
                        // get posts from the user
                        $sql = "SELECT p.pid, p.title, p.link, p.upvotes, p.content, p.sid, s.title AS stitle, u.username, u.profilepath
                                FROM posts p
                                INNER JOIN sublueddits s ON p.sid = s.sid
                                INNER JOIN users u ON p.userid = u.userid
                                WHERE p.userid = $userid;";

                        $result = mysqli_prepare($conn, $sql);
                        mysqli_stmt_execute($result);
                        mysqli_stmt_bind_result($result, $pid, $title, $link, $upvotes, $content, $sid, $stitle, $username, $profilepath);
                        $posts = [];
                        while (mysqli_stmt_fetch($result)) {
                            array_push($posts, [
                                'pid' => $pid,
                                'title' => $title,
                                'link' => $link,
                                'upvotes' => $upvotes,
                                'content' => $content,
                                'sid' => $sid,
                                'stitle' => $stitle,
                                'username' => $username,
                                'profilepath' => $profilepath
                            ]);
                        }
                        foreach ($posts as $post) {
                            include 'postRow.php';
                        }
                        ?>
                    </div>



                </div>
                <!-- panel -->
                <div class="col-md-3 flex-column">
                    <?php include 'include/panel.php'; ?>

                </div>
            </div>
        </div>
    </body>

</main>