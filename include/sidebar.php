<?php
$username = $_SESSION['username'];
$profilePath = $_SESSION['profilePath'];
?>

<div class="col-md-3 mb-4" id>
    <div class="d-flex flex-column flex-shrink-1">
        <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none pb-4">
            <span class="fs-6 fw-bold">Your Sublueddits</span>
        </a>
        <ul class="nav flex-column mb-auto pt-2">
            <?php
            // Get all the sublueddits the user is subscribed to
            // by extract sids from subscribedSublueddits array of current user
            
            $sql = "SELECT subscribedSublueddits FROM users WHERE userid = ?;";
            //get userid from session
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $_SESSION['userid']);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $subscribedSublueddits);
            mysqli_stmt_store_result($stmt);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);

            //if there are sublueddits
            if ($subscribedSublueddits != null) {
                // format for subscribedSublueddits is "sid1, sid2, sid3, sid4, sid5, sid6, sid7, sid8, sid9, sid10,"
                // so we need to remove the last comma
                $subscribedSublueddits = substr($subscribedSublueddits, 0, -2);
                // convert to array
                $subscribedSublueddits = explode(", ", $subscribedSublueddits);
                //for each sublueddit, get the title and description
                foreach ($subscribedSublueddits as $sid) {
                    $sql = "SELECT title, description FROM sublueddits WHERE sid = ?;";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "s", $sid);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $title, $description);
                    mysqli_stmt_store_result($stmt);
                    mysqli_stmt_fetch($stmt);
                    mysqli_stmt_close($stmt);

                    echo '<li class="nav-item">
                    <a href="sublueddit.php?sid=' . $sid . '" class="nav-link link-dark sidebarItems fs-6 d-flex-inline" aria-current="page"> <span class="d-inline-block bg-secondary rounded-circle p-1"></span> &nbsp;' . $title . '</a>
                </li>';
                }
            } else {
                echo '<li class="nav-item">
                <a href="#" class="nav-link link-dark sidebarItems fs-6" aria-current="page">No sublueddits found</a>
                </li>';
            }
            ?>

        </ul>
        <hr class="mt-5 w-75 text-dark" />
        <div class="align-self-baseline my-2">
            <a href="publicProfile.php?userid=<?= $_SESSION['userid'] ?>"
                class="d-flex align-items-center link-dark text-decoration-none">
                <img src="<?= $profilePath ?>" alt="" width="32" height="32" class="rounded-circle me-2" />
                <strong>
                    <?= $username ?>
                </strong>
            </a>
        </div>

        <ul class="list-unstyled bg-transparent border-0 w-75 my-2">
            <?php
            // if guest
            if ($_SESSION['isguest'] == true) {
                ?>
                <li class="list-unstyled bg-transparent border-0 pb-2" style="onhover: #ff4500;">
                    <a class="text-dark" href="auth.php">Sign in to Blueddit</a>
                </li>
                <?php
            } else {
                ?>
                <li class="list-unstyled bg-transparent border-0 pb-2" style="onhover: #ff4500;">
                    <a class="text-dark" href="profile.php">Profile Settings</a>
                </li>
                <?php
                session_start();
                if (isset($_SESSION['isadmin']) && $_SESSION['isadmin'] == true) {
                    ?>
                    <li class="list-unstyled bg-transparent border-0 pb-2" style="onhover: #ff4500;">
                        <a class="text-dark" href="monthlyActivity.php">Activity Tracking</a>
                    </li>
                    <?php
                }
                ?>
                <li class="list-unstyled dropdown-item-danger border-0 text-dark bg-transparent" style="onhover: #ff4500;">
                    <a class="text-dark" href="logout.php">Sign Out</a>
                </li>
                <?php
            }
            ?>
        </ul>
        <hr class=" w-75 text-dark" />

        <!-- Make a two column grid for the to link to User Agreement, Privacy Policy, Content Policy, Moderator Code Of Conduct
        -->
        <div class="row mt-1 w-75" style="font-size:0.7rem;">
            <div class="col-md-6">
                <a href="#" class="text-decoration-none text-muted">User Agreement</a>
                <br />
                <a href="#" class="text-decoration-none text-muted">Privacy Policy</a>
            </div>
            <div class="col-md-6">
                <a href="#" class="text-decoration-none text-muted">Content Policy</a>
                <br />
                <a href="#" class="text-decoration-none text-muted">Moderator Code of Conducts</a>
            </div>
        </div>
        <div class="row mt-4 w-75" style="font-size:0.7rem;">
            <div class="col-md-12">
                <a href="#" class="text-decoration-none text-muted">© 2023 Blueddit, Inc.</a>
            </div>
        </div>
    </div>
</div>