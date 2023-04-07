<!-- Edit page -->

<!DOCTYPE html>
<html lang="en" class="home">

<?php
include 'include/connection.php';
include 'include/head.php';

//if it's post, get post details
if (isset($_GET['pid'])) {
    $isPost = true;
    $pid = $_GET['pid'];
    $sql = "SELECT * FROM posts WHERE pid = $pid";
    $result = mysqli_query($conn, $sql);
    $post = mysqli_fetch_assoc($result);

    // put post details into variables
    $title = $post['title'];
    $link = $post['link'];
    $content = $post['content'];
}

//if it's comment, get comment details

if (isset($_GET['cid'])) {
    $isPost = false;
    $cid = $_GET['cid'];
    $sql = "SELECT * FROM comments WHERE cid = $cid";
    $result = mysqli_query($conn, $sql);
    $comment = mysqli_fetch_assoc($result);

    // put comment details into variables
    $content = $comment['content'];
}

if ($isPost == true) {
    $headtitle = "Post";
} else {
    $headtitle = "Comment";
}

?>
<title>Edit
    <?php echo $headtitle; ?> - Blueddit
</title>

<body>
    <!-- Navigation bar -->
    <?php include 'include/navBar.php'; ?>

    <!-- Content -->
    <div class="container-fluid">
        <div class="row pt-4">

            <?php include 'include/sidebar.php'; ?>

            <!-- Edit post fields -->
            <div class="col-md-6 overflow-auto">
                <a href="javascript:history.back()" role="button"
                    class="btn-block text-dark col-md-1 mb-2 mb-md-0 mx-2 mb-4 text-dark text-decoration-none fs-6">
                    &LeftArrow; Back
                </a>
                <!-- Edit post form -->
                <div class="my-4 card bg-transparent text-dark border-0" style="border-radius: 1.5rem;">
                    <div class="card-body">
                        <h4 class="card-title">Edit
                            <?php echo $headtitle; ?>
                        </h4>
                        <?php
                        if ($isPost == true) {
                            ?>
                            <form action="editExt.php" method="POST">
                                <input type="hidden" name="pid" value="<?php echo $pid; ?>">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control text-dark bg-transparent" id="title" name="title"
                                        value="<?php echo $title; ?>" style="border-radius: 0.5rem;">
                                </div>
                                <div class="mb-3">
                                    <label for="link" class="form-label">Link</label>
                                    <input type="text" class="form-control text-dark bg-transparent" id="link" name="link"
                                        value="<?php echo $link; ?>" style="border-radius: 0.5rem;">
                                </div>
                                <div class="mb-3">
                                    <label for="content" class="form-label">Content</label>
                                    <textarea class="form-control text-dark bg-transparent" id="content" name="content"
                                        rows="3" style="border-radius: 0.5rem;"><?php echo $content; ?></textarea>
                                </div>
                                <button type="submit" class="btn btn-info rounded-pill text-white">Submit</button>
                            </form>
                            <?php
                        } else {
                            ?>
                            <form action="editExt.php" method="POST">
                                <input type="hidden" name="cid" value="<?php echo $cid; ?>">
                                <div class="mb-3 ">
                                    <label for="content" class="form-label">Content</label>
                                    <textarea class="form-control text-dark bg-transparent" id="content" name="content"
                                        rows="3" style="border-radius: 0.5rem;"><?php echo $content; ?></textarea>
                                </div>
                                <button type="submit" class="btn btn-info rounded-pill text-white">Submit</button>
                            </form>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- Panel -->
            <div class="col-md-3">
                <?php include 'include/panel.php'; ?>
            </div>
        </div>
</body>