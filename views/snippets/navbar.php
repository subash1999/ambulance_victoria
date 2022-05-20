<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (array_key_exists('logout', $_POST) && $_POST['logout'] == 'true') {
    include "../controllers/LoginController.php";
    $login_controller = new LoginController();
    $login_controller->logout();
  }
}



?>
<nav class="navbar navbar-expand-lg navbar-dark bg-info ps-3 pe-3">
  <div class="container-fluid">
    <a class="navbar-brand" href="../index.php">
      <img src="../../assets/images/logo.png" height="50px" alt="Logo">
      AV
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home Page</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="vehicle_list.php">Vehicles</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="company_list.php">Companies</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="search.php">Search Nearby Vehicles</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="about_us.php">About Us</a>
        </li>

      </ul>
      <form method="GET" action="search.php" class="d-flex">
        <input class="form-control me-2" type="search" name="location" placeholder="Search By Location" aria-label="Search" required>
        <button class="btn btn-success" type="submit">Search</button>
      </form>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <?php if (Auth::isLogin()) { ?>
          <li class="nav-item dropdown">
            <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?= Auth::currentUser()['username'] ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="profile.php">My Profile</a></li>
              <li><a class="dropdown-item" href="edit_profile.php">Edit Profile</a></li>
              <li><a class="dropdown-item" href="my_vehicles.php">My Vehicles</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="logoutForm">
                  <input type="hidden" name="logout" value="true">
                  <a class="dropdown-item" aria-current="page" href="#" onclick="document.getElementById('logoutForm').submit();">Log Out</a>
                </form>
              </li>

            </ul>
          </li>
        <?php } ?>
        <?php if (Auth::isGuest()) { ?>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="register.php">Register</a>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>
<?php
// require_once 'sidebar.php' 
?>