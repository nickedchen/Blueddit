<!-- Home -->

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

        <?php include 'include/sidebar.php'; ?>

        <!-- Posts -->

        <div class="col-md-6 overflow-auto">

          <!-- <div class="post">
            <img src="res/img/p1.svg" alt="ppl" width="40" height="40" class="rounded-circle me-2" />
            <div class="content">
              <span class="post-title">Mom said my new cat is ugly [OC]</span>
              <span class="post-text">tell her to apologize to your cat. right now.</span>
            </div>
            <div class="icon">→</div>
          </div> -->

          <?php
          //connect to database
          if ($error != null) {
            $output = "<p>Unable to reach the database!</p>";
            exit($output);
          } else {
            //display posts
            $stmt = $conn->prepare("SELECT pid, title, link, upvotes FROM posts ORDER BY pid DESC LIMIT 10;");
            $stmt->execute();
            $result = $stmt->get_result();
            $posts = [];
            while ($row = $result->fetch_assoc()) {
              array_push($posts, [
                'pid' => $row['pid'],
                'title' => $row['title'],
                'link' => $row['link'],
                'upvotes' => $row['upvotes']
              ]);
            }
            foreach ($posts as $post) { ?>
              <div class="post">
                <div class="content">

                  <span class="post-title">
                    <?= $post['title'] ?>
                  </span>

                  <div id="<?= $post['pif'] ?>" class="upvotes">
                    <a id="up" onclick="vote('up', <?= $post['pid'] ?>)">&uarr;</a>
                    <p>
                      <?= $post['upvotes'] ?>
                    </p>
                    <a id="down" onclick="vote('down', <?= $post['pid'] ?>)">&darr;</a>
                  </div>

                  <p><a href="post.php?pid=<?= $post['pid'] ?>">Comments</a></p>

                  <?php if ($_SESSION['isAdmin'] == 1) { ?>
                    <a style="float:right;" href="deletePost.php?pid=<?= $post['pid'] ?>">Delete Post</a>
                  <?php } ?>
                  
                </div>
                <div class="icon"><a href="http://<?= $post['link'] ?>">→</a></div>
              </div>
            <?php }
          }
          ?>
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