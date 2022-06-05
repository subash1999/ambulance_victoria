<?php
$title = "Vehicle";
require_once "snippets/header.php";
?>
<?php

$id = null;
if (!isset($_GET['id'])) {
    Redirect::notFound();
} else {
    $id = $_GET['id'];
}

include "../controllers/VehicleController.php";
include "../controllers/CompanyController.php";
$vehicle_controller = new VehicleController();
$vehicle = $vehicle_controller->getVehicleDetails($id);
?>
<h2 class="text-center text-info mt-2 mb-3">Vechicle Details: <?= $vehicle['license_plate'] ?></h2>
<div class="row">
    <div class="col-md-5">

        <p>Company: <b><a href="company.php?id=<?= $vehicle['company_id'] ?>"><?= (new CompanyController())->getCompanyDetails($vehicle['company_id'])['company_name'] ?></a></b></p>
        <h5>Vehicle Information</h5>
        <p>License Plate : <b><?= $vehicle['license_plate'] ?></b></p>
        <p>Vehicle Model : <b><?= $vehicle['vehicle_model'] ?></b></p>

        <hr>
        <h5>Driver Information</h5>
        <p>Driver Name : <b><?= $vehicle['driver_name'] ?></b></p>
        <p>Phone Number : <b><a href="tel:<?= $vehicle['phone_number'] ?>"><?= $vehicle['phone_number'] ?></a></b></p>
        <hr>
        <h5>Current Location</h5>
        <p>Full Address : <b><?= $vehicle['full_address'] ?></b></p>
        <p>Landmark : <b><?= $vehicle['landmark'] ?></b></p>
    </div>
    <div class="col-md-6">
        <div id="map" style="height:300px;width:100%;"></div>
    </div>

</div>
<script>
    function initMap() {
        var centerPoint = {
            lat: <?= $vehicle['latitude'] ?>,
            lng: <?= $vehicle['longitude'] ?>,
        };
        var map = new google.maps.Map(document.getElementById('map'), {
            center: centerPoint,
            zoom: 8
        });
        new google.maps.Marker({
            position: centerPoint,
            map,
            title: "<?= $vehicle["license_plate"] ?>",
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?= ENV['google_maps_key'] ?>&callback=initMap&libraries=&v=weekly"></script>
<?php require_once "snippets/footer.php" ?>