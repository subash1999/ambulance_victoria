<?php
$title = "User";
require_once "snippets/header.php";
require_once "../controllers/UserController.php";



$uid = null;
if (!isset($_GET['uid'])) {
    Redirect::notFound();
} else {
    $uid = $_GET['uid'];
}
$user_controller = new UserController();


$user = $user_controller->getUser($uid);
$posts = $user_controller->getPostsByUser($uid);
$images = $user_controller->getTravelImagesByUser($user['UID']);

?>



<div class="mt-2">
    <h2>User: <?= $user['FirstName'] . " " . $user['LastName'] ?> </h2>
    <p>Email: <?= $user['Email'] ?></p>
    <p>Address: <?= $user['Address'] ?></p>
    <p>City: <?= $user['City'] ?></p>
    <p>Region: <?= $user['Region'] ?></p>
    <p>Country: <?= $user['Country'] ?></p>
    <p>Postal: <?= $user['Postal'] ?></p>
    <p>Phone: <?= $user['Phone'] ?></p>
</div>

<hr>
<h4>Posts By User : <a href="user.php?uid=<?= $user['UID'] ?>"><?= $user['FirstName'] . " " . $user['LastName'] ?></a></h4>
<div class="row mt-3">
    <?php foreach ($posts as $row) {
        include 'snippets/post_card.php';
    } ?>
    <?= count($posts) == 0 ? "<h3 class='text-center'>No Posts.</h3>": "" ?>;
</div>
<hr>
<h4>Travel Images By User</h4>
<div class="row mt-3">
    <?php foreach ($images as $row) {
        include 'snippets/image_card.php';
    } ?>
    <?= count($images) == 0 ? "<h3 class='text-center'>No Images.</h3>": "" ?>;
</div>
<?php require_once "snippets/footer.php" ?>