<!-- Discover -->

<!DOCTYPE html>
<html lang="en" class="home">

<?php include 'include/head.php'; ?>

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

    <?php include 'include/navBar.php'; ?>

    <!-- Content -->
    <div class="container-fluid">
      <div class="row pt-4">
        <!-- Sidebar -->
        <?php include 'include/sidebar.php'; ?>

        <!-- Posts -->

        <div class="col-md-6">

          <!-- <div class="container">
            <div class="flex-row align-items-center">

              <div class="col-md-12 post">
                <span class="post-title">OrangeFanClub</span>
                <span class="content">Fresh orange everyday</span>
              </div>

              <div class="col-md-12 post ">
                <span class="post-title">CatMemeCentral</span>
                <span class="content">We love cat memes</span>
              </div>

              <div class="col-md-12 post ">
                <span class="post-title">DogMemeCentral</span>
                <span class="content">We love dog memes</span>
              </div>

              <div class="col-md-12 post">
                <span class="post-title">PineapplePlayground</span>
                <span class="content">Fresh pineapple everyday</span>
                </div>

            </div>
          </div> -->

          <!-- sql to get all sublueddits-->

          <?php

          $sql = "SELECT sid, title, description FROM sublueddits;";
          $stmt = mysqli_prepare($conn, $sql);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_bind_result($stmt, $sid, $title, $description);
          mysqli_stmt_store_result($stmt);
          $result = mysqli_stmt_num_rows($stmt);

          // if there are no sublueddits
          if ($result == 0) {
            echo "<div class='col-md-12 post'>";
            echo "<span class='post-title'>No sublueddits found</span>";
            echo "</div>";
          }

          // if there are sublueddits
          while (mysqli_stmt_fetch($stmt)) {
            echo "<div class='col-md-12 post'>";
            echo "<span class='post-title'>$title</span>";
            echo "<span class='content'>$description</span>";
            echo "</div>";
          }
          ?>

        </div>

        <!-- Panel -->
        <div class="col-md-3 flex-column">
          <div class="dropdown">
            <!-- new post button -->
            <a href="newPost.php">
              <button class="btn btn-secondary border-0" id="newPostBtn" type="button">
                New Post
              </button>
            </a>
            <button class="btn btn-primary border-0 dropdown-toggle" type="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Sort
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