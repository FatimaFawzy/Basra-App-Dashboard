<?php
include 'init.php';
include $tp.'header.php' ;
?>
<head>
  <title>الادمن </title>
</head>
<body style="direction: rtl; font-family:none ;text-align: right;">
<link rel="stylesheet" href="<?php echo $css ;?>dashboared.css" />
<!--navbar,,,,,,,,!-->
<nav class=" navbar Ar_navbar navbar-expand-lg navbar-light bg-light">
  <span class="Welcome"> مرحبا بك </span>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="logout" style="margin-right: 69%;">
      <a class="nav-link lang" href="" >EN</a>
    <a class="nav-link" href="../logout.php" >تسجيل الخروج</a>

</div>


</nav>
<!--end navbar-->
<div class="page-wrapper chiller-theme toggled">
  <nav id="sidebar" class="sidebar-wrapper" style="right: 0;">
    <div class="sidebar-content">
      <div class="sidebar-header">
        <div class="user-pic">
          <img class="img-responsive img-rounded" src="..\layout\images\photo_2020-06-14_06-53-24.jpg">
        </div>

        </div>

      <!-- sidebar-header  -->


      <div class="sidebar-menu">

            <div class="sidebar-submenu">
              <ul style="padding: 0">
                <li>
                      <div class="btn-group dropright">
                  <button type="button" class="btn btn-secondary dropdown-toggle customer  " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span style="padding: 5px;">
                  <i class="fa fa-user"></i></span>
                    <span >التجار</span>
                  </button>
                  <div class="dropdown-menu">
                    <!-- Dropdown menu links -->
                    <a class="dropdown-item" href="ar_marchant.php">عرض التجار</a>
                    <a class="dropdown-item" href="ar_Add_Marchent.php">اضافة  تاجر</a>
                    <a class="dropdown-item" href="ar_view_march_request.php">طلبات الاضافة</a>
                  </div>
                </div>
                </li>
                <li>
    <a href="ar_services.php" class="btn btn-secondary services "  >
                    <span> <i class="fa fa-shopping-bag"></i></span>
                      <span >الخدمات</span>
                    </a>

                </li>
                <li>
  <a class="btn btn-secondary training" href="ar_training.php">
                <span><i class="fa fa-certificate" aria-hidden="true"></i></span>
              <span>التدريب</span>
              </a>
                </li>
                <li>
  <a class="btn btn-secondary user " href="ar_users.php" >
                <span><i class="fa fa-user"></i></span>
              <span>المستخدمين</span>
              </a>
                </li>
              </ul>
      </div>

      <!-- sidebar-menu  -->
    </div>
</div>
</div>
</nav>


 <?php include $tp.'footer.php' ;?>
