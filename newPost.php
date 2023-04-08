<!-- New post -->
<!DOCTYPE html>
<html lang="en" class="home">

<head>
  <?php include 'include/head.php';
  //get all sublueddits
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  $error = mysqli_connect_error();
  //if guest, guest error
  if ($_SESSION['isguest'] == true) {
    $_SESSION['guestError'] = true;
    exit(header("Location: " . $_SERVER['HTTP_REFERER']));
  }

  //to prevent form mysqli injection
  $sql = "SELECT * FROM sublueddits;";
  $result = mysqli_prepare($conn, $sql);
  mysqli_stmt_execute($result);
  mysqli_stmt_bind_result($result, $sid, $name, $description);

  $sublueddits = array();
  while (mysqli_stmt_fetch($result)) {
    $sublueddits[] = array(
      'sid' => $sid,
      'name' => $name,
      'description' => $description,
    );
  }
  ?>
  <title>Create a post - Blueddit</title>
</head>
<main>

  <body>
    <!-- Navigation bar -->
    <?php include 'include/navBar.php'; ?>
    <!-- Content -->
    <div class="container-fluid">
      <div class="row pt-4">
        <!-- Sidebar -->
        <?php include 'include/sidebar.php'; ?>
        <!-- Posts -->
        <div class="col-md-6 overflow-auto">
          <!-- Back -->
          <a href="javascript:history.back()" role="button"
            class="btn-block text-dark col-md-1 mb-2 mb-md-0 mx-2 mb-4 text-dark text-decoration-none fs-6">
            &LeftArrow; Back
          </a>
          <div class="post" id="newPost">
            <p id="postLocation">Create a post:</p>
            <form method="post" action="postingProcess.php">
              <label for="sublueddit" class="ms-1">Choose a sublueddit:</label>
              <?php
              echo "<select name='sublueddit' id='sid' class='form-select my-2 bg-transparent text-dark' required>";
              foreach ($sublueddits as $sublueddit) {
                echo "<option value='" . $sublueddit['sid'] . "' style='color:black;'>" . $sublueddit['name'] . "</option>";
              }
              echo "</select>";
              ?>
              <input type="text" name="newTitle" placeholder="Place your title here!" id="newTitle"
                class="bg-transparent text-dark" required>
              <textarea name="newDescription" id="newDescription" cols="20" rows="10" class="bg-transparent text-dark"
                placeholder="Your Description Here!"></textarea>
              <!-- link/URL -->
              <input type="text" name="link" class="bg-transparent text-dark"
                placeholder="Place your image/external link here!" id="newLink">
              <button type="submit" class="text-white text-center">
                <span>Post It!</span>
              </button>
            </form>
          </div>
        </div>
        <div class="col-md-3">
          <?php include 'include/panel.php'; ?>
        </div>
      </div>
    </div>
  </body>
</main>

</html>