<!-- Discover -->

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Discover - Blueddit</title>
  <?php include 'include/head.php'; ?>
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

    <?php include 'include/navBar.php'; ?>

    <!-- Content -->
    <div class="container-fluid">
      <div class="row pt-4">
        <!-- Sidebar -->
        <?php include 'include/sidebar.php'; ?>

        <!-- Posts -->

        <div class="col-md-6">


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
            echo "<div class='col-md-12 post d-flex flex-wrap justify-content-between'>";
            echo "<div class='-inline'><a class='text-dark post-title' href='sublueddit.php?sid=$sid'>$title</a> <p class='post-content'>$description</p></div>";
            echo "<div class='flex-end text-end'><a class='text-dark' href='sublueddit.php?sid=$sid'>View</a></div>";
            echo "</div>";
          }
          ?>

        </div>

        <!-- Panel -->
        <div class="col-md-3 flex-column">
          <?php include 'include/panel.php'; ?>
        </div>
      </div>
    </div>
  </body>
</main>

</html>