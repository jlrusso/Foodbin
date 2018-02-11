 <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Lobster|Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="signup.css">
	<title>Sign Up Form</title>
</head>
<body>
	<div class="container">
		<div class="header">
			<div id="header-logo"><a href="foodbin.php">Foodbin</a></div>
		</div>
		<form action="includes/signup-inc.php" method="POST">
			<h4>Social Media</h4>
			<div id="social-btn-container">
				<button id="facebook-btn">Facebook Sign Up</button>
				<button id="google-btn">Google Sign Up</button>
				<span id="or-text">or</span>
			</div>	
			<hr/>
			<input type="text" name="first" id="first-name-field" placeholder="First Name""/>
			<input type="text" name="last" id="last-name-field" placeholder="Last Name""/>
			<input type="text" name="email" id="email-field" placeholder="E-mail""/>
			<input type="text" name="username" id="username-field" placeholder="Username""/>
			<input type="password" name="pwd" id="password-field" placeholder="Password""/>
			<input type="submit" name="submit" id="signup-btn" value="Sign Up"/>
			<div id="account-container">
				<p>Already have an account? <a href="login.php">Log In</a></p>
			</div>
		</form>	
	</div>
</body>
</html>