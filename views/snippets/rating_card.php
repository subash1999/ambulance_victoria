<div class="col-md-3">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h5>Rating: <?= $row['Rating'] ?></h5>
            </div>
        </div>
        <?php if (Auth::isAdmin()) { ?>
            <div class="card-footer">

                <div class="d-flex justify-content-end">
                    <form method="POST" id="delete_form">
                        <input type="hidden" name="image_rating_id" value="<?= $row['ImageRatingID'] ?>">
                        <input type="hidden" name="delete_rating" value="true">
                        <input type="submit" id="delete_form_submit_btn" value="Delete" name="delete" class="btn btn-danger">
                    </form>
                </div>

            </div>
        <?php } ?>
    </div>
</div>