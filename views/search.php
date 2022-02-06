<?php
$title = "Search";
require_once "snippets/header.php";
require_once "../controllers/SearchController.php";

$search_controller = new SearchController();
$search_params = $search_controller->getSearchParams($_GET);
$search = $search_controller->getSearchResults($search_controller->getSearchParams($_GET));

?>
<div class="row mt-2">
    <h2>Travel Images</h2>

    <div class="col-md-4 col-xl-3 mt-md-3 border-end">
        <form>
            <div class="row mb-3">
                <div class="col-md-6"><h4>Search</h4></div>
                <div class="col-md-6">
                <button  class="btn btn-warning btn-sm" type="button" onclick="if(confirm('Do you want to clear search')){window.location='search.php'}"><small>Clear Search</small></button>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 mb-2">
                    <input type="text" name="image_title" id="image_title" class="form-control" placeholder="Search" <?php if (isset($_GET['image_title'])) { ?> value="<?= $_GET['image_title'] ?>" <?php } ?>>
                </div>
                <div class="col-lg-4 mb-2">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>
            <hr>
            <h5>Filter By Country</h5>
            <label for="countries">Use Ctrl+ Click to Select</label>
            <select name="countries[]" id="countries" class="form-select form-select-lg" aria-label=".form-select-lg example" multiple>
                <?php foreach ($search['countries'] as $country) { ?>
                    <option value="<?= $country['country_iso'] ?>" <?= in_array($country['country_iso'], $search_params['countries']) ? "selected" : "" ?>><?= $country['country_name'] ?></option>
                <?php } ?>
            </select>
            <hr>
            <h5>Filter By City</h5>
            <label for="countries">Use Ctrl+ Click to Select</label>
            <select name="cities[]" id="cities" class="form-select form-select-lg" aria-label=".form-select-lg example" multiple>
                <?php foreach ($search['cities'] as $city) {
                    if ($city['city_name'] != "" && $city['city_name'] != null) { ?>
                        <option value="<?= $city['geo_name_id'] ?>" <?php echo(in_array($city['geo_name_id'], $search_params['cities']) ? "Selected" : "") ?>><?= $city['city_name'] ?></option>
                <?php }
                } ?>
            </select>
        </form>
    </div>
    <div class="col-md-8">
        <h5>Total Results: <?= $search['count'] ?></h5>
        <?php if (
            count($search_params['countries']) > 0
            ||
            count($search_params['cities']) > 0
            ||
            ($search_params['image_title'] != "" && $search_params['image_title'] != null)
        ) { ?>
            <h5>Filtering By</h5>
            <h6 class="ms-2">
                <?php
                echo (($search_params['image_title'] != "" && $search_params['image_title'] != null) ? "Title : " . $search_params['image_title'] : "")
                ?>
            </h6>

            <h6 class="ms-2">
                <?php
                if (count($search_params['countries']) > 0) {
                    $search_countries = $search_params['countries'];
                    foreach ($search_countries as $key => $country_iso) {
                        $country_name = "";
                        foreach ($search['countries'] as $country) {
                            if ($country['country_iso'] == $country_iso) {
                                $country_name = $country['country_name'];
                                break;
                            }
                        }
                        $search_countries[$key] = $country_name;
                    }
                    echo " Countries : " . join(", ", $search_countries);
                ?>

                <?php } ?>
            </h6>
            <h6 class="ms-2">
                <?php
                if (count($search_params['cities']) > 0) {
                    $search_cities = $search_params['cities'];
                    foreach ($search_cities as $key => $geo_name_id) {
                        $city_name = "";
                        foreach ($search['cities'] as $city) {
                            if ($city['geo_name_id'] == $geo_name_id) {
                                $city_name = $city['city_name'];
                                break;
                            }
                        }
                        $search_cities[$key] = $city_name;
                    }
                    echo " Cities : " . join(", ", $search_cities);
                ?>

                <?php } ?>
            </h6>
        <?php } ?>
        <div class="row">
            <?php foreach ($search['results'] as $row) {
                require "snippets/image_card.php";
            } ?>

        </div>
    </div>
</div>
<?php require_once "snippets/footer.php" ?>