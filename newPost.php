<!-- New post -->

<!DOCTYPE html>

<html lang="en" class="home">

<?php include 'include/head.php'; ?>

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
          <div class="post" id="newPost">
            <p id="postLocation">What's on your mind?</p>
            <form method="post" action="postingProcess.php">
              <input type="text" name="newTitle" placeholder="Your Title Here!" id="newTitle" required>
              <textarea name="newDescription" id="newDescription" cols="20" rows="10"
                placeholder="Your Description Here!"></textarea>
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