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
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}

// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
$name_err = $number_err = "";
$name = $number = "";
$cipher = 'AES-128-CBC';
$key = 'thebestsecretkey';
$iv = random_bytes(16);
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT username FROM bookingApp WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                $username = trim($_POST["username"]);
                }
             else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have at least 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    

    // Validate name
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter a name.";     
    }else{
        $name = trim($_POST["name"]);
    }
    
    // Validate number
    if(empty(trim($_POST["number"]))){
       } elseif(strlen(trim($_POST["number"])) < 10){
        $number_err = "Phone Number must have 10 digits.";
    } else{
        $number = trim($_POST["number"]);
    }


    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($name_err) && empty($number_err)){
	
	 //setting parameters 
	 $param_username = $username;
	 $hash = password_hash($password, PASSWORD_DEFAULT);
	 $iv = random_bytes(16);
	 $escaped_content = $link->real_escape_string($_POST['name']);
	 $escaped_content1 = $link->real_escape_string($_POST['number']);
	 $encrypted_content = openssl_encrypt($escaped_content, $cipher, $key, OPENSSL_RAW_DATA, $iv);
	 $encrypted_content1 = openssl_encrypt($escaped_content1, $cipher, $key, OPENSSL_RAW_DATA, $iv);
	 $iv_hex = bin2hex($iv);
	 $content_hex = bin2hex($encrypted_content);
	 $content_hex1 = bin2hex($encrypted_content1);
        
        // Prepare an insert statement
        $query = "INSERT INTO bookingApp VALUES ('$param_username', '$hash', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', ' ','$iv_hex', '$content_hex', '$content_hex1')";
	if($link->query($query)===TRUE) {
	 // Redirect to login page
            header("location: welcome.php");
	}
	else {
	echo 'MySQL Error: ' . mysqli_error($link);
	}
	}

 	$_SESSION["loggedin"] = true;
         $_SESSION["username"] = $username;   

}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; margin: auto; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
	<div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" >
                <span class="help-block"><?php echo $name_err; ?></span>
            </div>
 		<div class="form-group <?php echo (!empty($number_err)) ? 'has-error' : ''; ?>">
                <label>Number</label>
                <input type="tel" name="number" class="form-control" value="<?php echo $number; ?>">
                <span class="help-block"><?php echo $number_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="test.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>