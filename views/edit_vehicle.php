<?php
$title = "Add Vehicle";
require_once "snippets/header.php";
?>
<?php
// get the id from the parameters 
$id = null;
if (!isset($_GET['id'])) {
    Redirect::notFound();
} else {
    $id = $_GET['id'];
}


$error_messages = [];
$error_title = null;
include "../controllers/VehicleController.php";
$vehicle_controller = new VehicleController();
$vehicle = $vehicle_controller->getVehicleDetails($id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $result = $vehicle_controller->update($_POST);
    if (!$result['success']) {
        $error_messages = $result['message'];
    }
    if (isset($result['title'])) {
        $error_title = $result['title'];
    }
}

function getOldValues($value_name)
{
    if (array_key_exists($value_name, $_POST)) {
        return $_POST[$value_name];
    }
    return False;
}
?>
<h2 class="text-center text-info mt-2 mb-3">Edit Vehicle: <?= $vehicle['license_plate'] ?></h2>
<div class="row h-100">
    <div class="col-sm-12">
        <div class="card col-xl-6 col-md-6 col-xs-8 col-8 mx-auto p-3 mt-3">
            <?php if (count($error_messages) > 0) {
                include "snippets/alert.php";
                echo (dispalyAlert("danger", $error_title, $error_messages));
            } ?>
            <form method="post">
                <input type="hidden" name="id" id="id" value="<?= $vehicle['id'] ?>" >
                <div class="mb-3">
                    <label class="form-control-label" for="license_plate">License Plate <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="license_plate" id="license_plate" value="<?= getOldValues('license_plate')!=""?getOldValues('license_plate'):$vehicle['license_plate'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-control-label" for="vehicle_model">Vehicle Model <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="vehicle_model" id="vehicle_model" value="<?= getOldValues('vehicle_model')!=""?getOldValues('vehicle_model'):$vehicle['vehicle_model'] ?>">
                </div>
                <hr>
                <div class="mb-3">
                    <h6>Driver Details</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-control-label" for="driver_name">Driver Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="driver_name" id="driver_name" value="<?= getOldValues('driver_name')!=""?getOldValues('driver_name'):$vehicle['driver_name'] ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-control-label" for="phone_number">Phone Number <span class="text-danger">*</span></label>
                            <input type="tel" pattern="[0-9]{2,15}" class="form-control" name="phone_number" id="phone_number" value="<?= getOldValues('phone_number')!=""?getOldValues('phone_number'):$vehicle['phone_number'] ?>">
                        </div>
                    </div>
                </div>
                <hr>
                <h6>Vehicle Location</h6>
                <div class="mb-3">
                    <label class="form-control-label" for="full_address">Full Address <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="full_address" id="full_address" value="<?= getOldValues('full_address')!=""?getOldValues('full_address'):$vehicle['full_address'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-control-label" for="landmark">Landmark <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="landmark" id="landmark" value="<?= getOldValues('landmark')!=""?getOldValues('landmark'):$vehicle['landmark'] ?>">
                </div>
                <hr>
                <h6>Current Coordinates</h6>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-control-label" for="latitude">Latitude <span class="text-danger">*</span></label>
                            <input type="number" step="0.0000001" min="-90" max="90" class="form-control" name="latitude" id="latitude" value="<?= getOldValues('latitude')!=""?getOldValues('latitude'):$vehicle['latitude'] ?>">
                        </div>

                        <div class="col-md-6">
                            <label class="form-control-label" for="longitude">Longitude <span class="text-danger">*</span></label>
                            <input type="number" step="0.0000001" min="-180" max="180" class="form-control" name="longitude" id="longitude" value="<?= getOldValues('longitude')!=""?getOldValues('longitude'):$vehicle['longitude'] ?>">
                        </div>

                    </div>
                </div>

                <input type="submit" value="Save Vehicle" class="float-right btn btn-info">
            </form>
        </div>
    </div>
</div>
<?php require_once "snippets/footer.php" ?>