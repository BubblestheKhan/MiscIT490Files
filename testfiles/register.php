<?php
require_once 'config.php'; //include config file

//Define variables with empty variables for input
$username = $password = $confirm_password ='';
$username_err = $password_err = $confirm_password_err = "";

//Process form data upon submission
if($_SERVER["REQUEST_METHOD"] == "POST"){

	//Validate username	
	if(empty(trim($_POST["username"]))){
		$username_err = "Please enter a username.";
	} else{
	//Prepare a select statement
	$sql = "SELECT Id FROM users WHERE username = ?";

	if($stmt = mysqli_prepare($link, $sql)){
		//Bind variables to statements to be accepted as parameters
		mysqli_stmt_bind_param($stmt, "s", $param_username);

	//Set parameters
	$param_username = trim($_POST["username"]);

	//Attempt to execute statement
	if(mysqli_stmt_execute($stmt)){
	//Store results
	mysqli_stmt_store_result($stmt);
	
	//Check if username is already in database (taken)
	if(mysqli_stmt_num_rows($stmt) ==1){
		$username_err = "This username is already taken.";
	} else{
		$username = trim($_POST["username"]);
		}	
	}else{
		echo "Ah! The keg spilled! Please try again later!";
		}
	}
	//Close statement
	mysqli_stmt_close($stmt);
}

	//Validate password
	if(empty(trim($_POST['password']))){
		$password_err = "Please enter a password.";
 	} elseif(strlen(trim($_POST['password'])) < 7){
		$password_err = "Password must have at least 7 characters.";
 	} else{
		$password = trim($_POST['password']);
}

	//Validate confirm password
	if(empty(trim($_POST["confirm_password"]))){
		$confirm_password_err = 'Please confirm password.';
	} else{
		$confirm_password = trim($_POST['comfirm_password']);
		if($password != $confirm_password){
			$confirm_password_err = 'Password did not match.';
		}
	}

	//Check for input errors before inserting in database
	if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

	//Prepare an insert statement
	$sql = "INSERT INTO users (username, password) VALUES (?,?)";

	if($stmt = mysqli_prepare($link, $sql)){
	//Bind variables to statements to be accepted as parameters
	mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

	//Set parameters
	$param_username = $username;
	$param_password = password_hash($password, PASSWORD_DEFAULT); //Creates a password hash

	//Attempt to execute statement
	if(mysqli_stmt_execute($stmt)){
		//Redirect to login page
		header("location: login.php");
	} else{
		echo "Ah! The keg spilled! Please try again later!";
		}
	}

	//Close statement
	mysqli_stmt_close($stmt);
	}

	//Close conneciton
	mysqli_close($link);
}
?>

<!DOCTYPE HTML>
<head>
	<meta charset="UTF-8">
	<title>HOP Sign Up</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!--/* PUT CSS HERE */-->

	<style type="text/css">
	</style>
</head>
<body>
	<div class="wrapper">
	<h2>Sign Up</h2>
	<p>Become a drinking buddy! Fill out this form to create an account.</p>
	<form method = "post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
	
	<label>Username</label>
	<input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
	<span class="help-block"><?php echo $username_err; ?></span>
	</div>

	<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">

	<label>Password</label>
	<input type="password" name="password" class="form-control" value="<?php echo $password;>">
	<span class="help-block"><?php echo $pssword_err; ?></span>
	</div>
	<div clas="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">

	<label>Confirm Password</label>
	<input type="password" name="confirm_password" class="form-control" value="<!--?php echo $confirm_password; ?-->">
	<span class="help-block"><?php echo $confirm_password_err; ?></span>
	</div>
	<div class="form-group">
		<input type="submit" class="btn btn-primary" value="Submit">
		<input type="reset" class="btn btn-default" value="Reset">
	</div>
