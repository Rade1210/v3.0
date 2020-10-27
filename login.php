<?php
require_once("includes/config.php");
if(isset($_POST['login-btn']))
{
	if(isset($_POST['username']))
		$username = mysqli_real_escape_string($conn, trim($_POST['username']));	
	if(isset($_POST['password']))
		$password = mysqli_real_escape_string($conn, trim($_POST['password']));
	if(strlen($username) == 0)
		$errors[] = "Please Enter User Name";
	if(strlen($password) == 0)
		$errors[] = "Please Enter Password";
	if(count($errors) == 0)
	{
		$usernamequery = "SELECT * FROM users WHERE username='" . $username . "'";
		$usernameresults = mysqli_query($conn, $usernamequery);
		if(mysqli_num_rows($usernameresults) == 1)
		{
			$userpassword = "SELECT * FROM users WHERE username = '" . $username . "' and password = '".$password."'";
			$userpasswordresult = mysqli_query($conn, $userpassword);
			if(mysqli_num_rows($userpasswordresult) > 0)
			{
				$userpasswordrow = mysqli_fetch_assoc($userpasswordresult);
				if($userpasswordrow['admin'] == "1")
				{
					$_SESSION['admin'] = $userpasswordrow['id'];
					$_SESSION['username'] = $userpasswordrow['username'];
					$_SESSION['user_id'] = $userpasswordrow['id'];
				}
				$_SESSION['username'] = $userpasswordrow['username'];
				$_SESSION['user_id'] = $userpasswordrow['id'];
				//$_SESSION['success'] = "You are now logged in";
				header('location: index.php');
			}
			else
				$errors[] = "Password Incorrect.";
		}
		else
			$errors[] = "Username does not exists.";
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/font-awesome.min.css" />
  <link rel="stylesheet" href="css/style.css">
  <title>Login</title>
</head>
<body>
  <?php require_once("includes/header.php"); ?>
  <div class="auth-content">
    <form action="login.php" method="post">
      <h3 class="form-title">Login</h3>
	  <?php require_once("includes/print_errors.php"); ?>
      <div>
        <label>Username</label>
        <input type="text" name="username" class="text-input">
      </div>
      <div>
        <label>Password</label>
        <input type="password" name="password" class="text-input">
      </div>
      <div>
        <button type="submit" name="login-btn" class="btn">Login</button>
      </div>
      <p class="auth-nav">Or <a href="register.php">Sign Up</a></p>
    </form>
  </div>
  <script type="text/javascript" src="js/jquery.min.js"></script>
</body>
</html>