<?php
$title = "All Vehicles";
require_once "snippets/header.php";
?>
<?php
include "../controllers/VehicleController.php";
include "../controllers/CompanyController.php";
$vehicle_controller = new VehicleController();
$my_vehicles = $vehicle_controller->getVehiclesList();
?>
<h2 class="text-center text-info mt-2 mb-3">All Vehicles</h2>
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
        <?php foreach ($my_vehicles as $index => $vehicle) {
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
                    <a href="vehicle.php?id=<?= $vehicle['id']?>" class="btn btn-info btn-sm">View</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<?php require_once "snippets/footer.php" ?>