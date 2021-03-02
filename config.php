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
//session_start();
$host = "localhost"; //host name
$user = "root"; //user root
$password = ""; //password ""
$dbname = "booking"; //database name

$link = mysqli_connect($host,$user,$password,$dbname);
//check the connection
if(!$link)
{
	die("Connection failed: " . mysqli_connect_error());
}