<?php 
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible">
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
	<title>Profile | Foodbin</title>
</head>
<body>
	<div id="body-wrapper">
		<nav>
            <div id="nav-logo"><a href="foodbin.php"><b>Foodbin</b></a></div>
             <div id="horizontal-nav">
                <ul>
                    <?php 
                      if (isset($_SESSION['u_id'])){
                        echo '<li><i class="fa fa-user"></i>
                                <ul class="user-list">
                                  ' . '<li><a href="profile.php" id="user">' . $_SESSION['u_username'] . '</a></li>
                                        <li class="logout-item">
                                            <form action="includes/logout-inc.php" method="POST">
                                              <input type="submit" name="submit" value="Logout"/>
                                            </form>
                                        </li>' . '
                                </ul>
                              </li>';
                      } else {
                        echo '<li id="login-btn"><a href="login.php">Login</a></li>
                              <li id="signup-btn"><a href="signup.php">Sign Up</a></li>';
                      }
                    ?>
                    <li><a href="#" id="cart-container"><i class="fa fa-shopping-cart" id="shopping-cart" aria-hidden="true"></i><span id="cart-badge"></span></a></li>
                </ul>
            </div>            
        </nav>
		<div id="profile-area">
			<div id="profile-inner">
				<div class="col-4">
					<div id="image-container">
						<span id="upload-tooltip">Click icon to upload image</span>
					</div>
					<div id="input-container">
						<button id="add-image-btn">Add Profile Pic</button>
						<input type="file" name="user-image" id="file-input"/>
					</div>
					<div class="line-divider"></div>
					<div class="user-info-container">
						<div class="user-info-inner">
							<?php 
								echo "<ul id='user-list'>
										<li><span id='profile-name'>Name: </span> " . $_SESSION['u_first'] . " " .  $_SESSION['u_last'] . "</li>" .
										"<li><span id='profile-email'>Email: </span>" . $_SESSION['u_email'] . "</li>" . 
										"<li id='user-city'><span id='profile-city'>City: </span></li>" . 
									"</ul>";
							?>
						</div>
						<button id="edit-btn">Edit</button>
					</div>
				</div>
				<div class="col-8">
					
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript" src="profile.js"></script>
</body>
</html>