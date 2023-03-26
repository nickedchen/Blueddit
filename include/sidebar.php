<?php

    $username = $_SESSION['username'];
    $profilePath = $_SESSION['profilePath'];
?>

<div class="col-md-3">
    <div class="d-flex flex-column flex-shrink-1">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none pb-4">
            <span class="fs-6 fw-bold">Subscriptions&nbsp;&#8594;</span>
        </a>
        <ul class="nav flex-column mb-auto pt-2">
            <li class="nav-item">
                <a href="#" class="nav-link link-dark sidebarItems fs-6" aria-current="page">OrangeFanClub</a>
            </li>
            <li>
                <a href="#" class="nav-link link-dark sidebarItems fs-6">PineapplePlayground</a>
            </li>
            <li>
                <a href="#" class="nav-link link-dark sidebarItems fs-6">RedditRivals</a>
            </li>
            <li>
                <a href="#" class="nav-link link-dark sidebarItems fs-6">CatMemeCentral</a>
            </li>
            <li>
                <a href="#" class="nav-link link-dark sidebarItems fs-6">DogeMemeCentral</a>
            </li>
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