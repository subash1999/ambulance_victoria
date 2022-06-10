<?php
$title = "Search";
require_once "snippets/header.php";
require_once "../controllers/CompanyController.php";

$address = null;
if (isset($_GET['address'])) {
    $address = $_GET['address'];
    if ($address == "") {
        $address = null;
    }
}

$landmark = null;
if (isset($_GET['landmark'])) {
    $landmark = $_GET['landmark'];
    if ($landmark == "") {
        $landmark = null;
    }
}

$search_nearby = null;
if (isset($_GET['search_nearby'])) {
    $search_nearby = $_GET['search_nearby'];
}

$results = [];

require_once "../controllers/VehicleController.php";
$vehicle_controller = new VehicleController();
$results = $vehicle_controller->search($address, $landmark, $search_nearby);
?>
<h2 class="text-center text-info mt-2 mb-3">Search</h2>
<form method="GET">
    <div class="mb-3">
        <div class="row">
            <div class="col-6">
                <div class="row">
                    <div class="col-md-6">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" class="form-control" value="<?= $address ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="landmark">Landmark</label>
                        <input type="text" name="landmark" id="landmark" class="form-control" value="<?= $landmark ?>">
                    </div>
                </div>
            </div>
            <div class="col-1">
                <h4 class="text-secondary mt-2">OR</h4>
            </div>
            <div class="col-4 pt-3">
                <a href="search.php?search_nearby=true" class="btn btn-primary">Search Nearby Vehicle</a>
            </div>
        </div>
    </div>
    <input type="submit" value="Search By Location" class="btn btn-primary">
</form>
<hr>
<h4 class="mt-2"><u>Search Results</u></h4>
<h6>Total Result: <?= count($results) ?></h6>
<h6><?php if ($address != null) { ?> Address: <?= $address ?><?php } ?></h6>
<h6 class="text-secondary"><?php if ($address != null && $landmark != null) { ?> OR <?php } ?></h6>
<h6><?php if ($landmark != null) { ?> Landmark: <?= $landmark ?><?php } ?></h6>
<h6><?php if ($search_nearby != null) { ?> Searching Vehicles Nearby You<?php } ?></h6>
<small class="text-secondary">You can further search the results obtained using the search bar just above the table</small>
<?php if ($search_nearby != null) { ?>
    <div id="map" style="height:300px;width:500px" class="mt-2 mb-3"></div>
<?php } ?>
<small>
    <table class="table table-bordered datatable">
        <thead>
            <th>S.N</th>
            <th>License Plate</th>
            <th>Driver Name</th>
            <th>Phone Number</th>
            <th>Vehicle Model</th>
            <th>Full Address</th>
            <th>Landmark</th>
            <th>Coordinates</th>
            <th>Company</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php foreach ($results as $index => $vehicle) {
            ?>
                <tr>
                    <td>
                        <?= $index + 1 ?>
                    </td>
                    <td>
                        <?= $vehicle['license_plate'] ?>
                    </td>
                    <td>
                        <?= $vehicle['driver_name'] ?>
                    </td>
                    <td>
                        <a href="tel:<?= $vehicle['phone_number'] ?>"><img src="../assets/images/call_icon.png" alt="call icon" height="20px" width="20px"><?= $vehicle['phone_number'] ?></a>
                    </td>
                    <td>
                        <?= $vehicle['vehicle_model'] ?>
                    </td>
                    <td>
                        <?= $vehicle['full_address'] ?>
                    </td>
                    <td>
                        <?= $vehicle['landmark'] ?>
                    </td>

                    <td>
                        <?= $vehicle['latitude'] ?><?= $vehicle['longitude'] != "" ? "," . $vehicle['longitude'] : '' ?>
                    </td>
                    <td>
                        <a href="company.php?id=<?= $vehicle['company_id'] ?>"><?= (new CompanyController())->getCompanyDetails($vehicle['company_id'])['company_name'] ?></a>
                    </td>
                    <td>
                        <a href="vehicle.php?id=<?= $vehicle['id'] ?>" class="btn btn-info btn-sm">View</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</small>
<?php if ($search_nearby != null) { ?>
    <script>
        var results = <?php echo json_encode($results); ?>;
        function initMap() {
            // victoria center point
            var centerpoint = {
                lat: -36.9848,
                lng: 143.3906,
            };
            var map = new google.maps.Map(document.getElementById('map'), {
                center: centerpoint,
                zoom: 8
            });
            var markers = [];
            

            <?php for ($i = 0; $i < count($results); $i++) { ?>

                // Locations of landmarks
                pos = {
                    lat: <?= $results[$i]['latitude'] ?>,
                    lng: <?= $results[$i]['longitude'] ?>
                };

                var landmark = new google.maps.Marker({
                    position: pos,
                    map: map,
                    title: "<?= $results[$i]["license_plate"] ?>, Call: <?= $results[$i]["phone_number"] ?>",
                });
                markers.push({key:<?= $i ?>, value:landmark});


            <?php } ?>

            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition, showError);
                } else {
                    alert("Geolocation is not supported by this browser.");
                }
            }

            function haversine_distance(mk1, mk2) {
                var R = 3958.8; // Radius of the Earth in miles
                var rlat1 = mk1.position.lat() * (Math.PI / 180); // Convert degrees to radians
                var rlat2 = mk2.position.lat() * (Math.PI / 180); // Convert degrees to radians
                var difflat = rlat2 - rlat1; // Radian difference (latitudes)
                var difflon = (mk2.position.lng() - mk1.position.lng()) * (Math.PI / 180); // Radian difference (longitudes)

                var d = 2 * R * Math.asin(Math.sqrt(Math.sin(difflat / 2) * Math.sin(difflat / 2) + Math.cos(rlat1) * Math.cos(rlat2) * Math.sin(difflon / 2) * Math.sin(difflon / 2)));
                return d;
            }

            function showPosition(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                current_pos = {
                    lat: latitude,
                    lng: longitude
                };
                current_location = null;
                if (map != null) {

                    map.setCenter(current_pos);
                    // The markers for The Dakota and The Frick Collection
                    current_location = new google.maps.Marker({
                        position: current_pos,
                        map: map,
                        title: "Your Location",
                        icon: {
                            url: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"
                        }
                    });

                }
            
            }

            function showError(error) {
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        alert("User denied the request for Geolocation.");
                        break;
                    case error.POSITION_UNAVAILABLE:
                        alert("Location information is unavailable.");
                        break;
                    case error.TIMEOUT:
                        alert("The request to get user location timed out.");
                        break;
                    case error.UNKNOWN_ERROR:
                        alert("An unknown error occurred.");
                        break;
                }
            }
            getLocation();
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?= ENV['google_maps_key'] ?>&callback=initMap&libraries=&v=weekly"></script>
<?php } ?>
<?php require_once "snippets/footer.php" ?>