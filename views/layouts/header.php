<?php
$year = '';
$username = '';
$jobs = '';
$avatar = '';
if (isset($_SESSION['user'])) {
    $username = $_SESSION['user']['username'];
    // $avatar = $_SESSION['user']['avatar'];
    // $year = date('Y', strtotime($_SESSION['user']['created_at']));
}

?>
 <div class="az-header">
      <div class="container">
        <div class="az-header-left">
          <a href="index.php?controller=ticker&action=index" class="az-logo"><span></span> azia</a>
          <a href="" id="azMenuShow" class="az-header-menu-icon d-lg-none"><span></span></a>
        </div><!-- az-header-left -->
        <div class="az-header-menu">
          <div class="az-header-menu-header">
          <a href="index.php?controller=ticker&action=index" class="az-logo"><span></span> azia</a>
          </div><!-- az-header-menu-header -->
          <ul class="nav">
            <li class="nav-item">
              <a href="index.php?controller=ticker&action=index" class="nav-link"><i class="typcn typcn-chart-area-outline"></i>Quản lý vé</a>
            </li>
            <li class="nav-item">
              <a href="index.php?controller=movie&action=index" class="nav-link"><i class="typcn typcn-document"></i> Quản lý phim</a>
      
            </li>
            <li class="nav-item">
              <a href="index.php?controller=role&action=index" class="nav-link"><i class="typcn typcn-chart-bar-outline"></i> Quản lý quyền</a>
            </li>
            <li class="nav-item">
              <a href="index.php?controller=user&action=index" class="nav-link"><i class="typcn typcn-chart-bar-outline"></i> Quản lý user</a>
            </li>
            <li class="nav-item">
              <a href="index.php?controller=order&action=index" class="nav-link"><i class="typcn typcn-book"></i>Quản lý hóa đơn</a>
            </li>
          </ul>
        </div><!-- az-header-menu -->
        <div class="az-header-right">
          <div class="dropdown az-profile-menu">
            <a href="" class="az-img-user"><img src="assets/img/faces/face1.jpg" alt=""></a>
            <div class="dropdown-menu">
              <div class="az-dropdown-header d-sm-none">
                <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
              </div>
              <div class="az-header-profile">
                <div class="az-img-user">
                  <img src="assets/img/faces/face1.jpg" alt="">
                </div><!-- az-img-user -->
                <h6><?php echo $username?></h6>
              </div><!-- az-header-profile -->

              <a href="index.php?controller=user&action=detail&id=<?php echo $_SESSION['user']['id']?>" class="dropdown-item"><i class="typcn typcn-user-outline"></i> My Profile</a>
              <a href="index.php?controller=user&action=logout" class="dropdown-item"><i class="typcn typcn-power-outline"></i> Sign Out</a>
            </div><!-- dropdown-menu -->
          </div>
        </div><!-- az-header-right -->
      </div><!-- container -->
    </div><!-- az-header -->

