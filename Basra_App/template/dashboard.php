
<?php
include 'init.php';
include $tp.'header.php' ;
?>
<head>
  <title>Admin </title>
</head>
<body>
<link rel="stylesheet" href="<?php echo $css ;?>dashboared.css" />
<!--navbar,,,,,,,,!-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <span class="Welcome">Welcome Admin</span>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">


  </div>
 <div class="logout " style="margin-right:13%;">
   <a class="nav-link lang" href="">AR</a>
     <a class="nav-link" href="logout.php">Logout</a>

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
                      <div class="btn-group dropright">
                  <button type="button" class="btn btn-secondary dropdown-toggle customer  " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span><i class="fa fa-user"></i></span>
                    <span >Merchants</span>
                  </button>
                  <div class="dropdown-menu">
                    <!-- Dropdown menu links -->
                    <a class="dropdown-item" href="merchants.php">View Merchants</a>
                    <a class="dropdown-item" href="Add_Marchent.php">Add Merchants</a>
                    <a class="dropdown-item" href="view_march_request.php">View Request</a>
                  </div>
                </div>
                </li>
                <li>
    <a href="services.php" class="btn btn-secondary services " style="padding-right: 20px;" >
                    <span> <i class="fa fa-shopping-bag"></i></span>
                      <span >Services</span>
                    </a>

                </li>
                <li>
  <a class="btn btn-secondary training" href="training.php">
                <span><i class="fa fa-certificate" aria-hidden="true"></i></span>
                Training
              </a>
                </li>
                <li>
  <a class="btn btn-secondary user " href="users.php" style="padding-right: 36px;">
                <span><i class="fa fa-user"></i></span>
              Users
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
