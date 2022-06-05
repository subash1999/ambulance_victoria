<?php
$title = "User Profile";
require_once "snippets/header.php";
?>
<?php
include "../controllers/ProfileController.php";
$company_details = Auth::currentCompany();
$user_details = Auth::currentUser();
?>
<h2 class="text-center mt-3 mb-3 text-info">My Profile</h2>
<div class="row">
    <div class="col-8">

    </div>
    <div class="col-4">
        <a href="edit_profile.php" class="btn btn-secondary">Edit Profile</a>
    </div>
</div>
<h4>Login Details</h4>
<p>Email: <b><?= $user_details['username'] ?></b></p>
<p>Date Joined: <b><?= Date::shortDate($user_details['datejoined']) ?></b></p>
<hr>
<h4>Company Details</h4>
<p>Company Name: <b><?= $company_details['company_name'] ?></b></p>
<p>Address: <b><?= $company_details['address'] ?></b></p>
<p>City: <b><?= $company_details['city'] ?></b></p>
<p>Region: <b><?= $company_details['region'] ?></b></p>
<p>Phone: <b><?= $company_details['phone'] ?></b></p>
<p>Postal: <b><?= $company_details['postal'] ?></b></p>


<?php require_once "snippets/footer.php" ?>