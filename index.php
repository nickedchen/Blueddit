<!-- Home -->

<!DOCTYPE html>
<html lang="en" class="home">
<head>
  <script
        src="https://code.jquery.com/jquery-3.7.1.min.js"
        crossorigin="anonymous"></script>
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

        <div class="col-md-6 overflow-auto ">

          <?php
          //connect to database
          if ($error != null) {
            $output = "<p>Unable to reach the database!</p>";
            exit($output);
          } else {
            //display posts and which sublueddit they belong to
            $stmt = $conn->prepare("SELECT p.pid, p.title, p.link, p.upvotes, p.content, p.sid, s.title AS stitle, u.username, u.profilepath, u.userid
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
                'profilepath' => $row['profilepath'],
                'userid' => $row['userid']
              ]);
            }
            foreach ($posts as $post) { 
              include 'postRow.php';
            }
          }
          ?>
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
</script>

</html>