<?php
$title = "Change Password";
require_once "snippets/header.php";

$error_messages = [];
$error_title = null;
include "../controllers/ProfileController.php";
$profile_controller = new ProfileController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $result = $profile_controller->changePassword($_POST);
    if (!$result['success']) {
        $error_messages = $result['message'];
    }
    if (isset($result['title'])) {
        $error_title = $result['title'];
    }
}

?>

<h2 class="text-center text-info mt-2 mb-3">Change Password</h2>
<div class="row h-100">
    <div class="col-sm-12">
        <div class="card col-xl-6 col-md-6 col-xs-8 col-8 mx-auto p-3 mt-3">
            <form method="POST">
                <?php if (count($error_messages) > 0) {
                    include "snippets/alert.php";
                    echo (dispalyAlert("danger", $error_title, $error_messages));
                } ?>
                <div class="mb-3">
                    <label for="current_password">Current Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="current_password" name="current_password">
                </div>
                <div class="mb-3">
                    <label for="current_password">New Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="current_password" name="password">
                </div>
                <div class="mb-3">
                    <label for="current_password">Confirm New Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="current_password" name="password_confirmation">
                </div>
                <input type="submit" value="Change Password" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>
<?php require_once "snippets/footer.php" ?>