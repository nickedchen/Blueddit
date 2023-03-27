<!-- post  -->

<!DOCTYPE html>
<html lang="en" class="home">

<head>
  <title>Post detail</title>
  <?php include 'include/head.php';
  $pid = $_GET['pid'];
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  $error = mysqli_connect_error();

  //to prevent form mysqli injection  
  
  $pid = stripcslashes($pid);
  $pid = mysqli_real_escape_string($conn, $pid);

  //get post details
  $sql = "SELECT p.pid, p.title, p.content, p.upvotes, p.link, u.username, u.profilepath
  FROM posts p
  INNER JOIN users u ON p.userid = u.userid
  WHERE p.pid = $pid;";
  $result = mysqli_prepare($conn, $sql);
  mysqli_stmt_execute($result);
  mysqli_stmt_bind_result($result, $pid, $title, $content, $upvotes, $link, $username, $profilepath);

  while (mysqli_stmt_fetch($result)) {
    $post = array(
      'pid' => $pid,
      'title' => $title,
      'content' => $content,
      'link' => $link,
      'upvotes' => $upvotes,
      'username' => $username,
      'profilepath' => $profilepath,
    );
  }

  // get comments
  $sql2 = "SELECT c.cid, c.content, c.upvotes, u.username, u.profilepath
  FROM comments c
  INNER JOIN users u ON c.userid = u.userid
  WHERE c.pid = $pid;";

  $result = mysqli_prepare($conn, $sql2);
  mysqli_stmt_execute($result);
  mysqli_stmt_bind_result($result, $cid, $comment_content, $comment_upvotes, $comment_username, $comment_profilepath);

  $comments = array();
  while (mysqli_stmt_fetch($result)) {
    $comments[] = array(
      'cid' => $cid,
      'comment_content' => $comment_content,
      'comment_upvotes' => $comment_upvotes,
      'comment_username' => $comment_username,
      'comment_profilepath' => $comment_profilepath,
    );
  }



  mysqli_stmt_close($stmt);
  mysqli_close($conn);
  ?>

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

          <a href="javascript:history.back()" role="button"
            class="btn-block text-dark col-md-1 mb-2 mb-md-0 mx-2 mb-4 text-dark text-decoration-none fs-6">
            &LeftArrow; Back
          </a>

          <?php
          // display post details
          ?>
          <div class="post mt-4">

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
                  <img src="<?= $post['link'] ?>" alt="post image" width="70%" height="auto" />
                </span>
              <?php } else if ($post['link'] != null) { ?>
                  <span class="post-link">
                    <a href="<?= $post['link'] ?>" class="text-muted">
                      ⎋ External Link
                    </a>
                  </span>
              <?php } ?>

              <div id="<?= $post['pif'] ?>" class="upvotes">
                <a id="up" onclick="vote('up', <?= $post['pid'] ?>)">&uarr;</a>
                <p>
                  <?= $post['upvotes'] ?>
                </p>
                <a id="down" onclick="vote('down', <?= $post['pid'] ?>)">&darr;</a>
              </div>

              <p>Posted by
                <?= $post['username'] ?>
              </p>

              <?php if ($_SESSION['isAdmin'] == 1) { ?>
                <a style="float:right;" href="deletePost.php?pid=<?= $post['pid'] ?>">Delete Post</a>
              <?php } ?>

            </div>
          </div>

          <h5 class="text-dark">Comments</h5>
          <?php
          // display comments
          foreach ($comments as $comment) { ?>
            <div class="post mt-4">
              <img src="<?= $comment['comment_profilepath'] ?>" alt="ppl" width="40" height="40"
                class="rounded-circle me-2" />
              <div class="content">

                <span class="post-text fs-5 fw-600">
                  <?= $comment['comment_content'] ?>
                </span>

                <div id="<?= $comment['cid'] ?>" class="upvotes">
                  <a id="up" onclick="vote('up', <?= $comment['cid'] ?>)">&uarr;</a>
                  <p>
                    <?= $comment['comment_upvotes'] ?>
                  </p>
                  <a id="down" onclick="vote('down', <?= $comment['cid'] ?>)">&darr;</a>
                </div>

                <p>Posted by
                  <?= $comment['comment_username'] ?>
                </p>

                <?php if ($_SESSION['isAdmin'] == 1) { ?>
                  <a style="float:right;" href="deleteComment.php?cid=<?= $comment['cid'] ?>">Delete Comment</a>
                <?php } ?>

              </div>
            </div>
          <?php }
          ?>

          <div class="post-new mt-4">
            <form action="addComment.php" method="post">
              <input type="hidden" name="pid" value="<?= $post['pid'] ?>">
              <textarea name="comment" class="form-control" rows="2" placeholder="Write a comment..."></textarea>
              <button type="submit" class="btn btn-primary mt-2">Submit</button>
            </form>
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