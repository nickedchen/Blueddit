<?php
// This file is used to display the navigation bar on the top of the page
// It is included in every page

$navItems = [
    'Home' => 'index.php',
    'Discover' => 'discover.php',
    'Trending' => 'trending.php'
];
?>


<header id="masthead">
    <div class="container-fluid">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3">
            <a href="index.php"
                class="d-flex navbar-brand align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                <img src="res/favicon/Logo.svg" alt="Logo" width="40" height="40" class="d-inline-block" />
                &nbsp;Blueddit
            </a>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <?php foreach ($navItems as $navItem => $url) : ?>
                    <li>
                        <a href="<?php echo $url; ?>" class="nav-link px-2 <?php if (substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1) == $url) echo 'link-primary active'; else echo 'link-dark'; ?>"><?php echo $navItem; ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="col-md-3 text-end">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10 4a6 6 0 1 0 0 12 6 6 0 0 0 0-12zm-8 6a8 8 0 1 1 14.32 4.906l5.387 5.387a1 1 0 0 1-1.414 1.414l-5.387-5.387A8 8 0 0 1 2 10z" />
                </svg>
                &nbsp;
            </div>
        </header>
    </div>
</header>
