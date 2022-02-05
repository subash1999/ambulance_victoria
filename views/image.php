<?php
$title = "Travel Image";
require_once "snippets/header.php";
require_once "../controllers/TravelImageController.php";



$image_id = null;
if (!isset($_GET['image_id'])) {
    Redirect::notFound();
} else {
    $image_id = $_GET['image_id'];
}
$travel_image_controller = new TravelImageController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_rating'])) {
        $travel_image_controller->deleteRating($_POST['image_rating_id']);
        Alert::showAlert();
    }
    if (isset($_POST['add_rating'])) {
        $travel_image_controller->addRating($image_id, $_POST['rating']);
        Alert::showAlert();
    }
}


$image = $travel_image_controller->getTravelImageDetails($image_id);
$related_images = $travel_image_controller->getRelatedTravelImages($image_id);
$post_images = $travel_image_controller->getOtherImagesOfPost($image['post_id'], $image['image_id']);
$ratings = $travel_image_controller->getAllRatings($image_id);
?>



<div class="mt-2">
    <h2>Travel Image: <?= $image['title'] ?> </h2>

    <div class="row">
        <div class="col-md-6">
            <img src="../travel-images/large/<?= $image['image_path'] ?>" height="200px" alt="Travel Image" class="img-fluid img-thumbnail">
            <p class="mt-3"><?= $image['description'] ?></p>

            <?php if ($image['uid']) { ?>
                <h6>Travel Image By: <a href="user.php?uid=<?= $image['post_id'] ?>"><?= $image['first_name'] . " " . $image['last_name'] ?></a></h6>
            <?php } ?>
            <h5>Average Ratings: <?php echo ($image['avg_rating'] ? $image['avg_rating'] : 0) ?></h5>
        </div>
        <div class="col-md-6">
            <?php if ($image['post_title']) { ?>
                <h6>Post: <a href="post.php?post_id=<?= $image['post_id'] ?>"><?= $image['post_title'] ?></a></h6>
            <?php } ?>
            <?php if ($image['geo_name_id']) { ?>
                <h6>City: <a href="city.php?geo_name_id=<?= $image['geo_name_id'] ?>"><?= $image['city_name'] ?></a></h6>
            <?php } ?>
            <?php if ($image['country_iso']) { ?>
                <h6>Country: <a href="country.php?iso=<?= $image['country_iso'] ?>"><?= $image['country_name'] ?></a></h6>
            <?php } ?>
            <?php if ($image['continent_name']) { ?>
                <h6>Continent: <?= $image['continent_name'] ?></a></h6>
            <?php } ?>
            <h3>Location</h3>
            <div class="border border-2">
                <div id="map"></div>
            </div>

        </div>
    </div>
</div>
<hr>
<?php if (Auth::isUser()) { ?>
    <h3>Add Ratings</h3>
    <div class="row">
        <div class="col-sm-6">
            <label for="rating">Add your rating between 1 to 5</label>
            <form method="POST">
                <div class="col-sm-8 mb-2">
                    <input type="hidden" name="add_rating" value="add_rating">
                    <input type="number" step="0.01" max="5" min="1" name="rating" id="rating" class="form-control" placeholder="Rating" required>
                </div>
                <div class="col-sm-3">
                    <input type="submit" value="Add" class="btn btn-primary">
                </div>
            </form>

        </div>
        <small>Note: There was not a user id (UID) field in the travelimagerating table so we could not restrict the user to only one rating.</small>
    </div>
<?php } ?>

<?php if (count($ratings) > 0) { ?>
    <h5 class="mt-2">Existing Ratings</h5>
    <div class="row">
        <?php foreach ($ratings as $row) {
            include "snippets/rating_card.php";
        }
        ?>
    </div>
<?php } ?>


<hr>
<?php if (count($post_images) > 0) { ?>
    <h4>Other Images of Post : <a href="post.php?post_id=<?= $image['post_id'] ?>"><?= $image['post_title'] ?></a></h4>
    <div class="row mt-3">
        <?php foreach ($post_images as $row) {
            include 'snippets/image_card.php';
        } ?>
    </div>

<?php } ?>
<hr>
<h4>Related Travel Images</h4>
<div class="row mt-3">
    <?php foreach ($related_images as $row) {
        include 'snippets/image_card.php';
    } ?>
</div>
<!-- travel_image js -->
<script src="../assets/travel_image.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?= ENV['google_maps_key'] ?>"></script>
<script>
    var centerPoint = {
        lat: <?= $image['Latitude'] ?>,
        lng: <?= $image['Longitude'] ?>,
    };
    var map = new google.maps.Map(document.getElementById('map'), {
        center: centerPoint,
        zoom: 8
    });
    new google.maps.Marker({
        position: centerPoint,
        map,
        title: "Hello World!",
    });
</script>
<?php require_once "snippets/footer.php" ?>