<!-- Search Result -->
<!DOCTYPE html>
<html lang="en" class="home">
    <?php
        // get search term from the search box
        $searchTerm = $_GET['searchTerm'];
    ?>
    <head>
        <?php include 'include/head.php'; ?>
        <title> Searching for <?= $searchTerm ?> - Blueddit </title>
    </head>
    <main>
        <body>
            <!-- Navigation bar -->
            <?php include 'include/navBar.php'; ?>
            <!-- Content -->
            <div class="container-fluid">
                <div class="row pt-4">
                    <?php include 'include/sidebar.php'; ?>
                    <!-- Search Result -->
                    <div class="col-md-6 overflow-auto">
                        <?php
                            //connect to database
                            if ($error != null) {
                                $output = "<p>Unable to reach the database!</p>";
                                exit($output);
                            } else {
                                //display search result
                                $stmt = $conn->prepare("SELECT p.pid, p.title, p.link, p.upvotes, p.content, u.username, u.profilepath, p.sid, s.title AS stitle
                                    FROM posts p
                                    INNER JOIN users u ON p.userid = u.userid
                                    INNER JOIN sublueddits s ON p.sid = s.sid
                                    WHERE p.title LIKE '%$searchTerm%'
                                    ORDER BY p.pid DESC
                                    LIMIT 10;");
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
                                        'username' => $row['username'],
                                        'profilepath' => $row['profilepath'],
                                        'sid' => $row['sid'],
                                        'stitle' => $row['stitle']
                                    ]);
                                }
                                if (count($posts) == 0) {
                                    echo "<h6 class='text-muted text-center'>Huh, nothing found. Try Again :(</h6>";
                                } else {
                                    foreach ($posts as $post) {
                                        include 'postRow.php';
                                    }
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
