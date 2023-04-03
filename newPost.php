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

          <!-- Back -->

          <a href="javascript:history.back()" role="button"
            class="btn-block text-dark col-md-1 mb-2 mb-md-0 mx-2 mb-4 text-dark text-decoration-none fs-6">
            &LeftArrow; Back
          </a>

          <div class="post" id="newPost">
            <p id="postLocation">Create a post:</p>

            <!-- <select class name="sublueddit" id="sublueddit">
              <option value="sublueddit1">sublueddit1</option>
              <option value="sublueddit2">sublueddit2</option>
              <option value="sublueddit3">sublueddit3</option>
            </select> -->

            <form method="post" action="postingProcess.php">
              <input type="text" name="newTitle" placeholder="Place your title here!" id="newTitle" required>
              <textarea name="newDescription" id="newDescription" cols="20" rows="10"
                placeholder="Your Description Here!"></textarea>
              <!-- link/URL -->
              <input type="text" name="link" placeholder="Attach your image/external link here!" id="newLink">
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