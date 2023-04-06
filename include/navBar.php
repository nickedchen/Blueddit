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
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-1">
            <a href="index.php"
                class="d-flex navbar-brand align-items-center col-md-3 mb-md-0 text-dark text-decoration-none">
                <img src="res/favicon/Logo.svg" alt="Logo" width="40" height="40" class="d-inline-block" />
                &nbsp;Blueddit
            </a>

            <ul class="nav col-12 col-md-auto justify-content-center mb-md-0">
                <?php foreach ($navItems as $navItem => $url): ?>
                    <li>
                        <a href="<?php echo $url; ?>" class="nav-link px-2 <?php if (substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1) == $url)
                               echo 'link-primary active';
                           else
                               echo 'link-dark'; ?>"><?php echo $navItem; ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <form class="col-md-3 d-flex navbar-form navbar-right" method="GET" role="search" action="searchResult.php">
                <div class="input-group flex-end text-end" id="search">
                    <input type="search" class="form-control bg-transparent text-dark rounded" placeholder="Search a post..."
                        aria-label="Search" name="searchTerm" />
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </form>
        </header>
        <hr class="text-dark"></hr>
    </div>

</header>