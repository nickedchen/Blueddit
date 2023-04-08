<!-- post  -->

<!DOCTYPE html>
<html lang="en" class="home">

<head>
  <?php include 'include/head.php';
  $pid = $_GET['pid'];
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  $error = mysqli_connect_error();

  //to prevent form mysqli injection  
  
  $pid = stripcslashes($pid);
  $pid = mysqli_real_escape_string($conn, $pid);

  //get post details
  $sql = "SELECT p.pid, p.title, p.content, p.upvotes, p.link, u.username, u.profilepath, p.sid, s.title, p.userid
  FROM posts p
  INNER JOIN users u ON p.userid = u.userid
  INNER JOIN sublueddits s ON p.sid = s.sid
  WHERE p.pid = $pid;";
  $result = mysqli_prepare($conn, $sql);
  mysqli_stmt_execute($result);
  mysqli_stmt_bind_result($result, $pid, $title, $content, $upvotes, $link, $username, $profilepath, $sid, $stitle, $userid);
  while (mysqli_stmt_fetch($result)) {
    $post = array(
      'pid' => $pid,
      'title' => $title,
      'content' => $content,
      'link' => $link,
      'upvotes' => $upvotes,
      'username' => $username,
      'profilepath' => $profilepath,
      'sid' => $sid,
      'stitle' => $stitle,
      'userid' => $userid,
    );
  }

  $sql = "INSERT INTO usageTracking (type, sid, entryDate)
  Values ('VIEWPOST', " . $post['sid'] . ", CURDATE())";
  mysqli_query($conn, $sql);

  // get comments
  $sql2 = "SELECT c.cid, c.content, c.upvotes, u.username, u.profilepath, u.userid
  FROM comments c
  INNER JOIN users u ON c.userid = u.userid
  WHERE c.pid = $pid;";

  $result = mysqli_prepare($conn, $sql2);
  mysqli_stmt_execute($result);
  mysqli_stmt_bind_result($result, $cid, $comment_content, $comment_upvotes, $comment_username, $comment_profilepath, $comment_userid);

  $comments = array();
  while (mysqli_stmt_fetch($result)) {
    $comments[] = array(
      'cid' => $cid,
      'comment_content' => $comment_content,
      'comment_upvotes' => $comment_upvotes,
      'comment_username' => $comment_username,
      'comment_profilepath' => $comment_profilepath,
      'comment_userid' => $comment_userid,
    );
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);

  echo "<title>$title - Blueddit</title>";
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

              <div id="<?= $post['pid'] ?>" class="upvotes fs-6">
                <form method="post" action="upvotes.php">
                  <input type="hidden" name="pid" value="<?= $post['pid'] ?>">
                  <input type="hidden" name="upvoted" value="1">
                  <input class="border-0 bg-info px-2 arrow text-light rounded-pill fw-bolder" type="submit" name="vote"
                    value="&uparrow;" onclick="markArrowClickedUp(this)" />
                </form>
                <p>
                  <?= $post['upvotes'] ?>
                </p>
                <form method="post" action="upvotes.php">
                  <input type="hidden" name="pid" value="<?= $post['pid'] ?>">
                  <input type="hidden" name="downvoted" value="1">
                  <input class="border-0 bg-warning px-2 arrow text-light rounded-pill fw-bolder" type="submit"
                    name="vote" value="&downarrow;" onclick="markArrowClickedDown(this)" />
                </form>
              </div>

              <p>Posted by
                <a class="text-info" href="publicProfile.php?userid=<?= $post['userid'] ?>"><?= $post['username'] ?></a>
                <?php
                // if sid and stitle are not set, then do not display the sublueddit
                if (isset($post['sid']) && isset($post['stitle'])) {
                  ?>
                  in <a class="text-muted" href="sublueddit.php?sid=<?= $post['sid'] ?>">b/<?= $post['stitle'] ?></a>
                  <?php
                }
                ?>
              </p>

              <div class="d-flex flex-row">

                <!-- if the post user is the current user, then display edit and delete buttons -->
                <?php if ($_SESSION['userid'] == $post['userid']) { ?>
                  <span class="badge rounded-pill bg-secondary px-3 py-2 me-2"><a class="text-light text-decoration-none"
                      href="editPost.php?pid=<?= $post['pid'] ?>">Edit</a></span>
                  <span class="badge rounded-pill bg-danger px-3 py-2"><a class="text-light text-decoration-none"
                      href="deletePost.php?pid=<?= $post['pid'] ?>">Delete</a></span>
                <?php } else if ($_SESSION['isadmin'] == true) { ?>
                    <span class="badge rounded-pill bg-danger px-3 py-2"><a class="text-light text-decoration-none"
                        href="deletePost.php?pid=<?= $post['pid'] ?>">Delete</a></span>
                <?php } ?>
              </div>
            </div>
          </div>


          <h5 class="text-dark">Comments</h5>
          <?php
          // display comments
          foreach ($comments as $comment) { ?>
            <div class="post mt-4 comment" id = "<?= $comment['cid'] ?>">
              <img src="<?= $comment['comment_profilepath'] ?>" alt="ppl" width="40" height="40"
                class="rounded-circle me-2" />
              <div class="content" id = "content<?= $comment['cid'] ?>">

                <span class="post-text fs-5 fw-600">
                  <?= $comment['comment_content'] ?>
                </span>

                <div id="<?= $comment['cid'] ?>" class="upvotes fs-6">
                  <form method="post" action="upvotes_comments.php">
                    <input type="hidden" name="cid" value="<?= $comment['cid'] ?>">
                    <input type="hidden" name="upvoted" value="1">
                    <input class="border-0 bg-info px-2 arrow text-light rounded-pill fw-bolder" type="submit" name="vote"
                      value="&uparrow;" onclick="markArrowClickedUp(this)" />
                  </form>
                  <p>
                    <?= $comment['comment_upvotes'] ?>
                  </p>
                  <form method="post" action="upvotes_comments.php">
                    <input type="hidden" name="cid" value="<?= $comment['cid'] ?>">
                    <input type="hidden" name="downvoted" value="1">
                    <input class="border-0 bg-warning px-2 arrow text-light rounded-pill fw-bolder" type="submit"
                      name="vote" value="&downarrow;" onclick="markArrowClickedDown(this)" />
                  </form>
                </div>

                <p>Posted by
                  <a class="text-info" href="publicProfile.php?userid=<?= $comment['comment_userid'] ?>"><?= $comment['comment_username'] ?></a>
                </p>

                <!-- if the comment user is the current user, then display edit and delete buttons -->
                <div class="d-flex flex-row">
                  <?php if ($_SESSION['userid'] == $comment['comment_userid']) { ?>
                    <form method="post" action="editComment.php">
                      <input type="hidden" name="cid" value="<?= $comment['cid'] ?>">
                      <span class="badge rounded-pill bg-secondary px-3 py-2 me-2" type="submit" name="edit">Edit</span>
                    </form>
                    <form method="post" action="deleteComment.php">
                      <input type="hidden" name="cid" value="<?= $comment['cid'] ?>">
                      <span class="badge rounded-pill bg-danger px-3 py-2" type="submit" name="delete">Remove</span>
                    </form>
                  <?php } else if ($_SESSION['isadmin'] == true) { ?>
                      <form method="post" action="deleteComment.php">
                        <input type="hidden" name="cid" value="<?= $comment['cid'] ?>">
                        <span class="badge rounded-pill bg-danger px-3 py-2" type="submit" name="delete">Remove</span>
                    <?php }
                  ?>
                </div>

              </div>
            </div>
          <?php }

          if (!isset($_SESSION['isguest']) || $_SESSION['isguest'] == false) {
            ?>

            <div class="post-new mt-4">
              <form action="addComment.php" method="post">
                <input type="hidden" name="pid" value="<?= $post['pid'] ?>">
                <textarea name="comment" class="form-control" rows="2" placeholder="Write a comment..."></textarea>
                <button type="submit" class="btn btn-primary mt-2">Submit</button>
              </form>
            </div>

          <?php } ?>

        </div>


        <!-- Panel -->
        <div class="col-md-3">
          <?php include 'include/panel.php'; ?>
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

  //Collapse comments
  window.addEventListener('DOMContentLoaded', () => {
    var comments = document.getElementsByClassName("comment");

    for (var i = 0; i < comments.length; i++) {
      comments[i].addEventListener('click', function (event) {
        var commentID = event.target.id;
        var commentContent = document.getElementById("content" + commentID);
        if (commentContent.style.display === "none"){
          commentContent.style.display = "flex";
        }else{
          commentContent.style.display = "none";
        }
      });
    }
    
  });

  (function commentUpdate() {
    $.ajax({
      url: 'editPost.php?cid=<?= $post['cid'] ?>',
      success: function (data) {
        $('.comments').html(data);
      },
      complete: function () {
        // Schedule the next request when the current one's complete
        setTimeout(worker, 5000);
      }
    });
  })();

  (function postUpdate() {
    $.ajax({
      url: 'editPost.php?pid=<?= $post['pid'] ?>',
      success: function (data) {
        $('.post').html(data);
      },
      complete: function () {
        // Schedule the next request when the current one's complete
        setTimeout(worker, 5000);
      }
    });
  })();

</script>

</html>