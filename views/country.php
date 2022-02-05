<?php
$title = "Country";
require_once "snippets/header.php";
require_once "../controllers/CountryController.php";


$iso = null;
if (!isset($_GET['iso'])) {
    Redirect::notFound();
} else {
    $iso = $_GET['iso'];
}

$country_controller = new CountryController();
$countries = $country_controller->getCountryDetails($iso);
var_dump($countries);
?>
<div class="mt-2">
<h3>Country: <?= $countries['CountryName'] ?></h3>
</div>
<?php require_once "snippets/footer.php" ?>