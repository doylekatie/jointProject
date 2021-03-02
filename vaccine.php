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
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["name"]); ?></b>. Welcome to the Coronavirus Vaccination Booking Portal.</h1>
    </div>
    <p>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
	<a href="welcome.php" class="btn btn-warning">Go Back</a>
    </p>
</body>
</html>

//The 'HSE' updates the vaccine table with available appointments. This code will pull that info from
//the table and print to user

<?php

// Prepare a select statement
        $query = mysqli_query($link, "select * from vaccine");

while ($row = mysqli_fetch_array($query)) { 

		$timestamp = strtotime($row['Appointment Time']);
		$time = date('H:i', $timestamp);
		$timestamp1 = strtotime($row['Appointment Date']);
		$time1 = date('d/m/Y', $timestamp1);

		echo "<h1>Available Appointments</h1>";
		echo "<font size='5'>";
		echo "<center>"."\n<table>\n<tr>\n" . "\n\t<th>Number</th>" . "\n\t<th>Date</th>" . "\n\t<th>Time</th>" . "\n\t<th>Location</th>" ."\n\t<th>Status</th>" . "\n</tr>"."</center>";      
		echo "\n<tr>";
		echo "\n\t<td>".$row['Appointment Number']."</td>";
		echo "\n\t<td>".$time1."</td>";
		echo "\n\t<td>".$time."</td>";
		echo "\n\t<td>".$row['Location']."</td>";
		echo "\n\t<td>".$row['Status']."</td>"; 
		echo "\n</tr>"; 
		echo "\n</table>\n";  

		$_SESSION["Date"] = $timestamp1; 
		$_SESSION["Time"] = $timestamp;  
	}

            // Close statement
          //  mysqli_stmt_close($link);

?>

<!DOCTYPE html>
<html lang="en">
<body>
     <p>
        <a href="confirmed2.php" class="btn btn-success">Book this Appointment</a>
    </p>
</body>
</html>
