<?php
$title = "Home";
require_once "snippets/header.php";
?>
<?php require 'snippets/home_carousel.php' ?>
<?php
require_once  '../controllers/HomeController.php';
$home_controller = new HomeController();
$top_images = $home_controller->getTopImages();
$recent_posts = $home_controller->getRecentPosts();
$new_images = $home_controller->getNewAdditions();
?>
<hr>
<h3>Top Images</h3>
<div class="row">
    <?php foreach ($top_images as $row) {
        include 'snippets/image_card.php';
    } ?>

</div>
<hr>
<h3>New Additions</h3>
<div class="row">
    <?php foreach ($new_images as $row) {
        include 'snippets/image_card.php';
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