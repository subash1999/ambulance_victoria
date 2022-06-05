<?php
$title = "All Companies";
require_once "snippets/header.php";
?>
<?php
include "../controllers/CompanyController.php";
$comapny_controller = new CompanyController();
$companies = $comapny_controller->getCompaniesList();
?>
<h2 class="text-center text-info mt-2 mb-3">All Companies</h2>
<table class="table table-bordered datatable">
    <thead>
    <th>S.N</th>
        <th>Company Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>City</th>
        <th>Region</th>        
        <th>Postal</th>
        <th>Action</th>
        
    </thead>
    <tbody>
        <?php foreach ($companies as $index => $company) {
        ?>
            <tr>
                <td>
                    <?= $index + 1 ?>
                </td>
                <td>
                <a href="company.php?id=<?= $company['id']?>"><?= $company['company_name'] ?></a>
                </td>
                <td>
                    <?= $company['email'] ?>
                </td>
                <td>
                    <?= $company['phone'] ?>
                </td>
                <td>
                    <?= $company['address'] ?>
                </td>
                <td>
                    <?= $company['city'] ?>
                </td>
                <td>
                    <?= $company['region'] ?>
                </td>
                <td>
                    <?= $company['postal'] ?>
                </td>
                <td>
                    <a href="company.php?id=<?= $company['id']?>" class="btn btn-info btn-sm">View</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<?php require_once "snippets/footer.php" ?>