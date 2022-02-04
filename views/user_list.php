<?php
$title = "User List";
require_once "snippets/header.php";
require_once "../controllers/UserController.php";

$user_controller = new UserController();
$users = $user_controller->getAllUsers();
$new_images = $user_controller->getNewAdditions();
?>
<h2 class="mt-2">Users</h2>
<table class="table table-bordered datatable">
    <thead>
        <th>SN</th>
        <th>Email</th>
        <th>Name</th>
        <th>Country</th>
        <th>City</th>
        <th>Date Joined</th>
    </thead>
    <tbody>
        <?php foreach ($users as $key => $row) { ?>
            <tr>
                <td><?= $key + 1 ?></td>
                <td><a href="user.php?uid=<?= $row['UID'] ?>"><?= $row['Email'] ?></a></td>
                <td><?= $row['FirstName'] . " " . $row['LastName'] ?></td>
                <td><a href="country.php?iso=<?= $row['ISO'] ?>"><?= $row['CountryName'] ?></a></td>
                <td><a href="city.php?geo_name_id=<?= $row['GeoNameID'] ?>"><?= $row['City'] ?></a></td>
                <td><?= Date::shortDate($row['DateJoined']) ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<hr>
<h3>New Additions</h3>
<div class="row">
<?php if ($new_images->num_rows > 0) { ?>
    <?php while ($row = $new_images->fetch_assoc()) {
        include 'snippets/image_card.php';
    } ?>

<?php } ?>
</div>
<?php require_once "snippets/footer.php" ?>