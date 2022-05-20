<?php
$title = "Register";
require_once "snippets/header.php";
Auth::guestGuard();
?>
<?php
$error_messages = [];
$error_title = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "../controllers/RegisterController.php";
    $register_controller = new RegisterController();
    $result = $register_controller->register($_POST);
    if (!$result['success']) {
        $error_messages = $result['message'];
    }
    if (isset($result['title'])) {
        $error_title = $result['title'];
    }
}

function getOldValues($value_name)
{
    if (array_key_exists($value_name, $_POST)) {
        return $_POST[$value_name];
    }
    return "";
}

?>
<div class="row h-100">
    <div class="col-sm-12 mt-5">
        <div class="card col-xl-6 col-md-6 col-xs-8 col-8 mx-auto p-3 mt-3">
            <img src="../assets/images/register.png" alt="Register" class="w-50 h-25 image-rounded mx-auto">
            <h4 class="text-center text-info">Register</h4>
            <?php if (count($error_messages) > 0) {
                include "snippets/alert.php";
                echo (dispalyAlert("danger", $error_title, $error_messages));
            } ?>
            <form method="post">
                <div class="mb-3">
                    <label class="form-control-label" for="company_name">Company Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="company_name" id="company_name" value="<?= getOldValues('company_name') ?>">
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-control-label" for="address">Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="address" id="address" value="<?= getOldValues('address') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-control-label" for="city">City <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="city" id="city" value="<?= getOldValues('city') ?>">
                        </div>
                    </div>

                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-control-label" for="region">Region</label>
                            <input type="text" class="form-control" name="region" id="region" value="<?= getOldValues('region') ?>">
                        </div>
                    </div>

                </div>
                <div class="mb-3">

                </div>
                <div class="mb-3">
                    <label class="form-control-label" for="postal">Postal <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="postal" id="postal" value="<?= getOldValues('postal') ?>">
                </div>
                <div class="mb-3">
                    <label class="form-control-label" for="phone">Phone <span class="text-danger">*</span></label>
                    <input type="tel" pattern="[0-9]{2,15}" class="form-control" name="phone" id="phone" value="<?= getOldValues('phone') ?>">
                </div>
                <hr>
                <div class="mb-3">
                    <label class="form-control-label" for="email">Email <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="email" id="email" value="<?= getOldValues('email') ?>">
                </div>
                <div class="mb-3">
                    <label class="form-control-label" for="password">Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="mb-3">
                    <label class="form-control-label" for="password_confirmation">Password Confirmation <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                </div>
                <h6>Already a User? <a href="login.php">Click here to login</a></h6>
                <input type="submit" value="Register" class="float-right btn btn-primary">
            </form>
        </div>
    </div>
</div>
<?php require_once "snippets/footer.php" ?>