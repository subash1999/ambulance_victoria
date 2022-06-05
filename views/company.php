<?php
$title = "Company";
require_once "snippets/header.php";
?>
<?php

$id = null;
if (!isset($_GET['id'])) {
    Redirect::notFound();
} else {
    $id = $_GET['id'];
}

include "../controllers/CompanyController.php";
$company_controller = new CompanyController();
$company = $company_controller->getCompanyDetails($id);
$company_vehicles = $company_controller->getCompanyVehiclesList($company['id']);
?>
<h2 class="text-center text-info mt-2 mb-3">Company Details: <?= $company['company_name'] ?></h2>


<p>Compay Name : <b><?= $company['company_name'] ?></b></p>
<p>Email : <b><?= $company['email'] ?></b></p>
<p>Phone : <b><?= $company['phone'] ?></b></p>
<p>Postal Code : <b><?= $company['postal'] ?></b></p>
<p>Address : <b><?= $company['address'] ?></b></p>
<p>City : <b><?= $company['city'] ?></b></p>
<p>Region : <b><?= $company['region'] ?></b></p>
<hr>
<h5 class="text-center mt-3 mb-3">Vechile List of the Company: <b><?= $company['company_name'] ?></b></h5>
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
        <?php foreach ($company_vehicles as $index => $vehicle) {
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
                    <a href="tel:<?= $vehicle['phone_number'] ?>"><?= $vehicle['phone_number'] ?></a>
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