<!-- Check which page the user is on by checking the name of the .php file -->
<!-- save the name of the page in session variable -->

<?php
session_start();
$page = basename($_SERVER['PHP_SELF']);
$_SESSION['page'] = $page;

$intro;

switch ($page) {
  case 'index.php':
    $page = 'Home';
    $intro = 'Welcome to Blueddit! Here you see all the latest posts from the sublueddits happening right now. You can also create a post for any sublueddit.';
    break;
  case 'newPost.php':
    $page = 'Posting  📮';
    $intro = 'Some posting guidelines: <br/> <ul class="mt-2" style="list-style-type: none; margin: 0; padding: 0;"><li>Be respectful to others :)</li><li>Do not spam</li><li>Do not post NSFW content</li><li>Do not post personal information on the platform</li></ul>';
    break;
  case 'sublueddit.php':
    $page = 'Sublueddit';
    $intro = 'Here you can find all the posts from the sublueddit you have chosen. You can also create a post for this sublueddit.';
    break;
  case 'searchResult.php':
    $page = 'Search';
    $intro = 'Here you can find all the posts that match your search. Happy digging!';
    break;
  case 'discover.php':
    $page = 'Discover';
    $intro = 'Discover new sublueddits here and start sharing your thoughts with the community!';
    break;
  case 'trending.php':
    $page = 'Trending';
    $intro = 'Here you can find all the trending posts from the past 24 hours and personalised for you.';
    break;
  case 'profile.php':
    $page = 'Profile';
    $intro = 'Here you can find all your posts and comments. You can also change your profile picture and username.';
    break;
  case 'monthlyActivity.php':
    $page = 'Activity Tracking';
    $intro = 'Here you can find all the activity on the platform for the past 30 days.';
    break;
  case 'newSublueddit.php':
    $page = 'New Sublueddit';
    $intro = 'Here you can create a new sublueddit. Please note that you need to be an admin to create a new sublueddit.';
    break;  
  default:
    $page = 'Welcome';
    $intro = 'Welcome to Blueddit! Find your favourite sublueddit, create a post and start sharing your thoughts with the community!';
    break;  
}

?>

<div class="d-flex flex-column align-items-end">

<div class=" w-75 alert border-secondary text-dark " role="alert" style="border-radius: 1.0rem; --bs-border-opacity: .5;">
  <h4 class="alert-heading text-dark">
    <?php echo $page; ?>
  </h4>
  <p class="mb-0">
    <?php echo $intro; ?>
  </p>
  <?php if ($page != 'Posting  📮') { ?>
    <hr>
    <p class="mb-0">
      <a href="newPost.php" class="btn btn-warning rounded-3" type="button" style="width: 100%;">
        Create Post
      </a>
    </p>
  <?php } ?>
</div>

<?php
// if session is admin. show a descrition of new sublueddit in a card new sublueddit button
if ( $_SESSION['isadmin'] == true && $page != 'Posting  📮' && $page != 'Search' && $page != 'New Sublueddit') { ?>
<div class=" w-75 alert border-secondary text-dark " role="alert" style="border-radius: 1.0rem; --bs-border-opacity: .5;">
    <h4 class="alert-heading text-dark"> New Sublueddit </h4>
    <p class="mb-0">
        Here you can create a new sublueddit. Please note that you can only create a sublueddit if the name is not already taken.
    </p>
    <hr>
    <p class="mb-0">
        <a href="newSublueddit.php" class="btn btn-warning rounded-3" type="button" style="width: 100%;">
            Create Sublueddit
        </a>
    </p>
</div>
<?php
}
?>
</div>






<!-- Sorting options for posts
<?php if ($page != 'Create a post' && $page != 'Search') { ?>

<h6 class="text-dark">Content Sorting Options</h6>

<div class="btn-group w-75 text-dark" role="group">
    <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
    <label class="btn btn-outline-secondary" for="btnradio1">

        Top
    </label>

    <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
    <label class="btn btn-outline-secondary" for="btnradio2">

        New
    </label>

    <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
    <label class="btn btn-outline-secondary" for="btnradio3">
        Hot
    </label>
</div>

<?php } ?> -->

