
<?php
include 'init.php';
include $tp.'header.php' ;
?>
<head>
  <title>التاجر </title>
</head>
<body style="direction: rtl; font-family:none ;text-align: right;">

<link rel="stylesheet" href="<?php echo $css ;?>dashboared.css" />
<!--navbar,,,,,,,,!-->
<nav class="navbar Ar_navbar navbar-expand-lg navbar-light bg-light">
  <span class="Welcome">اهلا بالتاجر</span>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  </div>
  <div class="logout"style="margin-right: 66%;">
     <a class="nav-link lang" href="" >EN</a>
     <a class="nav-link" href="../merch_logout.php">تسجيل خروج</a>

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
                    <a class="btn btn-secondary customer " href="ar_category.php">
                        <span><i class="fa fa-user"></i></span>
                        الاقسام
                      </a>
                </li>
                <li>
                    <a  class="btn btn-secondary orders" href="ar_orders.php">
                     <i class="fa fa-shopping-cart"></i>
                      <span>الطلبات</span>
                    </a>

                </li>
                <li>
                    <a class="btn btn-secondary count " href="ar_editcount.php">
                        <span><i class="fa fa-pencil-alt"></i></span>
                      تعديل الحساب
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
