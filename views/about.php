<?php
$title = "About Us";
require_once "snippets/header.php";
?>
<div class="row mt-3">
    <div class="col-md-5">
        <figure>
            <img src="../assets/images/logo.png" alt="Logo" height="150px">
            <figcaption class="text-center">Fig - Travel Photo Logo.</figcaption>
        </figure>
    </div>
    <div class="col-md-6">
        <h3>About Us</h3>
        <p class="text-break">
            <b>Travel Photo</b> is a travel website that lets the user to share their travel experience in the form of posts and travel images.
            A user can review a travel image only once in this website. Only the admins are able to delete or add a travel photo.
        </p>
        <p class="text-break">
            This website is <b>hypothetical</b> and was created as a group project for DWIN309 unit at Kent Institute Australia.
        </p>
        <p class="text-break">
            This assignment was done by a group of 4 Students. The task were divided such that each student did all the MVC part of a page.
        <ul>
            <div>
                <li><b>Santosh Belbase</b> (K200619)</li>
                <p>He initialized the project by customizing theme, creating layouts, setting up the folders and creating a common layout for the project. He was responsible for the home page.</p>
            </div>
            <div>
                <li><b>Safi Maharjan</b> (K200528)</li>
                <p>She did the simple search on navbar, register and the advance search page.</p>
            </div>
            <div>
                <li><b>Om thapa magar</b> (K200645)</li>
                <p>He was reponsible for the post listing, travel image and country page.</p>
            </div>
            <div>
                <li><b>Laxman Khadka</b> (K200533)</li>
                <p>He did the single post view, about us page, login page and helped other's with the models as he is more knowledgeful on the SQL part. Most of the model creation part and SQL queries are done with the help of his.</p>
            </div>
        </ul>
        </p>
    </div>
</div>
<?php require_once "snippets/footer.php" ?>