
<?php
include 'init.php';
include $tp.'header.php' ;
?>
<head>
  <title>Merchant </title>
</head>
<body>

<link rel="stylesheet" href="<?php echo $css ;?>dashboared.css" />
<!--navbar,,,,,,,,!-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <span class="Welcome">Welcome Merchant</span>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  </div>
  <div class="logout"style="margin-left: 64%;">
     <a class="nav-link lang" href="" >AR</a>
    <a class="nav-link" href="merch_logout.php">Logout</a>

  </div>
</nav>
<!--end navbar-->
<div class="page-wrapper chiller-theme toggled">
  <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <div class="sidebar-header">
        <div class="user-pic">
          <img class="img-responsive img-rounded" src="layout\images\photo_2020-06-14_06-53-24.jpg">
        </div>

        </div>

      <!-- sidebar-header  -->


      <div class="sidebar-menu">

            <div class="sidebar-submenu">
              <ul style="padding: 0">
                <li>
                    <a class="btn btn-secondary customer " href="category.php">
                        <span><i class="fa fa-user"></i></span>
                        Category
                      </a>
                </li>
                <li>
                    <a class="btn btn-secondary orders " href="orders.php">
                        <span> <i class="fa fa-shopping-cart"></i></span>
                      Orders
                      </a>
                </li>
                <li>
                    <a class="btn btn-secondary count " href="editcount.php">
                        <span><i class="fa fa-pencil-alt"></i></span>
                      Edit Count
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
