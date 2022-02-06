<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (array_key_exists('logout', $_POST) && $_POST['logout'] == 'true') {
    include "../controllers/LoginController.php";
    $login_controller = new LoginController();
    $login_controller->logout();
  }
}

$home_controller = new HomeController();
$tree_view = $home_controller->getTravelPhotosTreeViewMenu();
$continents = $tree_view['continents'];
$countries = $tree_view['countries'];
$cities = $tree_view['cities'];

?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary ps-3 pe-3">
  <div class="container-fluid">
    <a class="navbar-brand" href="../index.php">
      <img src="../../assets/images/logo.png" height="50px" alt="Logo">
      Travel
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
          <a class="nav-link active" aria-current="page" href="about.php">About Us</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link active" data-bs-toggle="offcanvas" href="#sidebar" role="button" aria-controls="sidebar">
            Travel Photos
          </a>
        </li> -->
        <li class="nav-item dropdown" id="myDropdown">
          <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown"> Explore </a>
          <ul class="dropdown-menu">
          <?php foreach ($continents as $continent_name =>$continent) { ?>
              <li> <a class="dropdown-item" href="#"> <?= $continent['ContinentName'] ?> &raquo;</a>
                <ul class="submenu dropdown-menu">
                  <?php foreach ($countries as $country) {
                    if ($country['ContinentName'] == $continent['ContinentName']) { ?>
                      <li><a class="dropdown-item" href="country.php?iso=<?= $country['ISO'] ?>"><?= $country['CountryName'] ?> &raquo;</a>
                        <ul class="submenu dropdown-menu">
                          <?php foreach ($cities as $city) {
                            if ($city['CountryName'] == $country['CountryName']) { ?>
                              <li><a class="dropdown-item" href="city.php?geo_name_id=<?= $city['GeoNameId'] ?>"><?= $city['AsciiName'] ?></a></li>
                          <?php }
                          } ?>
                        </ul>
                      </li>
                  <?php }
                  } ?>
                </ul>
              </li>
            <?php } ?>
            
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Browse
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="post_list.php">Post</a></li>
            <li><a class="dropdown-item" href="search.php">Image</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="user_list.php">Users</a></li>
          </ul>
        </li>
      </ul>
      <form method="GET" action="search.php" class="d-flex">
        <input class="form-control me-2" type="search" name="image_title" placeholder="Search" aria-label="Search" required>
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary ps-3 pe-3 pt-2 border-top" style="max-height:30px; font-size:small;">
  <div class="container-fluid">
    <div class="collapse navbar-collapse navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <?php if (Auth::isLogin()) { ?>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="user.php?uid=<?= Auth::currentUser()['UID'] ?>">
              <?= Auth::currentUser()['UserName'] ?> (My Account)
            </a>
          </li>
          <li class="nav-item">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="logoutForm">
              <input type="hidden" name="logout" value="true">
              <a class="nav-link active" aria-current="page" href="#" onclick="document.getElementById('logoutForm').submit();">Log Out</a>
            </form>
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