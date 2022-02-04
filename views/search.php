<?php
$title = "Search";
require_once "snippets/header.php";
require_once "../controllers/SearchController.php";

$user_controller = new UserController();
$users = $user_controller->getAllUsers();
$new_images = $user_controller->getNewAdditions();
?>
<?php require_once "snippets/footer.php" ?>