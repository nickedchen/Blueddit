<!-- Home -->

<!DOCTYPE html>
<html lang="en" class="home">

  <head>
    <meta charset="utf-8" />
    <title>Blueddit</title>

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="apple-touch-icon" href="res/favicon/Logo.svg" sizes="180x180" />

    <!-- Favicons -->
    <link rel="icon" href="res/favicon/Logo.svg" sizes="32x32" type="image/svg" />

    <!-- Bootstrap CSS -->
    <link href="res/bootstrap/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="res/css/base.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="res/js/sidebars.js"></script>
  </head>

  <main>
    <body>
    <?php
	//Check for login
	session_start();

	if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
    		header('Location: auth.php');
	    	die();
	}
    ?>
      <!-- Navigation bar -->
      <header id="masthead">
        <div class="container-fluid">
          <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3">
            <a
              href="index.php"
              class="d-flex navbar-brand align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
              <img src="res/favicon/Logo.svg" alt="Logo" width="40" height="40" class="d-inline-block" />
              &nbsp;Blueddit
            </a>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
              <li>
                <a href="index.php" class="nav-link px-2 link-dark">Home</a>
              </li>
              <li><a href="discover.php" class="nav-link px-2 link-secondary active">Discover</a></li>
              <li><a href="trending.php" class="nav-link px-2 link-dark">Trending</a></li>
            </ul>

            <div class="col-md-3 text-end">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M10 4a6 6 0 1 0 0 12 6 6 0 0 0 0-12zm-8 6a8 8 0 1 1 14.32 4.906l5.387 5.387a1 1 0 0 1-1.414 1.414l-5.387-5.387A8 8 0 0 1 2 10z" />
              </svg>
              &nbsp;
              <button type="button" class="text-white text-center">
                <span>+&nbsp;Post</span>
              </button>
            </div>
          </header>
        </div>
      </header>

      <!-- Content -->
      <div class="container-fluid">
        <div class="row pt-4">
          <!-- Sidebar -->
          <div class="col-md-3">
            <div class="d-flex flex-column flex-shrink-1">
              <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none pb-4">
                <span class="fs-5 fw-bold">Subscriptions&nbsp;&#8594;</span>
              </a>
              <ul class="nav flex-column mb-auto pt-2">
                <li class="nav-item">
                  <a href="#" class="nav-link link-dark sidebarItems" aria-current="page">&#9675; OrangeFanClub</a>
                </li>
                <li>
                  <a href="#" class="nav-link link-dark sidebarItems">&#9675; PineapplePlayground</a>
                </li>
                <li>
                  <a href="#" class="nav-link link-dark sidebarItems">&#9675; RedditRivals</a>
                </li>
                <li>
                  <a href="#" class="nav-link link-dark sidebarItems">&#9675; CatMemeCentral</a>
                </li>
                <li>
                  <a href="#" class="nav-link link-dark sidebarItems">&#9675; DogeMemeCentral</a>
                </li>
              </ul>
              <div class="dropdown align-self-baseline mt-5">
                <a
                  href="#"
                  class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle"
                  id="dropdownUser2"
                  data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="res/img/ted.svg" alt="" width="40" height="" class="rounded-circle me-2" />
                  <strong>Ted</strong>
                </a>
                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                  <li><a class="dropdown-item" href="settings.html">Settings</a></li>
                  <li><a class="dropdown-item" href="profile.html">Profile</a></li>
                  <li><hr class="dropdown-divider" /></li>
                  <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
                </ul>
              </div>
            </div>
          </div>

          <!-- Posts -->

          <div class="col-md-6">

            <div class="container">
                <div class="row">

                  <div class="col-md-6 post ">
                    <span class="post-title">OrangeFanClub</span>
                    <span class="content">Fresh orange everyday</span>
                  </div>
              
                  <div class="col-md-6 post">
                    <span class="post-title">OrangeFanClub</span>
                    <span class="content">Fresh orange everyday</span>
                  </div>
              
                </div>
              </div>
          </div>

          <!-- Panel -->
          <div class="col-md-3">
            <div class="dropdown">
              <button
                class="btn btn-primary border-0 dropdown-toggle"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false">
                Top
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">New</a></li>
                <li><a class="dropdown-item" href="#">Recommended</a></li>
                <li><a class="dropdown-item" href="#">Hot</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </body>
  </main>
</html>
