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
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["name"]); ?></b>. Welcome to the Coronavirus Test Result Portal.</h1>
    </div>
    <p>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
	<a href="welcome.php" class="btn btn-warning">Go Back</a>
    </p>
</body>
</html>

//From the result possibilities positive and negative, select one randomly and insert into
//database if the appointment date < date now
<?php
$strings = array('Positive', 'Negative');
$key = $strings[array_rand($strings)];

$username = htmlspecialchars($_SESSION["username"]);

$sql = mysqli_query($link, "SELECT `Appointment Date` FROM bookingApp WHERE `username`='$username'");

while ($row = mysqli_fetch_array($sql)) { 
$appt = $row['Appointment Date'];
}

if(date("Y-m-d") > $appt){
$query = mysqli_query($link, "UPDATE bookingApp SET `Result` = '$key' WHERE `username`= '$username'");
}

$sqlQ = mysqli_query($link, "SELECT `Result` FROM bookingApp WHERE `username`='$username'");

while ($row = mysqli_fetch_array($sqlQ)) { 
$result = $row['Result'];
}

if($result!=null){
echo "<h1>Coronavirus Test Result is: " . "<b>" . $result . "</b>" . "</h1>";
}
//if date now < appointment date tell user the results are not back yet
else {
echo "Results are not back yet!";
echo date("Y-m-d");
}
?>
