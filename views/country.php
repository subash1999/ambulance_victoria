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
$country = $country_controller->getCountryDetails($iso);
$images = $country_controller->getTravelImagesOfCountry($iso);
?>
<div class="mt-2">
    <h2>
        <div class="row">
            <div class="col-md-6">
                Country: <?= $country['CountryName'] ?>
            </div>
            <div class="col-md-4" style="font-size:small;font-weight:normal;">
                <img src="https://flagcdn.com/h80/<?= strtolower($country['ISO']) ?>.png" srcset="https://flagcdn.com/h160/<?= strtolower($country['ISO']) ?>.png 2x,
    https://flagcdn.com/h240/<?= strtolower($country['ISO']) ?>.png 3x" height="80" alt="<?= $country['CountryName'] ?>'s Flag">
            </div>
        </div>


    </h2>
    <p>Capital: <?= $country['Capital'] ?></p>
    <p>Area: <?= $country['Area'] ?> Km<sup>2</sup>
    </p>
    <p>Population: <?= $country['Population'] ?></p>
    <p>Currency: <?= $country['CurrencyName'] ?> (<?= $country['CurrencyCode'] ?>)</p>
    <?php if ($country['CountryDescription']) { ?>
        <h5>Description</h5>
        <p><?= $country['CountryDescription'] ?></p>
    <?php } ?>
</div>
<hr>
<h3>Travel Images of Country : <?= $country['CountryName'] ?></h3>
<div class="row">
    <?php foreach ($images as $row) {
        include 'snippets/image_card.php';
    } ?>
</div>
<?php require_once "snippets/footer.php" ?>