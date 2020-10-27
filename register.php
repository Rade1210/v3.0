<?php
require_once("includes/config.php");
session_start();
if(isset($_POST['register-btn']))
{
	if(empty($_POST['username']))
        $errors[] = "Username is required";
    if(empty($_POST['email']))
        $errors[] = "Email is required";
    if(empty($_POST['password']))
        $errors[] = "Password is required";
    if($_POST['passwordConf'] !== $_POST['password'])
        $errors[] = "Passwords and Confirm Password do not match";
	if(count($errors) == 0)
	{
		$query = "SELECT * FROM users WHERE username='" . $_POST['username'] . "'";
		$results = mysqli_query($conn, $query);
		if(mysqli_num_rows($results) > 0)
			$errors[] = "Username already exists.";
		else
		{
			$query = "SELECT * FROM users WHERE email='" . $_POST['email'] . "'";
			$results = mysqli_query($conn, $query);
			if(mysqli_num_rows($results) > 0)
				$errors[] = "Email already exists.";
			else
			{
				mysqli_query($conn, "INSERT INTO users SET username='".$_POST["username"]."', email='".$_POST["email"]."', password='".$_POST["password"]."'");
				//$_SESSION['success'] = "Registration Completed Successfully.";
        $_SESSION['username'] = $_POST["username"];
				$_SESSION['user_id'] = mysqli_insert_id($conn);
        header('location: index.php');
        exit();
			}
		}
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
  <title>Register</title>
</head>
<body>
	<?php require_once("includes/header.php"); ?>

  <div class="auth-content">
    <form action="register.php" method="post">
      <h3 class="form-title">Register</h3>
	  <?php
		require_once("includes/print_errors.php");
		require_once("includes/show_messages.php");
		?>
      <div>
        <label>Username</label>
        <input type="text" name="username" class="text-input">
      </div>
      <div>
        <label>Email</label>
        <input type="email" name="email" class="text-input">
      </div>
      <div>
        <label>Password</label>
        <input type="password" name="password" class="text-input">
      </div>
      <div>
        <label>Confirm Password</label>
        <input type="password" name="passwordConf" class="text-input">
      </div>
      <div>
        <button type="submit" name="register-btn" class="btn">Register</button>
      </div>
      <p class="auth-nav">Or <a href="login.php">Sign In</a></p>
    </form>
  </div>
  <script type="text/javascript" src="js/jquery.min.js"></script>
</body>
</html>