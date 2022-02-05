<?php
require_once "../controllers/PostController.php";
$post_controller = new PostController();

$images = $post_controller->getImagesOfPost($row['PostID']);
?>
<div class="col-md-4 mt-1 mb-1">
    <div class="card">

        <div class="card-body">
            <h5 class="card-title">
                <span class="d-inline-block text-truncate col-12">
                    <?= $row['Title'] ?>
                </span>
            </h5>
            <?php include('snippets/multiuse_carousel.php'); ?>
            <p class="card-text">
                <div>
                <?= substr($row['Message'], 0, 100) . "..." ?>
                </div>
                <h6>Post By: <a href="user.php?uid=<?= $row['UID'] ?>"><?= $row['FirstName'] . " " . $row['LastName'] ?></a></h6>
                <h6>Posted On: <?= Date::shortDate($row['PostTime']); ?></h6>
            </p>
            <a href="post.php?post_id=<?= $row['PostID'] ?>" class="btn btn-info">View Post</a>
        </div>
    </div>
</div>