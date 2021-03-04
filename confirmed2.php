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

// Include config file
require_once "config.php";

// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: test.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1><b><?php echo htmlspecialchars($_SESSION["name"]) . ","; ?></b> your vaccination appointment has been confirmed.</h1>
    </div>
    <p>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
	<a href="welcome.php" class="btn btn-warning">Go Back</a>
    </p>
</body>
</html>

<!--If the book appointment button is pressed in vaccine.php, this code will take the date and time-->
<!--selected and insert it into the bookingApp table-->

<?php
$Date = htmlspecialchars($_SESSION["Date"]); 
$Date1 = strtotime($Date);
$Date2 = date('Y-m-d', $Date);

$Time = htmlspecialchars($_SESSION["Time"]);
$Time1 = strtotime($Time);
$Time2 = date('h:i:s', $Time);

$username = htmlspecialchars($_SESSION["username"]);


$query = mysqli_query($link, "UPDATE bookingApp SET `Vaccination Date` = '$Date2', `Vaccination Time` = '$Time2' WHERE `username`= '$username'");

$query1 = mysqli_query($link, "UPDATE vaccine SET `Status` = 'Confirmed'");

?>
