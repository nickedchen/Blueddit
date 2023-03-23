<!-- Home -->

<!DOCTYPE html>
<html lang="en" class="home">

<?php include 'include/head.php'; ?>

<main>

  <body>
    <!-- Navigation bar -->

    <?php include 'include/navbar.php'; ?>

    <!-- Content -->
    <div class="container-fluid">
      <div class="row pt-4">
        <!-- Sidebar -->
        <?php include 'include/sidebar.php'; ?>

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
            <button class="btn btn-primary border-0 dropdown-toggle" type="button" data-bs-toggle="dropdown"
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