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

$username = htmlspecialchars($_SESSION["username"]);
$cipher = 'AES-128-CBC';
$key = 'thebestsecretkey';

//this code retrieves the encrypted name from the bookingApp table and decrypts it to add a
 //personalised welcome message to the app 

$sql = "SELECT IV, Name FROM bookingApp WHERE username = '$username'";
$result = $link->query($sql);
if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
	$iv = hex2bin($row['IV']);
	$name = hex2bin($row['Name']);
	$unencrypted_content = openssl_decrypt($name, $cipher, $key, OPENSSL_RAW_DATA, $iv);
	$_SESSION["name"] = $unencrypted_content; 

}}
	else {
	echo "ERROR";

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
        <h1>Hi, <b><?php echo $unencrypted_content; ?></b>. Welcome to our site.</h1>
    </div>
    <p>
	<br><a href="book.php" class="btn btn-success btn-lg">Book a Coronavirus Test</a>
	<a href="result.php" class="btn btn-success btn-lg">View your Results</a>
	<a href="vaccine.php" class="btn btn-success btn-lg">Book a Coronavirus Vaccination</a></br>
        <a href="reset.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
</body>
</html>