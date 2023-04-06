<!-- Home -->

<!DOCTYPE html>
<html lang="en" class="home">

<head>
  <?php include 'include/head.php'; ?>
  <title>Home - Blueddit</title>
</head>

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

          <?php
          //connect to database
          if ($error != null) {
            $output = "<p>Unable to reach the database!</p>";
            exit($output);
          } else {
            //display posts and which sublueddit they belong to
            $stmt = $conn->prepare("SELECT p.pid, p.title, p.link, p.upvotes, p.content, p.sid, s.title AS stitle, u.username, u.profilepath
            FROM posts p
            INNER JOIN sublueddits s ON p.sid = s.sid
            INNER JOIN users u ON p.userid = u.userid
            ORDER BY p.pid DESC");
            $stmt->execute();
            $result = $stmt->get_result();
            $posts = [];
            while ($row = $result->fetch_assoc()) {
              array_push($posts, [
                'pid' => $row['pid'],
                'title' => $row['title'],
                'link' => $row['link'],
                'upvotes' => $row['upvotes'],
                'content' => $row['content'],
                'sid' => $row['sid'],
                'stitle' => $row['stitle'],
                'username' => $row['username'],
                'profilepath' => $row['profilepath']
              ]);
            }
            foreach ($posts as $post) { ?>
              <div class="post">

                <img src="<?= $post['profilepath'] ?>" alt="ppl" width="40" height="40" class="rounded-circle me-2" />
                <div class="content">

                  <span class="post-title">
                    <?= $post['title'] ?>
                  </span>

                  <span class="post-text">
                    <?= $post['content'] ?>
                  </span>

                  <?php
                  // if link is a picture
                  if ($post['link'] != null && (strpos($post['link'], '.jpg') !== false || strpos($post['link'], '.png') !== false)) {
                    ?>
                    <span class="post-link">
                      <img src="<?= $post['link'] ?>" alt="post image" width="100%" height="auto" />
                    </span>
                  <?php } else if ($post['link'] != null) { ?>
                      <span class="post-link">
                        <a href="<?= $post['link'] ?>" class="text-muted">
                          ⎋ External Link
                        </a>
                      </span>
                  <?php } ?>


                  <div id="<?= $post['pid'] ?>" class="upvotes">
                    <form method="post" action="upvotes.php">
                      <input type="hidden" name="pid" value="<?= $post['pid'] ?>">
                      <input type="hidden" name="upvoted" value="1">
                      <input class="border-0 bg-info px-3 arrow text-light rounded-pill fw-bolder" type="submit" name="vote" value="&uparrow;" onclick="markArrowClickedUp(this)" />
                    </form>
                    <p>
                      <?= $post['upvotes'] ?>
                    </p>
                    <form method="post" action="upvotes.php">
                      <input type="hidden" name="pid" value="<?= $post['pid'] ?>">
                      <input type="hidden" name="downvoted" value="1">
                      <input class="border-0 bg-warning px-3 arrow text-light rounded-pill fw-bolder" type="submit" name="vote" value="&downarrow;" onclick="markArrowClickedDown(this)" />
                    </form>
                  </div>

                  <p>Posted by
                    <?= $post['username'] ?>
                    in
                    <a class="text-muted" href="sublueddit.php?sid=<?= $post['sid'] ?>">
                      b/<?= $post['stitle'] ?>
                  </p>

                  <?php if ($_SESSION['isAdmin'] == 1) { ?>
                    <a style="float:right;" href="deletePost.php?pid=<?= $post['pid'] ?>">Delete Post</a>
                  <?php } ?>

                </div>
                <div class="icon"><a class="text-dark" href="post.php?pid=<?= $post['pid'] ?>">→</a></div>
              </div>
            <?php }
          }
          ?>
        </div>

        <!-- Panel -->
        <div class="col-md-3">
          <div class="dropdown">
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


<script>
  function markArrowClickedUp(arrow) {
    arrow.classList.toggle('arrow-clicked-up');
  }

  function markArrowClickedDown(arrow) {
    arrow.classList.toggle('arrow-clicked-down');
  }
</script>

</html>