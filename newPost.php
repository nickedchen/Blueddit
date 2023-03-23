<!-- Home -->

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
    <?php include 'include/navbar.php'; ?>
    <!-- Content -->
    <div class="container-fluid">
      <div class="row pt-4">
        <!-- Sidebar -->
        <?php include 'include/sidebar.php'; ?>
        <!-- Posts -->
        <div class="col-md-6 overflow-auto">
          <div class="post" id="newPost">
            <p id="postLocation">Posting In: CatMemeCentral</p>
            <form>
              <input type="text" name="newTitle" placeholder="Your Title Here!" id="newTitle">
              <textarea name="newDescription" id="newDescription" cols="20" rows="10"
                placeholder="Your Description Here!"></textarea>
              <div id="markdownBar">
                <span class="markdownContent"><b>B</b></span>
                <span class="markdownContent"><i>i</i></span>
                <span class="markdownContent">Link</span>
                <span class="markdownContent"><i>etc</i></span>
                <span class="markdownContent"><i>etc</i></span>
                <span class="markdownContent" id="lastMarkdown"><i>etc</i></span>
              </div>
              <button type="submit" class="text-white text-center">
                <span>Post It!</span>
              </button>
            </form>
          </div>

        </div>
      </div>
  </body>
</main>

</html>