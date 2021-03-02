<!--Name: Katie Doyle-->
<!--Student Number: C00240662-->
<!--Date: 16/02/21-->

<!--***************************************************************************************-->
<!--*    Title: PHP MySQL Login System-->
<!--*    Author: Tutorial Republic-->
<!--*    Date: 2021-->
<!--*    Availability: https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php-->
<!--*-->
<!--***************************************************************************************-->

<?php
// Initialize the session
session_start();
 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
header("location: test.php");
exit;
?>