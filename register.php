<?php
include('errorlog.php');

// Set session variables to be used on profile.php page
$_SESSION['username'] = $_POST['username'];
$_SESSION['first_name'] = $_POST['firstname'];
$_SESSION['last_name'] = $_POST['lastname'];

// Escape all $_POST variables to protect against SQL injections
$first_name = $mysqli_real_escape_string($_POST['firstname']);
$last_name = $mysqli_real_escape_string($_POST['lastname']);
$username = $mysqli_real_escape_string($_POST['username']);
$password = $mysqli_real_escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
$hash = $mysqli_real_escape_string( md5( rand(0,1000) ) );

// Check if user with that username already exists
$result = $mysqli::query("SELECT * FROM users WHERE username='$username'") or die($mysqli::error());

// We know user's username exists if the rows returned are more than 0
if (!empty($result)) {
    $_SESSION['message'] = 'User with this username already exists!';
    header("location: errorlog.php");

	}else { // Username doesn't already exist in a database, proceed...
	
    //connection to database for user related tables
    $user = new mysqli('HOP', 'root', 'root', 'beer');


    //table for user preferences
    $pref = "CREATE TABLE `pref_$username`(
      beer_id INT NOT NULL AUTO_INCREMENT,
      beer INT NOT NULL,
      PRIMARY KEY (beer_id)
    )";
    $user::query($pref) or die($user::error);

    // active is 0 by DEFAULT (no need to include it here)
    $sql = "INSERT INTO users (first_name, last_name, username, password, hash) "
            . "VALUES ('$first_name','$last_name','$username','$password', '$hash')";


    // Add user to the database
    if ( $mysqli::query($sql) ){

        $_SESSION['logged_in'] = true; // So we know the user has logged in
        $_SESSION['message'] =

	"Welcome, $first_name ! Let's get Hoppin'!"

        header("location: profile.php");

        //Log account creation in reg.log
        $date = date_create();
        file_put_contents('reg.log', "[".date_format($date, 'm-d-Y H:i:s')."] "."Account with username: ".$username." successfully registered.".PHP_EOL, FILE_APPEND);

    }

    else {
        $_SESSION['message'] = 'Registration failed!';
        header("location: error.php");
    }

}
?>

<!DOCTYPE HTML>
<html>
<head>
	<title>Register Here!</title>
	<h1>Join the Bar Hop!</h1>
</head>
<body>
	</br>
	<form method="post">
	<input type="text" name="username" placeholder="Enter your username">
        <input type="text" name="firstname" placeholder="Enter your first name">
        <input type="text" name="lastname" placeholder="Enter your last name">
        <input type="password" name="password" placeholder="Enter your password">
	<input type="submit" value="Submit">
	</form>
	</br>
</body>
</html>

