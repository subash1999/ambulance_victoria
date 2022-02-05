<?php
$title = "Posts List";
require_once "snippets/header.php";
require_once "../controllers/PostController.php";

$post_controller = new PostController();
$posts = $post_controller->getAllPosts();
$top_images = $post_controller->getTopImages();
?>
<h2 class="mt-2">Posts</h2>
<table class="table table-bordered datatable">
    <thead>
        <th>SN</th>
        <th>Title</th>
        <th>Image</th>
        <th>By User</th>
        <th>Post Time</th>
    </thead>
    <tbody>
        <?php foreach ($posts as $key => $row) { ?>
            <tr>
                <td><?= $key + 1 ?></td>
                <td><a href="post.php?post_id=<?= $row['PostID'] ?>"><?= $row['Title'] ?></a></td>
                <td><a href="image.php?image_id=<?= $row['ImageID'] ?>"><img src="../travel-images/square-small/<?= $row['Path'] ?>" alt="Post Image"></a></td>
                <td><a href="user.php?uid=<?= $row['UID'] ?>"><?= $row['FirstName'] . " " . $row['LastName'] ?></a></td>
                <td><?= Date::shortDate($row['PostTime']) ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<hr>
<h3>Top Images</h3>
<div class="row">
    <?php foreach ($top_images as $row) {
        include 'snippets/image_card.php';
    } ?>
</div>
<?php require_once "snippets/footer.php" ?>