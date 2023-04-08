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
            <?php
        } else if ($post['link'] != null) {
            ?>
                <span class="post-link">
                    <a href="<?= $post['link'] ?>" class="text-muted">⎋ External Link</a>
                </span>
            <?php
        }
        ?>
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


        <!-- Remove Post-->
        <?php if ($_SESSION['isadmin'] == true) { ?>
            <a  href="deletePost.php?pid=<?= $post['pid'] ?>">
            <span class="badge rounded-pill bg-danger px-2 py-2">Remove</span>
            </a>
        <?php } ?>
    </div>
    <div class="icon"><a class="text-dark" href="post.php?pid=<?= $post['pid'] ?>">→</a></div>
</div>