<?php
  session_start();
  include_once "includes/dbh-inc.php";
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
                      if (isset($_SESSION['user_id'])){
                        echo '<li><i class="fa fa-user"></i>
                                <ul class="user-list">
                                  ' . '<li id="user-parent"><a href="profile.php" id="user">' . $_SESSION['user_username'] . '</a></li>
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
            <?php
              if(isset($_SESSION['user_id'])){
                $id = $_SESSION['user_id'];
                $sql = "SELECT * FROM imgupload WHERE user_id='$id';";
                $result = mysqli_query($conn, $sql);
                $resultRows = mysqli_num_rows($result);
                if($resultRows > 0){
                  while($row = mysqli_fetch_assoc($result)){
                    $id = $row['user_id'];
                    if($row['img_status'] == 0){
                      $fileName = "uploads/profile".$id."*";
                      $allFiles = glob($fileName);
                      $fileArr = explode(".", $allFiles[0]);
                      $fileExt = strtolower($fileArr[1]);
                      echo "<input type='image' src='uploads/profile".$id.".".$fileExt."?".mt_rand()."' id='profile-pic'/>";
                    }
                  }
                }
              }
            ?>
					</div>
					<div id="input-container">
            <form action="includes/upload-inc.php" method="POST" enctype="multipart/form-data">
              <input type="file" name="file" id="file-input"/>
              <input type="button" value="Change Pic" id="change-pic-btn"/>
              <input type="submit" name="submit-pic" value="Upload" id="upload-pic-btn"/>
            </form>
					</div>
					<div class="line-divider"></div>
					<div class="user-info-container">
						<div class="user-info-inner">
							<?php
								echo "<ul id='user-list'>
										<li><span id='profile-name'>Name: </span> " . $_SESSION['user_first'] . " " .  $_SESSION['user_last'] . "</li>" .
										"<li><span id='profile-email'>Email: </span>" . $_SESSION['user_email'] . "</li>" .
										"<li id='user-city'><span id='profile-city'>City: </span>" . $_SESSION['user_city']. "</li>" .
									"</ul>";
							?>
						</div>
						<button id="edit-btn">Edit</button>
					</div>
				</div>
				<div class="col-8">
            <h2 id="current-order-heading">Orders in Progress</h2>
            <div id="current-order-outer">
              <div id="current-order-inner">
              <?php
                $sql = "SELECT * FROM current_orders WHERE user_id=$id;";
                $result = mysqli_query($conn, $sql);
                $resultRows = mysqli_num_rows($result); //this is the number of rows returned
                $currData = array();
                while($row = mysqli_fetch_assoc($result)){
                  $currData[] = $row;
                }
                if($resultRows < 1){
                  echo "<h3 style='text-align: center'>No orders at this time</h3>";
                  echo "<p style='text-align: center'><a href='foodbin.php'>Order Now</a></p>";
                } else {
                  for($orderRow = 0; $orderRow < $resultRows; $orderRow++){
                    $itemIdsString = $currData[$orderRow]['food_ids'];
                    $itemArr = explode(" ", $itemIdsString);
                    array_pop($itemArr);
                    $itemArrLength = count($itemArr);
                    echo "
                      <div class='store-location-container'>
                        <div class='order-store-name'>
                          " . $currData[$orderRow]['store_name'] . "
                        </div>
                        <div class='order-store-address'>
                          " . $currData[$orderRow]['store_address'] . "
                        </div>
                        <div class='order-store-city'>
                          " . $currData[$orderRow]['store_city'] . "
                        </div>
                      </div>
                    ";
                    echo "<div id='current-order-row'>";
                    for($col = 0; $col < $itemArrLength; $col++){
                      $specStr = $currData[$orderRow]['item_' . $itemArr[$col] . '_specs'];
                      $specsArr = explode(" | ", $specStr);
                      echo "
                        <div class='order-item'>
                          <input type='image' src='../foodbin/img/image". $itemArr[$col] . ".jpg'/>
                          <div class='item-details'>
                            " . $specsArr[0] . "<br/>" . $specsArr[1] . "<br/>" . $specsArr[2] . "<br/>" . $specsArr[3] . "
                          </div>
                        </div>
                      ";
                    }
                    echo "</div>";
                    echo "
                      <div class='current-order-footer'>
                        <button class='edit-order-btn'>Edit Order</button>
                        <button id='order-completed-btn'>Completed</button>
                      </div>
                      <form action='includes/eraseOrder.php' method='POST' id='erase-order-form'>
                        <input type='submit' name='submit' value='Submit' id='erase-order-btn'/>
                      </form>
                      <div class='line-divider'></div>
                    ";
                  }
                }
              ?>
              </div>
            </div>
            <div id="previous-orders-container">
              <?php
                $sql = "SELECT * FROM previous_orders WHERE user_id='$id';";
                $result = mysqli_query($conn, $sql);
                $resultRows2 = mysqli_num_rows($result);
                $prevData = array();
                while($row = mysqli_fetch_assoc($result)){
                  $prevData[] = $row;
                }
                if($resultRows == 0 || $resultRows2 > 0){
                  if($resultRows == 0 || $resultRows2 > 0){
                    echo "
                      <h2 id='previous-orders-heading'>Previous Orders</h2>
                      <div class='previous-order-outer'>
                    ";
                  } else {
                    echo "
                      <div class='previous-order-outer one-row'>
                    ";
                  }
                  $sqlCheck = "SELECT * FROM current_orders WHERE user_id=$id;";
                  $resultRows3 = mysqli_num_rows(mysqli_query($conn, $sqlCheck));
                  if($resultRows3 < 1){
                    for($orderRow = 0; $orderRow < $resultRows2; $orderRow++){
                      $itemIdsString = $prevData[$orderRow]['food_ids'];
                      $itemArr = explode(" ", $itemIdsString);
                      array_pop($itemArr);
                      $itemArrLength = count($itemArr);
                      echo "
                        <div class='store-location-container'>
                          <div class='order-store-name'>
                            " . $prevData[$orderRow]['store_name'] . "
                          </div>
                          <div class='order-store-address'>
                            " . $prevData[$orderRow]['store_address'] . "
                          </div>
                          <div class='order-store-city'>
                            " . $prevData[$orderRow]['store_city'] . "
                          </div>
                        </div>
                      ";
                      echo "<div class='previous-order-row'>";
                      for($col = 0; $col < $itemArrLength; $col++){
                        $specStr = $prevData[$orderRow]['item_' . $itemArr[$col] . '_specs'];
                        $specsArr = explode(" | ", $specStr);
                        echo "
                          <div class='order-item'>
                            <input type='image' src='../foodbin/img/image". $itemArr[$col] . ".jpg'/>
                            <div class='item-details'>
                              " . $specsArr[0] . "<br/>" . $specsArr[1] . "<br/>" . $specsArr[2] . "<br/>" . $specsArr[3] . "
                            </div>
                          </div>
                        ";
                      }
                      echo "</div>";
                      echo "
                        <div class='previous-order-footer'>
                          <button class='order-again-btn'>Order Again</button>
                          <button class='remove-order-btn'>Remove Order</button>
                        </div>
                        <div class='line-divider'></div>
                      ";
                    }
                  } else {
                    for($orderRow = 0; $orderRow < ($resultRows2 - 1); $orderRow++){
                      $itemIdsString = $prevData[$orderRow]['food_ids'];
                      $itemArr = explode(" ", $itemIdsString);
                      array_pop($itemArr);
                      $itemArrLength = count($itemArr);
                      echo "
                        <div class='store-location-container'>
                          <div class='order-store-name'>
                            " . $prevData[$orderRow]['store_name'] . "
                          </div>
                          <div class='order-store-address'>
                            " . $prevData[$orderRow]['store_address'] . "
                          </div>
                          <div class='order-store-city'>
                            " . $prevData[$orderRow]['store_city'] . "
                          </div>
                        </div>
                      ";
                      echo "<div class='previous-order-row'>";
                      for($col = 0; $col < $itemArrLength; $col++){
                        $specStr = $prevData[$orderRow]['item_' . $itemArr[$col] . '_specs'];
                        $specsArr = explode(" | ", $specStr);
                        echo "
                          <div class='order-item'>
                            <input type='image' src='../foodbin/img/image". $itemArr[$col] . ".jpg'/>
                            <div class='item-details'>
                              " . $specsArr[0] . "<br/>" . $specsArr[1] . "<br/>" . $specsArr[2] . "<br/>" . $specsArr[3] . "
                            </div>
                          </div>
                        ";
                      }
                      echo "</div>";
                      echo "
                        <div class='previous-order-footer'>
                          <button class='order-again-btn'>Order Again</button>
                          <button class='remove-order-btn'>Remove Order</button>
                        </div>
                        <div class='line-divider'></div>
                      ";
                    }
                  }
                } else {
                  if($resultRows2 == 1 && $resultRows  == 1){
                    echo "<h3 style='text-align: center'>No previous orders</h3>";
                  }
                }
              ?>
              </div>
            </div>
				</div>
        <div id="edit-modal-window">
          <!-- <div id="cart-close-container">
            <span class="modal-close-btn"></span>
          </div> -->
          <div id="edit-profile-Container">

          </div>
        </div>
			</div>
		</div>
	</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="profile.js"></script>
</body>
</html>
