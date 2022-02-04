<?php
$title = "Login";
require_once "snippets/header.php";
Auth::guestGuard();
?>
<?php
$error_messages = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "../controllers/LoginController.php";
    $login_controller = new LoginController();
    $result = $login_controller->login($_POST);
    if (!$result['success']) {
        $error_messages = $result['message'];
    }
}
?>

<div class="row h-100">
    <div class="col-sm-12 mt-5">
        <div class="card col-xl-4 col-md-6 col-xs-8 col-8 mx-auto p-3 mt-3">
            <img src="../assets/images/login.png" alt="Login" class="w-50 h-25 image-rounded mx-auto">
            <h4 class="text-center text-info">Login</h4>
            <?php if (count($error_messages) > 0) {
                include "snippets/alert.php";
                echo (dispalyAlert("danger", null, $error_messages));
            } ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="mb-3">
                    <label class="form-control-label" for="username">Email</label>
                    <input type="email" class="form-control" name="username" id="username" required>
                </div>
                <div class="mb-3">
                    <label class="form-control-label" for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <h6>New User? <a href="register.php">Click here to register</a></h6>
                <!-- <h6>Forgot Password? <a href="{% url 'password_reset' %}">Click here to reset</a></h6> -->
                <input type="submit" value="Login" class="float-right btn btn-success">
            </form>
        </div>
    </div>
</div>
<?php require_once "snippets/footer.php" ?>