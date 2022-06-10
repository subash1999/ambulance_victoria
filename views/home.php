<?php
$title = "Home";
require_once "snippets/header.php";
require_once "../controllers/VehicleController.php";
$vehicle_controller = new VehicleController();
$results = $vehicle_controller->search(null,null,"true");
?>
<?php require 'snippets/home_carousel.php' ?>
<h4 class="text-info text-center mt-3 mb"><u>Nearby Vehicles</u></h4>
<div id="map" style="height:300px;width:100%"></div>
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
<?php require_once "snippets/footer.php" ?>