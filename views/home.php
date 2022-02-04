<?php 
$title = "Home";
require_once "snippets/header.php";
?>
<?php require 'snippets/home_carousel.php' ?>
<hr>
<h3>Top Images</h3>
<div class="row">
    <?php
    require_once  '../controllers/HomeController.php';
    $home_controller = new HomeController();
    $top_images = $home_controller->getTopImages();
    ?>
    <?php if ($top_images->num_rows > 0) { ?>
        <?php while ($row = $top_images->fetch_assoc()) {
            include 'snippets/image_card.php';
        } ?>

    <?php } ?>
</div>
<hr>
<h3>New Additions</h3>
<div class="row">
    <?php
    $new_images = $home_controller->getNewAdditions();
    ?>
    <?php if ($new_images->num_rows > 0) { ?>
        <?php while ($row = $new_images->fetch_assoc()) {
            include 'snippets/image_card.php';
        } ?>
    <?php } ?>
</div>

<?php require_once "snippets/footer.php" ?>