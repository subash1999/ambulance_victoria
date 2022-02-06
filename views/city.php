<?php
$title = "City";
require_once "snippets/header.php";
require_once "../controllers/CityController.php";


$geo_name_id = null;
if (!isset($_GET['geo_name_id'])) {
    Redirect::notFound();
} else {
    $geo_name_id = $_GET['geo_name_id'];
}

$city_controller = new CityController();
$city = $city_controller->getCityDetails($geo_name_id);
$images = $city_controller->getTravelImagesOfCity($geo_name_id);
$country = $city_controller->getCountryDetails($city['CountryCodeISO']);
?>
<div class="mt-2">


    <div class="row">
        <div class="col-md-6">
            <h2> City: <?= $city['AsciiName'] ?></h2>
            <p>Population: <?= $city['Population'] ?></p>
            <p>Elevation: <?= $city['Elevation'] ? $city['Elevation'] : "NA" ?> m</p>
            <p>Country: <a href="country.php?iso=<?= $country['ISO'] ?>"><?= $country['CountryName'] ?></a></p>
        </div>
        <div class="col-md-6">
            <h5>City Map</h5>

            <div id="map" style="height:400px;width:100%"></div>
        </div>
    </div>

</div>
<hr>
<h3>Travel Images of City : <?= $city['AsciiName'] ?></h3>
<div class="row">
    <?php foreach ($images as $row) {
        include 'snippets/image_card.php';
    } ?>
</div>
<script>
    function initMap() {
        var centerPoint = {
            lat: <?= $city['Latitude'] ?>,
            lng: <?= $city['Longitude'] ?>,
        };
        var map = new google.maps.Map(document.getElementById('map'), {
            center: centerPoint,
            zoom: 8
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?= ENV['google_maps_key'] ?>&callback=initMap&libraries=&v=weekly"></script>

<?php require_once "snippets/footer.php" ?>