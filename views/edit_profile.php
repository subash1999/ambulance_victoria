<?php
$title = "Edit Profile";
require_once "snippets/header.php";
?>
<?php
$error_messages = [];
$error_title = null;
include "../controllers/ProfileController.php";
$profile_controller = new ProfileController();
$user_details = Auth::currentUser();
$company_details = Auth::currentCompany();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // $result = $register_controller->register($_POST);
    if (!$result['success']) {
        $error_messages = $result['message'];
    }
    if (isset($result['title'])) {
        $error_title = $result['title'];
    }
} else {
}

function getOldValues($value_name)
{
    if (array_key_exists($value_name, $_POST)) {
        return $_POST[$value_name];
    }
    return False;
}


?>
<h2 class="text-center text-info mt-2">Edit Profile</h2>
<div class="row h-100">
    <div class="col-sm-12 mt-2">
        <div class="card col-xl-6 col-md-6 col-xs-8 col-8 mx-auto p-3 mt-3">

            <?php if (count($error_messages) > 0) {
                include "snippets/alert.php";
                echo (dispalyAlert("danger", $error_title, $error_messages));
            } ?>
            <form method="post">
                <div class="mb-3">
                    <label class="form-control-label" for="email">Email <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="email" id="email" value="<?= $user_details["username"] ?>" disabled>
                </div>
                <hr>
                <div class="mb-3">
                    <label class="form-control-label" for="company_name">Company Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="company_name" id="company_name" value="<?= getOldValues('company_name') ? getOldValues('company_name') : $company_details["company_name"] ?>">
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-control-label" for="address">Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="address" id="address" value="<?= getOldValues('address') ? getOldValues('address') : $company_details["address"] ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-control-label" for="city">City <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="city" id="city" value="<?= getOldValues('city') ? getOldValues('city') : $company_details["city"] ?>">
                        </div>
                    </div>

                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-control-label" for="region">Region</label>
                            <input type="text" class="form-control" name="region" id="region" value="<?= getOldValues('region') ? getOldValues('region') : $company_details["region"] ?>">
                        </div>
                    </div>

                </div>
                <div class="mb-3">

                </div>
                <div class="mb-3">
                    <label class="form-control-label" for="postal">Postal <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="postal" id="postal" value="<?= getOldValues('postal') ? getOldValues('postal') : $company_details["postal"] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-control-label" for="phone">Phone <span class="text-danger">*</span></label>
                    <input type="tel" pattern="[0-9]{2,15}" class="form-control" name="phone" id="phone" value="<?= getOldValues('phone') ? getOldValues('phone') : $company_details["phone"] ?>">
                </div>
               
                <input type="submit" value="Save Changes" class="float-right btn btn-primary">
            </form>
        </div>
    </div>
</div>
<?php require_once "snippets/footer.php" ?>