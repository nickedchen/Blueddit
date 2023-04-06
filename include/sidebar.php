<?php


$username = $_SESSION['username'];
$profilePath = $_SESSION['profilePath'];

?>

<div class="col-md-3 mb-4" id>
    <div class="d-flex flex-column flex-shrink-1">
        <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none pb-4">
            <span class="fs-6 fw-bold">Subscriptions&nbsp;&#8594;</span>
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
                    <a href="sublueddit.php?sid=' . $sid . '" class="nav-link link-dark sidebarItems fs-6" aria-current="page">' . $title . '</a>
                </li>';
                }
            } else {
                echo '<li class="nav-item">
                <a href="#" class="nav-link link-dark sidebarItems fs-6" aria-current="page">No sublueddits found</a>
                </li>';
            }
            ?>

        </ul>
        <div class="dropdown align-self-baseline mt-5">
            <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle"
                id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="<?php echo $profilePath ?>" alt="" width="32" height="32" class="rounded-circle me-2" />
                <strong>
                    <?= $username ?>
                </strong>
            </a>
            <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                <li><a class="dropdown-item" href="profile.php">Profile Settings</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
            </ul>
        </div>
    </div>
</div>