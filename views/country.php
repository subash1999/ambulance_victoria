<?php
$title = "Country";
require_once "snippets/header.php";
require_once "../controllers/UserController.php";

$user_controller = new UserController();
$users = $user_controller->getAllUsers();
$new_images = $user_controller->getNewAdditions();
?>