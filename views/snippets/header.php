<?php
session_start();
require_once "../env.php";
include "../utils/Alert.php";
include "../utils/Auth.php";
include "../utils/Validators.php";
include "../utils/Redirect.php";
include "../utils/Date.php";


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- favicon -->
    <link rel="shortcut icon" href="../assets/favicon/android-chrome-192x192.png" type="image/x-icon">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/bootstrap/theme.css">
    <link rel="stylesheet" href="../../assets/multilevel-dropdown.css">
    <link rel="stylesheet" href="../../assets/datatables/datatables.min.css">
    <link rel="stylesheet" href="../../assets/lightbox/css/lightbox.min.css">
    <script src="../../assets/jquery-3.6.0.min.js"></script>
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../assets/multilevel-dropdown.js"></script>
    <script src="../../assets/datatables/datatables.min.js"></script>
    <script src="../../assets/lightbox/js/lightbox.min.js"></script>
    <script src="../../assets/vehicle.js"></script>
    
    <title><?php echo ($title); ?></title>
</head>

<body>


    <?php 
    require_once 'snippets/navbar.php' 
    ?>
    <div class="container">
        <?php
        // alert the session message
        Alert::showAlert();
        ?>
        <div class="row">
            <div class="mb-2 col-12">