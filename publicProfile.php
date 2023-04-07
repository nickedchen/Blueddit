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
    $sql = "SELECT userid, username, email, password, profilepath, isguest, isadmin FROM users WHERE userid = $userid;";
    $result = mysqli_prepare($conn, $sql);
    mysqli_stmt_execute($result);
    mysqli_stmt_bind_result($result, $userid, $username, $email, $password, $profilepath, $isguest, $isadmin);

    while (mysqli_stmt_fetch($result)) {
        $user = array(
            'userid' => $userid,
            'username' => $username,
            'email' => $email,
            'profilepath' => $profilepath,
            'isguest' => $isguest,
            'isadmin' => $isadmin,
        );
    }

    // get posts
    $sql2 = "SELECT p.pid, p.title, p.content, p.upvotes, p.link, u.username, u.profilepath, p.sid, s.title
FROM posts p
INNER JOIN users u ON p.userid = u.userid
INNER JOIN sublueddits s ON p.sid = s.sid
WHERE u.userid = $userid;";
    $result = mysqli_prepare($conn, $sql2);
    mysqli_stmt_execute($result);
    mysqli_stmt_bind_result($result, $pid, $title, $content, $upvotes, $link, $username, $profilepath, $sid, $stitle);

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
            'sid' => $sid,
            'stitle' => $stitle,
        );
    }
    mysqli_stmt_close($stmt);

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
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="<?php echo $user['profilepath']; ?>" class="img-fluid rounded-circle"
                                        alt="Profile Picture">
                                </div>
                                <div class="col-md-9">
                                    <h3>
                                        <?php echo $user['username']; ?>
                                    </h3>
                                    <p>
                                        <?php echo $user['email']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-body">
                            <h3>Posts</h3>
                            <?php
                            foreach ($posts as $post) {
                                include 'include/postRow.php';
                            }
                            ?>
                        </div>
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