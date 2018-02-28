<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Lobster|Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
	<title>Login Form</title>
</head>
<body>
	<div class="container">
		<div class="header">
			<div id="header-logo"><a href="foodbin.php">Foodbin</a></div>
		</div>
		<form action="includes/login-inc.php" method="POST" id="login-form">
			<h4>Social Media</h4>
			<div id="social-btn-container">
				<button id="facebook-btn">Log in with Facebook</button>
				<button id="google-btn">Log in with Google</button>
				<span id="or-text">or</span>
			</div>
			<hr/>
			<input type="text" name="username" id="username-field" placeholder="Username" required="required"/>
			<input type="password" name="pwd" id="password-field" placeholder="Password" required="required"/>
			<div id="forgot-pwd-container">
				<a id="forgot-pwd-link" href="forgotpwd.html">Forgot Password?</a>
			</div>
			<input type="submit" name="submit" id="login-btn" value="Login"/>
			<div id="register-container">
				<p>Dont have an account? <a href="signup.php">Register</a></p>
			</div>
		</form>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="login.js"></script>
</body>
</html>
