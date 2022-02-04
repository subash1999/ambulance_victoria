<?php
$title = "User";
require_once "snippets/header.php";
require_once "../controllers/UserController.php";



$uid = null;
if (!isset($_GET['uid'])) {
    Redirect::notFound();
} else {
    $uid = $_GET['uid'];
}
$user_controller = new UserController();


$user = $user_controller->getUser($uid);
$posts = $user_controller->getPostByUser($uid);
$images = $user_controller->getTravelImageByUser($post['UID'], $uid);

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
</div>
<hr>
<h4>Recent Posts</h4>
<div class="row mt-3">
    <?php foreach ($recent_posts as $row) {
        include 'snippets/post_card.php';
    } ?>
</div>
<?php require_once "snippets/footer.php" ?>