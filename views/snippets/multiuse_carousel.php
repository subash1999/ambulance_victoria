<!-- carousel style -->
<?php $unique_id = uniqid(); ?>
<!-- please define a $images variable before this  -->
<style>
    .box-carousel-img {
        max-height: 150px;
    }
</style>
<?php if (isset($images)) { ?>
    <div id="carousel<?= $unique_id ?>" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?php
            $index = 0;
            foreach ($images as $image) { ?>
                <button type="button" data-bs-target="#carousel<?= $unique_id ?>" data-bs-slide-to="<?= $index ?>" class="<?= $index == 1 ? "active" : "" ?>" <?php if ($index == 0) { ?>aria-current="true" <?php } ?> aria-label="<?= $image['title'] ?>"></button>
            <?php
                $index += 1;
            } ?>
        </div>
        <div class="carousel-inner">
            <?php
            $index = 0;
            foreach ($images as $image) { ?>
                <div class="carousel-item <?= $index == 0 ? "active" : "" ?>">
                    <a href="../../travel-images/large/<?= $image['image_path'] ?>" data-lightbox="lightbox-<?= $unique_id ?>" data-title="<?= $image['title'] ?>">
                        <img src="../../travel-images/medium/<?= $image['image_path'] ?>" class="d-block w-100 box-carousel img-fluid" alt="<?= $image['title'] ?>">
                    </a>
                </div>
            <?php
                $index += 1;
            } ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel<?= $unique_id ?>" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel<?= $unique_id ?>" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
<?php } ?>