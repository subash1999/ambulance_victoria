<div class="col-md-4">
    <div class="card">
        <img class="card-img-top" src="../travel-images/medium/<?= $row['image_path'] ?>" height="200px" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">
                <span class="d-inline-block text-truncate col-12">
                    <?= $row['title'] ?>
                </span>
            </h5>
            <p class="card-text">
                <?= substr($row['description'], 0, 100) ?>
            </p>
            <p class="card-text">
                <span class="d-inline-block text-truncate col-12">
                    <h6>Country: <a href="country.php?iso=<?= $row['country_iso'] ?>"><?= $row['country_name'] ?></a></h6>
                </span>
                <?php if ($row['city_name'] != null) { ?>
                    <span class="d-inline-block text-truncate col-12">
                        <h6>City: <a href="city.php?iso=<?= $row['geo_name_id'] ?>"><?= $row['city_name'] ?></a></h6>
                    </span>
                <?php } ?>
                <?php if ($row['location_name'] != null) { ?>
                    <span class="d-inline-block text-truncate col-12">
                        <h6>Location: <?= $row['location_name'] ?></h6>
                    </span>
                <?php } ?>

            </p>
            <h5>Ratings: <?= round($row['avg_rating'], 2) ?></h5>
            <a href="image.php?image_id=<?= $row['image_id'] ?>" class="btn btn-info">View Details</a>
        </div>
    </div>
</div>