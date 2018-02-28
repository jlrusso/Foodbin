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
				<button id="facebook-btn">Sign up with Facebook</button>
				<button id="google-btn">Sign up with Google</button>
				<span id="or-text">or</span>
			</div>
			<hr/>
      <input type="text" name="first" id="first-name-field" placeholder="First Name" autocomplete="off" required/>
			<input type="text" name="last" id="last-name-field" placeholder="Last Name" autocomplete="off" required/>
			<input type="text" name="email" id="email-field" placeholder="E-mail" autocomplete="off" required/>
			<input type="text" name="username" id="username-field" placeholder="Username" autocomplete="off" required/>
			<input type="password" name="pwd" id="password-field" placeholder="Password" autocomplete="off" required/>
      <select required name="city" id="city-selection">
        <option value="" id="city-heading">City:</option>
        <option value="Sacramento, CA">Sacramento, CA</option>
        <option value="San Francisco, CA">San Francisco, CA</option>
        <option value="Oakland, CA">Oakland, CA</option>
        <option value="Fremont, CA">Fremont, CA</option>
        <option value="Berkeley, CA">Berkeley, CA</option>
        <option value="Stockton, CA">Stockton, CA</option>
        <option value="San Jose, CA">San Jose, CA</option>
        <option value="Los Angeles, CA">Los Angeles, CA</option>
        <option value="San Diego, CA">San Diego, CA</option>
        <option value="Santa Barbara, CA">Santa Barbara, CA</option>
        <option value="Riverside, CA">Riverside, CA</option>
        <option value="Long Beach, CA">Long Beach, CA</option>
        <option value="Anaheim, CA">Anaheim, CA</option>
        <option value="Irvine, CA">Irvine, CA</option>
      </select>
			<input type="submit" name="submit" id="signup-btn" value="Sign Up"/>
			<div id="account-container">
				<p>Already have an account? <a href="login.php">Log In</a></p>
			</div>
		</form>
	</div>
  <script type="text/text/javascript" src="signup.js"></script>
</body>
</html>
