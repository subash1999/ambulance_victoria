<?php
$title = "Post";
require_once "snippets/header.php";
require_once "../controllers/PostController.php";



$post_id = null;
if (!isset($_GET['post_id'])) {
    Redirect::notFound();
} else {
    $post_id = $_GET['post_id'];
}
$post_controller = new PostController();


$post = $post_controller->getPost($post_id);
$post_images = $post_controller->getImagesOfPost($post_id);
$other_posts = $post_controller->getOtherPostsByUser($post['UID'], $post_id);
$recent_posts = $post_controller->getRecentPosts();
?>



<div class="mt-2">
    <h2>Post: <?= $post['Title'] ?> </h2>
    <?php if ($post['UID']) { ?>
        <h6>Post By: <a href="user.php?uid=<?= $post['UID'] ?>"><?= $post['FirstName'] . " " . $post['LastName'] ?></a></h6>
    <?php } ?>
    <?php if ($post['PostTime']) { ?>
        <h6>Posted On: <?= Date::shortDate($post['PostTime']) ?></a></h6>
    <?php } ?>

    <div class="row">
        <div class="h-50">
            <?php
            $images = $post_images;
            include 'snippets/multiuse_carousel.php';
            ?>
        </div>
        <p class="mt-3"><?= $post['Message'] ?></p>


    </div>
</div>
<hr>

<hr>
<h4>Other Posts By User : <a href="user.php?uid=<?= $post['UID'] ?>"><?= $post['FirstName'] . " " . $post['LastName'] ?></a></h4>
<div class="row mt-3">
    <?php foreach ($other_posts as $row) {
        include 'snippets/post_card.php';
    } ?>
    <?= count($other_posts) == 0 ? "<h3 class='text-center'>No Other Posts.</h3>": "" ?>;
</div>
<hr>
<h4>Recent Posts</h4>
<div class="row mt-3">
    <?php foreach ($recent_posts as $row) {
        include 'snippets/post_card.php';
    } ?>
    <?= count($recent_posts) == 0 ? "<h3 class='text-center'>No Other Posts.</h3>": "" ?>;
</div>
<?php require_once "snippets/footer.php" ?>