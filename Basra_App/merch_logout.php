<?php
session_start();  //star session
session_unset();  // unset Data
session_destroy(); //destroy session
// Redirect to the login page:
header('Location: login-merchant.php');
exit();
?>
