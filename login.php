<?php

include('errorlog.php');
/* User login process, checks if user exists and password is correct */
// Escape to protect against SQL injections
$username = $mysqli_real_escape_string($_POST['username']);
$result = $mysqli_query("SELECT * FROM users WHERE username='$username'");

if (!empty($result)){ // User doesn't exist
    $_SESSION['message'] = "User with username: ".$username." doesn't exist!";
    header("location: error.php");
}
else { // User exists
    $user = $result::fetch_assoc();

    if ( password_verify($_POST['password'], $user['password']) ) {

        $_SESSION['username'] = $user['username'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['active'] = $user['active'];

        // This is how we'll know the user is logged in
        $_SESSION['logged_in'] = true;

        header("location: profile.php");
    }
    else {
        $_SESSION['message'] = "You have entered wrong password, try again!";
        header("location: error.php");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login here!</title>
	<h1>HOP In!</h1>
</head>
<body>
	<form method="post">
		<input type="text" name="username" placeholder="Enter your username">
		<input type-"password" name="password" placeholder="Enter your password">
		<input type="submit" value="Submit">
	</form>
</body>
</html>	
