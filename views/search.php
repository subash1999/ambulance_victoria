<?php
$title = "Search";
require_once "snippets/header.php";
require_once "../controllers/SearchController.php";

$search_controller = new SearchController();
$search = $search_controller->getSearchResults($search_controller->getSearchParams($_GET));
?>

<div class="row mt-2">
    <h2>Travel Images</h2>
    <div class="col-md-4 col-xl-3 mt-md-3 border-end">
        <h4>Search</h4>
        <form>
            <div class="row">
                <div class="col-lg-8 mb-2">
                    <input type="text" name="image_title" id="image_title" class="form-control" placeholder="Search">
                </div>
                <div class="col-lg-4 mb-2">
                    <div class="d-flex justify-content-end">
                    <input type="submit" value="Search" class="btn btn-primary">
                    </div>
                </div>
            </div>
            <hr>
            <h5>Filter By Country</h5>
            <hr>
            <h5>Filter By City</h5>
        </form>
    </div>
    <div class="col-md-8"></div>
</div>
<?php require_once "snippets/footer.php" ?>