<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Foodbin</title>
</head>
<body>
	<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="foodbin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <title>Foodie Bin</title>
</head>
<body>
    <div id="container">

        <nav>
            <div id="nav-logo"><a href="foodbin.php"><b>Foodbin</b></a></div>
             <div id="horizontal-nav">
                <ul>
                    <?php
                      # - check if a user is logged in
                      if(isset($_SESSION['user_id'])){
                        echo "<span id='user-logged-in' style='display:none'>yes</span>";
                      } else {
                        echo "<span id='user-logged-in' style='display:none'>no</span>";
                      }
                      # - check if order is in progress
                      if(isset($_SESSION['order-in-progress'])){
                        if($_SESSION['order-in-progress'] == "yes"){
                          echo "<span id='order-in-progress'>yes</span>";
                        } else {
                          echo "<span id='order-in-progress'>no</span>";
                        }
                      }
                      if (isset($_SESSION['edit-in-progress'])){
                        if($_SESSION['edit-in-progress'] == "yes"){
                          echo "<span id='edit-in-progress'>yes</span>";
                        } else {
                          echo "<span id='edit-in-progress'>no</span>";
                        }
                      }
                      if (isset($_SESSION['same-order-in-progress'])){
                        if($_SESSION['same-order-in-progress'] == "yes"){
                          echo "<span id='same-order-in-progress'>yes</span>";
                        } else {
                          echo "<span id='same-order-in-progress'>no</span>";
                        }
                      }
                      # - end of order in progress check
                      include_once "includes/dbh-inc.php";
                      if (isset($_SESSION['user_id'])){
                        echo "<span id='logged-in' class='yes'></span>";
                        echo '<li><i class="fa fa-user"></i>
                                <ul class="user-list">
                                <li id="user-parent"><a href="profile.php" id="user">' . $_SESSION['user_username'] . '</a></li>
                                <li>
                                    <form action="includes/logout-inc.php" method="POST">
                                      <input type="submit" name="submit" value="logout" id="logout-btn"/>
                                    </form>
                                </li>
                                </ul>
                              </li>';
                      } else {
                        echo "<span id='logged-in' class='no'></span>";
                        echo '<li id="login-btn"><a href="login.php">Login</a></li>
                              <li id="signup-btn"><a href="signup.php">Sign Up</a></li>';
                      }

                      if(isset($_SESSION['edit-in-progress']) && isset($_SESSION['same-order-in-progress'])){
                        # start of edit
                        if($_SESSION['edit-in-progress'] == "yes"){
                          $id = $_SESSION['user_id'];
                          $editData = array();
                          $sql = "SELECT * FROM edit_orders WHERE user_id=$id;";
                          $result = mysqli_query($conn, $sql);
                          $resultRows = mysqli_num_rows($result);
                          if($resultRows > 0){
                            while($row = mysqli_fetch_assoc($result)){
                              $editData[] = $row;
                            }
                            $itemIdsString = $editData[0]['food_ids'];
                            $itemArr = explode(" ", $itemIdsString);
                            array_pop($itemArr);
                            $itemArrLength = count($itemArr);
                            $editVal = $_SESSION['edit-in-progress'];
                            echo "
                              <li><a href='#' id='cart-container' vers='1'><i class='fa fa-shopping-cart' id='shopping-cart' aria-hidden='true'></i><span id='cart-badge' style='display:block'>" . $itemArrLength . "</span></a></li>
                            ";
                          }
                        } else if ($_SESSION['same-order-in-progress'] == "yes"){
                          $id = $_SESSION['user_id'];
                          $orderRequested = $_SESSION['order-requested-again'];
                          $prevData = array();
                           $sql = "SELECT * FROM previous_orders WHERE user_id=$id AND order_id=$orderRequested;";
                          $result = mysqli_query($conn, $sql);
                          $resultRows = mysqli_num_rows($result);
                          if($resultRows > 0){
                            while($row = mysqli_fetch_assoc($result)){
                              $prevData[] = $row;
                            }
                            $itemIdsString = $prevData[0]['food_ids'];
                            $itemArr = explode(" ", $itemIdsString);
                            array_pop($itemArr);
                            $itemArrLength = count($itemArr);
                            echo "
                              <li><a href='#' id='cart-container' vers='3'><i class='fa fa-shopping-cart' id='shopping-cart' aria-hidden='true'></i><span id='cart-badge' style='display: block'>" . $itemArrLength . "</span></a></li>
                            ";
                          }
                        } else {
                          echo "
                            <li><a href='#' id='cart-container' vers='5'><i class='fa fa-shopping-cart' id='shopping-cart' aria-hidden='true'></i><span id='cart-badge'></span></a></li>
                          ";
                        }
                      } else if (isset($_SESSION['user_id'])) {
                        echo "
                          <li><a href='#' id='cart-container' vers='5'><i class='fa fa-shopping-cart' id='shopping-cart' aria-hidden='true'></i><span id='cart-badge'></span></a></li>
                        ";
                      }
                    ?>
                </ul>
            </div>
        </nav>

        <div id="banner-area">
        	<div id="banner-overlay"></div>
            <div id="banner-inner">
                <p id="banner-heading">Food just clicks away.</p>
                <p>No need to drive, wait in a long line, or hope that your items are available</p>
                <button type="button" class="banner-btn" id="request-btn">Place an Order</button>
                <button type="button" class="banner-btn" id="deliver-btn">Make a Delivery</button>
            </div>
        </div>

        <div id="how-it-works-area">
          <div class="hiw-row">
            <div class="hiw-row-inner">
              <input type="image" src="../foodbin/img/chooselocation.png" alt="Maps"/>
              <div class="image-caption right-caption">
                <div class="image-caption-inner">
                  <h1>Choose a Location</h1>
                  <p>Pick available grocery stores in your city via google maps</p>
                </div>
              </div>
            </div>
          </div>
          <div class="hiw-row">
            <div class="hiw-row-inner">
              <div class="image-caption left-caption">
                <div class="image-caption-inner">
                  <h1>Select Food Items</h1>
                  <p>Get as specific as you want, then add the items to your cart</p>
                </div>
              </div>
              <input type="image" src="../foodbin/img/chooseitems.png" alt="Item Selection"/>
            </div>
          </div>
          <div class="hiw-row">
            <div class="hiw-row-inner">
              <input type="image" src="../foodbin/img/makechanges.png" alt="Edit Order"/>
              <div class="image-caption right-caption">
                <div class="image-caption-inner">
                  <h1>Change Order Anytime</h1>
                  <p>Make changes to your order at any time before food is delivered</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div id="user-map-area">
        	<div id="user-location-section">
        		<h3>Choose a Location</h3>
        		<form>
		            <div id="input-container">
                    <div id="marker-input-container">
                      <span><i class="fa fa-map-marker"></i></span>
                      <input type="text" id="location-input-field" placeholder="city, state" autocomplete="off" required="required" />
                    </div>
                    <div id="search-case-list">
                      <ul id="search-list-group">
                          <li><a href="#">Sacramento, CA</a></li>
                          <li><a href="#">San Francisco, CA</a></li>
                          <li><a href="#">Oakland, CA</a></li>
                          <li><a href="#">San Diego, CA</a></li>
                          <li><a href="#">Fremont, CA</a></li>
                          <li><a href="#">Berkeley, CA</a></li>
                          <li><a href="#">Stockton, CA</a></li>
                          <li><a href="#">San Jose, CA</a></li>
                          <li><a href="#">Los Angeles, CA</a></li>
                          <li><a href="#">Santa Barbara, CA</a></li>
                          <li><a href="#">Riverside, CA</a></li>
                          <li><a href="#">Long Beach, CA</a></li>
                          <li><a href="#">Anaheim, CA</a></li>
                          <li><a href="#">Irvine, CA</a></li>
                      </ul>
                    </div>

                  <select name="sacramento-store-list" id="sacramento-store-list" class="store-list">
                    <option style="font-weight: bold" value="Stores Heading">Choose a store:</option>
                    <option value="1025-Safeway">Safeway (1025 Alhambra Blvd)</option>
                    <option value="1814-Safeway">Safeway (1814 19th St)</option>
                    <option value="2820-Nat-Coop">Sac. Natural Foods Co-op (2820 R St)</option>
                    <option value="5000-Trader-Joes">Trader Joe&apos;s (5000 Folsom Blvd)</option>
                    <option value="5810-Corti-Brothers">Corti Brothers (5810 Folsom Blvd)</option>
                    <option value="3547-Food-Source">Food Source (3547 Bradshaw Rd)</option>
                    <option value="2900-Taylors-Market">Taylor&apos;s Market (2900 Freeport Blvd)</option>
                    <option value="4990-Otos-Market">Oto&apos;s Market (4990 Freeport Blvd)</option>
                    <option value="7205-Smart-Final">Smart &amp; Final Extra (7205 Freeport Blvd)</option>
                    <option value="1040-Nugget-Markets">Nugget Market&apos;s (1040 Florin Rd)</option>
                    <option value="5021-Foodsco">Foodsco (5021 Fruitridge Rd)</option>
                  </select>

                  <select name="san-franciso-store-list" id="san-francisco-store-list" class="store-list">
                    <option style="font-weight: bold" value="Stores Heading">Choose a store:</option>
                    <option value="15-Safeway">Safeway (15 Marina Blvd)</option>
                    <option value="350-Safeway">Safeway (350 Bay St)</option>
                    <option value="145-Safeway">Safeway (145 Jackson St)</option>
                    <option value="759-Ming-Lee-Trading">Ming Lee Trading (759 Jackson St)</option>
                    <option value="1095-Trader-Joes">Trader Joe&apos;s (1095 Hyde St)</option>
                    <option value="1335-Safeway">Safeway (1335 Webster St)</option>
                    <option value="1355-The-Market">The Market (1355 Market St)</option>
                    <option value="985-Market-Mayflower-Deli">Market Mayflower &amp; Deli (985 Bush St)</option>
                    <option value="298-Safeway">Safeway (298 King St)</option>
                    <option value="308-Falletti-Foods">Falletti Foods (308 Broderick St)</option>
                  </select>

                  <select name="oakland-store-list" id="oakland-store-list" class="store-list">
                    <option style="font-weight: bold" value="Stores Heading">Choose a store:</option>
                    <option value="5727-Trader-Joes">Trader Joe&apos;s (5727 College Ave)</option>
                    <option value="5885-Village-Market">Village Market (5885 Broadway Terrace)</option>
                    <option value="5100-Safeway">Safeway (5100 Broadway)</option>
                    <option value="4038-Piedmont-Grocery-Co">Piedmont Grocery Co (4038 Piedmont Ave)</option>
                    <option value="2096-Safeway">Safeway (2096 Mountain Blvd)</option>
                    <option value="3747-Safeway">Safeway (3747 Grand Ave)</option>
                    <option value="3250-Trader-Joes">Trader Joe&apos;s (3250 Lakeshore Ave)</option>
                    <option value="1440-Rockys-Market">Rocky's Market (1440 Leimert Blvd)</option>
                    <option value="1431-Natures-Best-Foods">Nature&apos;s Best Foods (1431 Jackson St)</option>
                    <option value="3426-Farmer-Joes-Marketplace">Farmer Joe&apos;s Marketplace (3426 Fruitvale Ave)</option>
                  </select>

                  <select name="san-diego-store-list" id="san-diego-store-list" class="store-list">
                    <option style="font-weight: bold" value="Stores Heading">Choose a store:</option>
                    <option value="1666-Ralphs">Ralphs (1666 Rosecrans St)</option>
                    <option value="3645-Vons">Vons (3645 Midway Dr)</option>
                    <option value="3345-Ralphs">Ralphs (3345 Sports Arena Blvd)</option>
                    <option value="515-Vons">Vons (515 W Washington St)</option>
                    <option value="1020-Ralphs">Ralphs (1020 University Ave)</option>
                    <option value="101-Ralphs">Ralphs (101 G St, San Diego)</option>
                    <option value="1002-GOBM">Grocery Outlet Bargain Market (1002 Market street)</option>
                    <option value="4315-Ralphs">Ralphs (4315 Mission Blvd)</option>
                    <option value="1702-Vons">Vons (1702 Garnet Ave)</option>
                    <option value="655-Albertsons">Albertsons (655 14th St)</option>
                    <option value="5680-Ralphs">Ralphs (5680 Mission Center Rd)</option>
                    <option value="3610-Vons">Vons (3610 Adams Ave)</option>
                    <option value="6670-Ralphs">Ralphs (6670 Montezuma Rd)</option>
                    <option value="6386-Windmill-Farms">Windmill Farms (6386 Del Cerro Blvd)</option>
                    <option value="7403-Keils">Keils (7403 Jackson Dr)</option>
                    <option value="3011-Ralphs">Ralphs (3011 Alta View Dr)</option>
                  </select>

                  <select name="fremont-store-list" id="fremont-store-list" class="store-list">
                    <option style="font-weight: bold" value="Stores Heading">Choose a store:</option>
                    <option value="35820-Lucky">Lucky (35820 Fremont Blvd)</option>
                    <option value="37235-Maiwand-Market">Maiwand Market (37235 Fremont Blvd)</option>
                    <option value="3111-Whole-Food's-Market">Whole Food&apos;s Market (3111 Mowry Ave)</option>
                    <option value="39200-Raley's">Raley&apos;s (39200 Paseo Padre Pkwy)</option>
                    <option value="3171-Smart-Final">Smart &amp; Final Extra (3171 Walnut Ave)</option>
                    <option value="3890-Indian-Market">Indian Market (3890 Walnut Ave)</option>
                    <option value="39100-Safeway">Safeway (39100 Argonaut Way)</option>
                    <option value="39324-Trader Joe's">Trader Joe&apos;s (39324 Argonaut Way)</option>
                    <option value="39175-India-Cash-Carry">India Cash &amp; Carry (39175 Farwell Dr)</option>
                    <option value="4949-Grocery-Outlet-Bargain-Market">Grocery Outlet Bargain Market (4949 Stevenson Blvd)</option>
                    <option value="3902-Safeway">Safeway (3902 Washington Blvd)</option>
                  </select>

                  <select name="berkeley-store-list" id="berkeley-store-list" class="store-list">
                    <option style="font-weight: bold" value="Stores Heading">Choose a store:</option>
                    <option value="1336-Berkeyley-Natural-Grocery-Company">Berkeley Natural Grocery Company (1336 Gilman St)</option>
                    <option value="1444-Safeway">Safeway (1444 Shattuck Pl)</option>
                    <option value="1601-Cedar-Market">Cedar Market (1601 California St)</option>
                    <option value="1550-Safeway-Community-Markets">Safeway Community Markets (1550 Shattuck Ave)</option>
                    <option value="2700-Foothill-Club-Market">Foothill Club Market (2700 Hearst Ave)</option>
                    <option value="1885-Trader-Joe's">Trader Joe&apos;s (1885 University Ave)</option>
                    <option value="2082-Mi-Tierra-Foods">Mi Tierra Foods (2082 San Pablo Ave)</option>
                    <option value="2440-Alex-Market">Alex Market (2440 Sacramento St)</option>
                    <option value="2441-Shattuck-Market">Shattuck Market (2441 Shattuck Ave)</option>
                    <option value="901-Franklin-Bros-Market">Franklin Bros. Market (901 Bancroft Way)</option>
                    <option value="3000-Whole-Foods-Market">Whole Foods Market (3000 Telegraph Ave)</option>
                  </select>

                  <select name="stockton-store-list" id="stockton-store-list" class="store-list">
                    <option style="font-weight: bold" value="Stores Heading">Choose a store:</option>
                    <option value="4255-Raley's">Raley&apos;s (4255 E Morada Ln)</option>
                    <option value="789-Food-4-Less">Food 4 Less (789 W Hammer Ln)</option>
                    <option value="8004-SF-Supermarket">SF Supermarket (8004 West Ln)</option>
                    <option value="5110-WinCo-Foods">WinCo Foods (5110 Montauban Ave)</option>
                    <option value="6445-Safeway">Safeway (6445 Pacific Ave)</option>
                    <option value="744-Smart-Final-Extra">Smart &amp; Final Extra (744 W Hammer Ln)</option>
                    <option value="6618-Grocery-Outlet-Bargain-Market">Grocery Outlet Bargain Market (6618 Pacific Ave)</option>
                    <option value="4725-Save-Mart-Supermarkets">Save Mart Supermarkets (4725 Quail Lakes Dr)</option>
                    <option value="1536-La-Superior-Super-Mercados">La Superior Super Mercados (1536 Waterloo Rd)</option>
                    <option value="748-Madison-Market">Madison Market (748 N Madison St)</option>
                  </select>

                  <select name="san-jose-store-list" id="san-jose-store-list" class="store-list">
                    <option style="font-weight: bold" value="Stores Heading">Choose a store:</option>
                    <option value="1179-H-Mart">H Mart (1179 S De Anza Blvd)</option>
                    <option value="471-Lion-Market">Lion Market (471 Saratoga Ave)</option>
                    <option value="635-Trader-Joe's">Trader Joe&apos;s (635 Coleman Ave)</option>
                    <option value="420-Dai-Thanh-Supermarket">Dai Thanh Supermarket (420 S 2nd St)</option>
                    <option value="1300-Safeway">Safeway (1300 W San Carlos St)</option>
                    <option value="1003-Arteaga's">Arteaga&apos;s (1003 Lincoln Ave)</option>
                    <option value="777-Whole-Foods-Market">Whole Foods Market (777 The Alameda)</option>
                    <option value="245-Santo-Market-Inc">Santo Market Inc (245 E Taylor St)</option>
                    <option value="2300-Grocery-Outlet-Bargain-Market">Grocery Outlet Bargain Market (2300 Monterey Rd)</option>
                    <option value="1530-Safeway">Safeway (1530 Hamilton Ave)</option>
                    <option value="675-Mitsuwa-Marketplace">Mitsuwa Marketplace (675 Saratoga Ave)</option>
                  </select>

                  <select name="los-angeles-store-list" id="los-angeles-store-list" class="store-list">
                    <option style="font-weight: bold" value="Stores Heading">Choose a store:</option>
                    <option value="11737-Whole-Foods-Market">Whole Foods Market (11737 San Vicente Blvd)</option>
                    <option value="10250-Gelson's-Market">Gelson&apos;s Market (10250 California State Route 2)</option>
                    <option value="2716-Super-King-Market">Super Kind Market (2716 N San Fernando Rd)</option>
                    <option value="4520-Vons">Vons (4520 Sunset Blvd)</option>
                    <option value="5914-Fresco-Community-Market">Fresco Community Market (5914 Monterey Rd)</option>
                    <option value="727-Pavilions">Pavilions (727 N Vine St)</option>
                    <option value="5245-Ralphs">Ralphs (5245 W Centinela Ave)</option>
                    <option value="788-Whole-Foods-Market">Whole Foods Market (788 S Grand Ave)</option>
                    <option value="845-Smart-Final-Extra">Smart &amp; Final Extra (845 S Figueroa St #100)</option>
                    <option value="3461-Vons">Vons (3461 W 3rd St)</option>
                    <option value="661-Urban-Radish">Urban Radish (661 Imperial St)</option>
                  </select>

                  <select name="santa-barbara-store-list" id="santa-barbara-store-list" class="store-list">
                    <option style="font-weight: bold" value="Stores Heading">Choose a store:</option>
                    <option value="4422-European-Deli-Market">European Deli Market (4422 Hollister Ave)</option>
                    <option value="3855-Vons">Vons (3855 State St)</option>
                    <option value="3761-Whole-Foods-Market">Whole Foods Market (3761 State St)</option>
                    <option value="3303-Gelsons-Market">Gelson&apos;s Market (3303 State St)</option>
                    <option value="2840-Grocery-Outlet-Bargain-Market">Grocery Outlet Bargain Market (2840 De La Vina St)</option>
                    <option value="1501-Foodland-Market">Foodland Market (1501 San Andres St)</option>
                    <option value="100-Ralphs">Ralphs (100 W Carrillo St)</option>
                    <option value="324-Santa-Cruz-Market">Santa Cruz Market (324 W Montecito St)</option>
                    <option value="217-Smart-Final">Smart &amp; Final (217 E Gutierrez St)</option>
                    <option value="2010-Vons">Vons (2010 Cliff Dr)</option>
                    <option value="435-Brownies-Market">Brownie&apos;s Market (435 De La Vina St)</option>
                  </select>

                  <select name="riverside-store-list" id="riverside-store-list" class="store-list">
                    <option style="font-weight: bold" value="Stores Heading">Choose a store:</option>
                    <option value="4050-Maxi-Foods-Market">Maxi Foods Market (4050 University Ave)</option>
                    <option value="191-Goodwins">Goodwin&apos;s Organic Foods and Drinks (191 W Big Springs Rd)</option>
                    <option value="3310-Smart-Final">Smart &amp; Final (3310 Vine St)</option>
                    <option value="6155-Ralphs">Ralphs (6155 Magnolia Ave)</option>
                    <option value="5225-Ralphs">Ralphs (5225 Canyon Crest Dr)</option>
                    <option value="3520-Vons">Vons (3520 Riverside Plaza Dr)</option>
                    <option value="5202-Smart-Final-Extra">Smart &amp; Final Extra (5202 Arlington Ave)</option>
                    <option value="6225-Trader-Joes">Trader Joe&apos;s (6225 Riverside Ave)</option>
                    <option value="2975-Albertsons">Albertsons (2975 Van Buren Boulevard)</option>
                    <option value="2744-Smart-Final-Extra">Smart &amp; Final Extra (2744 Canyon Springs Pkwy)</option>
                    <option value="475-Sprouts">Sprouts Farmers Market (475 E Alessandro Blvd)</option>
                  </select>

                  <select name="long-beach-store-list" id="long-beach-store-list" class="store-list">
                    <option style="font-weight: bold" value="Stores Heading">Choose a store:</option>
                    <option value="4700-Northgate-Gonzalez-Markets">Northgate Gonzalez Markets (4700 Cherry Ave)</option>
                    <option value="4550-Vons">Vons (4550 Atlantic Ave)</option>
                    <option value="2250-Ralphs">Ralphs (2250 E Carson St)</option>
                    <option value="101-Albertsons">Albertsons (101 E Willow St)</option>
                    <option value="3380-Ralphs">Ralphs (3380 N Los Coyotes Diagonal)</option>
                    <option value="2222-Trader-Joes">Trader Joe&apos;s (2222 N Bellflower Blvd)</option>
                    <option value="1930-Ralphs">Ralphs (1930 N Lakewood Blvd)</option>
                    <option value="2930-Ralphs">Ralphs (2930 E 4th St)</option>
                    <option value="600-Vons">Vons (600 E Broadway)</option>
                    <option value="346-Ma-N-Pa-Grocery">Ma N&apos; Pa Grocery (346 Roycroft Ave)</option>
                    <option value="3900-Vons">Vons (3900 E Ocean Blvd)</option>
                  </select>

                  <select name="anaheim-store-list" id="anaheim-store-list" class="store-list">
                    <option style="font-weight: bold" value="Stores Heading">Choose a store:</option>
                    <option value="12961-Vons">Vons (12961 W Chapman Ave)</option>
                    <option value="10500-Super-King-Markets">Super King Markets (10500 S Magnolia Ave)</option>
                    <option value="2394-Vallarta-Supermarkets">Vallarta Supermarkets (2394 W Lincoln Ave)</option>
                    <option value="1616-Food-4-Less">Food 4 Less (1616 W Katella Ave)</option>
                    <option value="130-Vons">Vons (130 W Lincoln Ave)</option>
                    <option value="1120-Walmart-Neighborhood-Market">Walmart Neighborhood Market (1120 S Anaheim Blvd)</option>
                    <option value="810-Vons">Vons (810 S State College Blvd)</option>
                    <option value="5600-Vons">Vons (5600 E Santa Ana Canyon Rd)</option>
                    <option value="711-Ralphs">Ralphs (711 S Weir Canyon Rd)</option>
                    <option value="2030-Northgate-Gonzalez-Markets">Northgate Gonzalez Markets (2030 E Lincoln Ave)</option>
                    <option value="5755-Wholesome-Choice">Wholesome Choice (5755 La Palma Ave)</option>
                  </select>

                  <select name="irvine-store-list" id="irvine-store-list" class="store-list">
                    <option style="font-weight: bold" value="Stores Heading">Choose a store:</option>
                    <option value="8525-Whole-Foods-Market">Whole Foods Market (8525 Irvine Center Dr)</option>
                    <option value="6601-Albertsons">Albertsons (6601 Quail Hill Pkwy)</option>
                    <option value="4541-Albertsons">Albertsons (4541 Campus Dr)</option>
                    <option value="3825-Albertsons">Albertsons (3825 Alton Pkwy)</option>
                    <option value="17605-Ralphs">Ralphs (17605 Harvard Ave)</option>
                    <option value="5521-Gelson's-Market">Gelson&apos;s Market (5521 Alton Pkwy)</option>
                    <option value="7020-Village-Market">Village Market (7020 Scholarship)</option>
                    <option value="6300-Ralphs">Ralphs (6300 Irvine Blvd)</option>
                    <option value="14120-Super-Irvine">Super Irvine (14120 Culver Dr)</option>
                    <option value="14417-Smart-Final-Extra">Smart &amp; Final Extra (14417 Culver Dr)</option>
                    <option value="14400-Ralphs">Ralphs (14400 Culver Dr)</option>
                  </select>

                  <select name="delivery-time" id="delivery-time-list">
                    <option style="font-weight: bold" value="Stores Heading">Delivery Time:</option>
                    <option value="eight-am">8:00 AM</option>
                    <option value="nine-am">9:00 AM</option>
                    <option value="ten-am">10:00 AM</option>
                    <option value="eleven-am">11:00 AM</option>
                    <option value="twelve-pm">12:00 PM</option>
                    <option value="one-pm">1:00 PM</option>
                    <option value="two-pm">2:00 PM</option>
                    <option value="three-pm">3:00 PM</option>
                    <option value="four-pm">4:00 PM</option>
                    <option value="five-pm">5:00 PM</option>
                    <option value="six-pm">6:00 PM</option>
                    <option value="seven-pm">7:00 PM</option>
                    <option value="eight-pm">8:00 PM</option>
                    <option value="nine-pm">9:00 PM</option>
                    <option value="ten-pm">10:00 PM</option>
                    <option value="eleven-pm">11:00 PM</option>
                  </select>

                  <div id="delivery-btn-container">
                    <span id="checkmark">&#10004;</span>
                    <input type="submit" id="delivery-btn" value="Deliver From Here"/>
                    <p id="delivery-btn-caption">Must choose a city and store for delivery</p>
                  </div>

		            </div>
		        </form>
        	</div>
          <div id="map-container">
            <div id="map"></div>
          </div>
        </div>

        <div id="food-area">
          <section class="food-type-section">
                <div class="food-type-heading">Candy</div>
                <div class="slide-btns-container">
                  <button class="slide-left-btn"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                  <button class="slide-right-btn"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                </div>
                <div class="outer-images-container">
                    <div class="inner-images-container">
                      <div class="per-image-container">
                          <input type="image" src="../foodbin/img/image1.jpg" alt="Twix" data="1"/>
                          <div class="image-btn">Twix</div>
                      </div>
                      <div class="per-image-container">
                        <input type="image" src="../foodbin/img/image2.jpg" alt="Marsbar" data="2"/>
                        <div class="image-btn">Marsbar</div>
                      </div>
                      <div class="per-image-container">
                        <input type="image" src="../foodbin/img/image3.jpg" alt="Gummybears" data="3"/>
                        <div class="image-btn">Gummybears</div>
                      </div>
                      <div class="per-image-container">
                        <input type="image" src="../foodbin/img/image4.jpg" alt="Jellybeans" data="4"/>
                        <div class="image-btn">Jellybeans</div>
                      </div>
                      <div class="per-image-container">
                        <input type="image" src="../foodbin/img/image5.jpg" alt="M&M's" data="5"/>
                        <div class="image-btn">M&amp;M's</div>
                      </div>
                      <div class="per-image-container">
                        <input type="image" src="../foodbin/img/image6.jpg" alt="Skittles" data="6"/>
                        <div class="image-btn">Skittles</div>
                      </div>
                      <div class="per-image-container">
                        <input type="image" src="../foodbin/img/image7.jpg" alt="Hersheys" data="7"/>
                        <div class="image-btn">Hersheys</div>
                      </div>
                      <div class="per-image-container">
                        <input type="image" src="../foodbin/img/image8.jpg" alt="Snickers" data="8"/>
                        <div class="image-btn">Snickers</div>
                      </div>
                      <div class="per-image-container">
                        <input type="image" src="../foodbin/img/image9.jpg" alt="Sourpatch" data="9"/>
                        <div class="image-btn">Sourpatch</div>
                      </div>
                      <div class="per-image-container">
                        <input type="image" src="../foodbin/img/image10.jpg" alt="Candycorn" data="10"/>
                        <div class="image-btn">Candycorn</div>
                      </div>
                    </div>
                </div>
            </section>
            <div class="food-line-divider"></div>

            <section class="food-type-section">
                <div class="food-type-heading">Vegetables</div>
                <div class="slide-btns-container">
                  <button class="slide-left-btn"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                  <button class="slide-right-btn"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                </div>
                <div class="outer-images-container">
                    <div class="inner-images-container">
                      <div class="per-image-container">
                        <input type="image" src="../foodbin/img/image11.jpg" alt="Broccoli" data="11"/>
                        <div class="image-btn">Broccoli</div>
                      </div>
                      <div class="per-image-container">
                        <input type="image" src="../foodbin/img/image12.jpg" alt="Squash" data="12"/>
                        <div class="image-btn">Squash</div>
                      </div>
                      <div class="per-image-container">
                        <input type="image" src="../foodbin/img/image13.jpg" alt="Cauliflower" data="13"/>
                        <div class="image-btn">Cauliflower</div>
                      </div>
                      <div class="per-image-container">
                        <input type="image" src="../foodbin/img/image14.jpg" alt="Carrots" data="14"/>
                        <div class="image-btn">Carrots</div>
                      </div>
                      <div class="per-image-container">
                        <input type="image" src="../foodbin/img/image15.jpg" alt="Celery" data="15"/>
                        <div class="image-btn">Celery</div>
                      </div>
                      <div class="per-image-container">
                        <input type="image" src="../foodbin/img/image16.jpg" alt="Lettuce" data="16"/>
                        <div class="image-btn">Lettuce</div>
                      </div>
                      <div class="per-image-container">
                        <input type="image" src="../foodbin/img/image17.jpg" alt="White potatoes" data="17"/>
                        <div class="image-btn">White Potatoes</div>
                      </div>
                      <div class="per-image-container">
                        <input type="image" src="../foodbin/img/image18.jpg" alt="Spinach" data="18"/>
                        <div class="image-btn">Spinach</div>
                      </div>
                      <div class="per-image-container">
                        <input type="image" src="../foodbin/img/image19.jpg" alt="Kale" data="19"/>
                        <div class="image-btn">Kale</div>
                      </div>
                        <div class="per-image-container">
                          <input type="image" src="../foodbin/img/image20.jpg" alt="White Onions" data="20"/>
                          <div class="image-btn">White Onions</div>
                      </div>
                    </div>
                </div>
            </section>
            <div class="food-line-divider"></div>



            <section class="food-type-section">
                <div class="food-type-heading">Fruits</div>
                <div class="slide-btns-container">
                	<button class="slide-left-btn"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                	<button class="slide-right-btn"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                </div>
                <div class="outer-images-container">
                    <div class="inner-images-container">
                    	<div class="per-image-container">
	                        <input type="image" src="../foodbin/img/image21.jpg" alt="Apple" data="21"/>
	                        <div class="image-btn">Apples</div>
	                    </div>
	                    <div class="per-image-container">
	                        <input type="image" src="../foodbin/img/image22.jpg" alt="Orange" data="22"/>
	                        <div class="image-btn">Oranges</div>
	                    </div>
                        <div class="per-image-container">
	                        <input type="image" src="../foodbin/img/image23.jpg" alt="Bananas" data="23"/>
	                        <div class="image-btn">Bananas</div>
	                    </div>
                        <div class="per-image-container">
	                        <input type="image" src="../foodbin/img/image24.jpg" alt="Pears" data="24"/>
	                        <div class="image-btn">Pears</div>
	                    </div>
                        <div class="per-image-container">
	                        <input type="image" src="../foodbin/img/image25.jpg" alt="Watermelons" data="25"/>
	                        <div class="image-btn">Watermelons</div>
	                    </div>
	                    <div class="per-image-container">
	                        <input type="image" src="../foodbin/img/image26.jpg" alt="Pineapples" data="26"/>
	                        <div class="image-btn">Pineapples</div>
	                    </div>
	                    <div class="per-image-container">
	                        <input type="image" src="../foodbin/img/image27.jpg" alt="Kiwi" data="27"/>
	                        <div class="image-btn">Kiwis</div>
	                    </div>
                        <div class="per-image-container">
	                        <input type="image" src="../foodbin/img/image28.jpg" alt="Tangerines" data="28"/>
	                        <div class="image-btn">Tangerines</div>
	                    </div>
                        <div class="per-image-container">
	                        <input type="image" src="../foodbin/img/image29.jpg" alt="Grapefruits" data="29"/>
	                        <div class="image-btn">Grapefruits</div>
	                    </div>
                        <div class="per-image-container">
	                        <input type="image" src="../foodbin/img/image30.jpg" alt="Mangoes" data="30"/>
	                        <div class="image-btn">Mangoes</div>
	                    </div>
                    </div>
                </div>
            </section>
            <div class="food-line-divider"></div>

            <section class="food-type-section">
                <div class="food-type-heading">Nuts</div>
                <div class="slide-btns-container">
                	<button class="slide-left-btn"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                	<button class="slide-right-btn"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                </div>
                <div class="outer-images-container">
                    <div class="inner-images-container">
                        <div class="per-image-container">
	                        <input type="image" src="../foodbin/img/image31.jpg" alt="Almonds" data="31"/>
	                        <div class="image-btn">Almonds</div>
	                    </div>
	                    <div class="per-image-container">
	                        <input type="image" src="../foodbin/img/image32.jpg" alt="Peanuts" data="32"/>
	                        <div class="image-btn">Peanuts</div>
	                    </div>
                        <div class="per-image-container">
	                        <input type="image" src="../foodbin/img/image33.jpg" alt="Pistachios" data="33"/>
	                        <div class="image-btn">Pistachios</div>
	                    </div>
                        <div class="per-image-container">
	                        <input type="image" src="../foodbin/img/image34.jpg" alt="Walnuts" data="34"/>
	                        <div class="image-btn">Walnuts</div>
	                    </div>
                        <div class="per-image-container">
	                        <input type="image" src="../foodbin/img/image35.jpg" alt="Cashews" data="35"/>
	                        <div class="image-btn">Cashews</div>
	                    </div>
	                    <div class="per-image-container">
	                        <input type="image" src="../foodbin/img/image36.jpg" alt="Macadamias" data="36"/>
	                        <div class="image-btn">Macadamias</div>
	                    </div>
	                    <div class="per-image-container">
	                        <input type="image" src="../foodbin/img/image37.jpg" alt="Hazelnuts" data="37"/>
	                        <div class="image-btn">Hazelnuts</div>
	                    </div>
                        <div class="per-image-container">
	                        <input type="image" src="../foodbin/img/image38.jpg" alt="Pecans" data="38"/>
	                        <div class="image-btn">Pecans</div>
	                    </div>
                        <div class="per-image-container">
	                        <input type="image" src="../foodbin/img/image39.jpg" alt="Pine Nuts" data="39"/>
	                        <div class="image-btn">Pine Nuts</div>
	                    </div>
                        <div class="per-image-container">
	                        <input type="image" src="../foodbin/img/image40.jpg" alt="Chestnuts" data="40"/>
	                        <div class="image-btn">Chestnuts</div>
	                    </div>
                    </div>
                </div>
            </section>
            <div class="food-line-divider"></div>
        </div>

        <div id="contact-container">
          <h2>Get in Touch</h2>
          <form action="includes/contact.php" method="POST">
            <?php
              if(isset($_GET['fullname'])){
                echo "<input type='text' name='fullname' placeholder='Full name' value='" . $_GET['fullname'] . "' maxlength='30' required='required'/>";
              } else {
                echo "<input type='text' name='fullname' placeholder='Full name' maxlength='30' required='required'/>";
              }
            ?>
            <input type="text" name="email" placeholder="Email" maxlength="30"  required="required"/>
            <?php
              if(isset($_GET['subject'])){
                echo "<input type='text' name='subject' placeholder='Subject' maxlength='30' value='" . $_GET['subject'] . "'/>";
              } else {
                echo "<input type='text' name='subject' placeholder='Subject' maxlength='30'/>";
              }
            ?>

            <?php
              if(isset($_SESSION['user_username'])){
                echo "<input type='text' name='username' value='" . $_SESSION['user_username'] . "' id='contact-username'/>";
              }
              if(isset($_GET['message'])){
                echo "<textarea name='message' rows='8' cols='80' placeholder='Message' maxlength='500'>" . $_GET['message'] . "</textarea>";
              } else {
                echo "<textarea name='message' rows='8' cols='8' placeholder='Message' maxlength='500'></textarea>";
              }
            ?>
            <input type="submit" name="submit" value="Submit" id="contact-submit-btn"/>
          </form>
        </div>

        <footer>
          <div id="ca-locations">
            <section id="northern-locations">
              <p>Northern California</p>
              <ul>
                <li><a href="#">Sacramento, CA</a></li>
                <li><a href="#">San Francisco, CA</a></li>
                <li><a href="#">Oakland, CA</a></li>
                <li><a href="#">Fremont, CA</a></li>
                <li><a href="#">Berkeley, CA</a></li>
                <li><a href="#">Stockton, CA</a></li>
                <li><a href="#">San Jose, CA</a></li>
              </ul>
            </section>
            <section id="southern-locations">
              <p>Sourthern California</p>
              <ul>
                <li><a href="#">Los Angeles, CA</a></li>
                <li><a href="#">San Diego, CA</a></li>
                <li><a href="#">Santa Barbara, CA</a></li>
                <li><a href="#">Riverside, CA</a></li>
                <li><a href="#">Long Beach, CA</a></li>
                <li><a href="#">Anaheim, CA</a></li>
                <li><a href="#">Irvine, CA</a></li>
              </ul>
            </section>
          </div>
        </footer>

     </div>
      <!-- End of Container -->


    <!-- Start of Cart Modal -->
    <div id="cart-modal-window">
      <div id="cart-close-container">
        <span class="modal-close-btn"></span>
      </div>
    	<div id="cart-modal-container">
    		<div id="cart-modal-content">
          <?php
            include_once "includes/dbh-inc.php";
            if(isset($_SESSION['user_id'])){
              $id = $_SESSION['user_id'];
            }

            if(isset($_SESSION['edit-in-progress']) && isset($_SESSION['same-order-in-progress'])){
              if($_SESSION['edit-in-progress'] == "yes"){
                $editVal = $_SESSION['edit-in-progress'];
                $editData = array();
                $sql = "SELECT * FROM edit_orders WHERE user_id=$id;";
                $result = mysqli_query($conn, $sql);
                $resultRowNum = mysqli_num_rows($result);
                if($resultRowNum > 0){
                  while($row = mysqli_fetch_assoc($result)){
                    $editData[] = $row;
                  }
                  $itemIdsString = $editData[0]['food_ids'];
                  $itemArr = explode(" ", $itemIdsString);
                  array_pop($itemArr);
                  $itemArrLength = count($itemArr);
                  echo "
                  <h3 id='cart-modal-heading' verse='edit'>Shopping Cart</h3>
                  <div class='line-divider'></div>";
                  $itemNamesStr = $editData[0]['item_names'];
                  $itemNamesArr = explode(" ", $itemNamesStr);
                  array_pop($itemNamesArr);
                  # - loop through the item $itemIdsString
                  for($x1 = 0; $x1 < $itemArrLength; $x1++){
                    echo "
                      <div class='cart-row'>
                        <div class='left-cart-col'>
                          <h6 class='left-col-heading'>" . $itemNamesArr[$x1] . "</h6>
                          <div class='col-image-container'>
                            <input type='image' src='../foodbin/img/image" . $itemArr[$x1] . ".jpg' data='" . $itemArr[$x1] . "' class='cart-image' alt='" . $itemNamesArr[$x1] . "' />
                          </div>
                        </div>
                        <div class='right-cart-col'>
                          <h6 class='right-col-heading'>Details</h6>
                          <ul class='details-list'>";
                          $specStr = $editData[0]['item_' . $itemArr[$x1] . '_specs'];
                          $specsArr = explode(" | ", $specStr);
                          $specsArrLength = count($specsArr);
                          for($x2 = 0; $x2 < $specsArrLength; $x2++){
                            echo "<li>" . $specsArr[$x2] . "</li>";
                          }
                       echo "
                         </ul>
                         <div class='item-btns-container'>
                            <button class='make-changes-btn' for='item-" . $itemArr[$x1] . "-window'>Make Changes</button>
                            <button class='remove-item-btn'>Remove Item</button>
                         </div>
                        </div>
                      </div>
                      <div class='line-divider'></div>
                    ";
                  }
                  # - end of loop through item ids and their specs
                  echo "</div>"; # - this is cart content closing tag
                  echo "
                    <div id='hidden-form'>
                      <form action='includes/orderfood.php' id='form-inner' method='POST'>";
                        echo '
                        <input type="text" name="store_name" value="' . $editData[0]["store_name"] . '"/>
                        <input type="text" name="store_address" value="' . $editData[0]["store_address"] . '"/>
                        <input type="text" name="store_city" value="' . $editData[0]["store_city"] . '"/>
                        <input type="text" name="delivery_time" value="' . $editData[0]["delivery_time"] . '"/>
                        ';
                        for($x3 = 0; $x3 < $itemArrLength; $x3++){
                          echo "<input type='text' name='item_" . $itemArr[$x3] . "_specs' value='" . $editData[0]['item_' . $itemArr[$x3] . '_specs'] . "' data='" . $itemArr[$x3] . "' class='item-spec-inputs'/>";
                        }
                        echo
                        "<input type='submit' name='submit' value='Submit' id='hidden-submit'/>
                      </form>
                    </div>
                  ";

                  echo "
                    <div id='modal-footer'>
                      <div id='location-and-time-container' style='display: grid'>
                        <div id='cart-location'>" . $editData[0]['store_city'] . "</div>
                        <div id='cart-store-name'>" . $editData[0]['store_name'] . "</div>
                        <div id='cart-store-address'>" . $editData[0]['store_address'] . "</div>
                        <div id='cart-delivery-time'>" . $editData[0]['delivery_time'] . "</div>
                      </div>
                      <button id='place-order-btn' style='display: block'>Place Order</button>
                    </div>
                  ";
                } # - end of if resultRow > 0
                 echo "</div>"; # - this is cart content closing tag
               } else if ($_SESSION['same-order-in-progress'] == "yes"){
                 $orderRequested = $_SESSION['order-requested-again'];
                 $prevData = array();
                 $sqlR = "SELECT * FROM previous_orders WHERE user_id=$id AND order_id=$orderRequested;";
                 $result = mysqli_query($conn, $sqlR);
                 $resultRows = mysqli_num_rows($result);
                 if($resultRows > 0){
                   while($row = mysqli_fetch_assoc($result)){
                     $prevData[] = $row;
                   }
                   $itemIdsString = $prevData[0]['food_ids'];
                   $itemArr = explode(" ", $itemIdsString);
                   array_pop($itemArr);
                   $itemArrLength = count($itemArr);
                   echo "
                   <h3 id='cart-modal-heading' verse='order-again'>Shopping Cart</h3>
                   <div class='line-divider'></div>";
                   $itemNamesStr = $prevData[0]['item_names'];
                   $itemNamesArr = explode(" ", $itemNamesStr);
                   array_pop($itemNamesArr);
                   # - loop through the food ids and their item specs
                   for($x1 = 0; $x1 < $itemArrLength; $x1++){
                     echo "
                       <div class='cart-row'>
                         <div class='left-cart-col'>
                           <h6 class='left-col-heading'>" . $itemNamesArr[$x1] . "</h6>
                           <div class='col-image-container'>
                             <input type='image' src='../foodbin/img/image" . $itemArr[$x1] . ".jpg' data='" . $itemArr[$x1] . "' class='cart-image' alt='" . $itemNamesArr[$x1] . "' />
                           </div>
                         </div>
                         <div class='right-cart-col'>
                           <h6 class='right-col-heading'>Details</h6>
                           <ul class='details-list'>";
                           $specStr = $prevData[0]['item_' . $itemArr[$x1] . '_specs'];
                           $specsArr = explode(" | ", $specStr);
                           $specsArrLength = count($specsArr);
                           for($x2 = 0; $x2 < $specsArrLength; $x2++){
                             echo "<li>" . $specsArr[$x2] . "</li>";
                           }
                        echo "
                          </ul>
                          <div class='item-btns-container'>
                             <button class='make-changes-btn' for='item-" . $itemArr[$x1] . "-window'>Make Changes</button>
                             <button class='remove-item-btn'>Remove Item</button>
                          </div>
                         </div>
                       </div>
                       <div class='line-divider'></div>
                     ";
                   }
                   # - end of looping through the food ids and their specs
                   echo "</div>"; # - this is cart content closing tag
                   echo "
                     <div id='hidden-form'>
                       <form action='includes/orderfood.php' id='form-inner' method='POST'>";
                         echo '
                         <input type="text" name="store_name" value="' . $prevData[0]["store_name"] . '"/>
                         <input type="text" name="store_address" value="' . $prevData[0]["store_address"] . '"/>
                         <input type="text" name="store_city" value="' . $prevData[0]["store_city"] . '"/>
                         <input type="text" name="delivery_time" value="' . $prevData[0]['delivery_time'] . '"/>
                         ';
                         for($x3 = 0; $x3 < $itemArrLength; $x3++){
                           echo "<input type='text' name='item_" . $itemArr[$x3] . "_specs' value='" . $prevData[0]['item_' . $itemArr[$x3] . '_specs'] . "' data='" . $itemArr[$x3] . "' class='item-spec-inputs'/>";
                         }
                         echo
                         "<input type='submit' name='submit' value='Submit' id='hidden-submit'/>
                       </form>
                     </div>
                   ";

                   echo "
                     <div id='modal-footer'>
                       <div id='location-and-time-container' style='display: grid'>
                         <div id='cart-location'>" . $prevData[0]['store_city'] . "</div>
                         <div id='cart-store-name'>" . $prevData[0]['store_name'] . "</div>
                         <div id='cart-store-address'>" . $prevData[0]['store_address'] . "</div>
                         <div id='cart-delivery-time'>" . $prevData[0]['delivery_time'] . "</div>
                       </div>
                       <button id='place-order-btn' style='display: block'>Place Order</button>
                     </div>
                   ";
                 }
               } else {
                 echo "
                   <h3 id='cart-modal-heading' verse='3'>Shopping Cart</h3>
                   <div class='line-divider'></div>
                   <div id='no-groceries-added'>No groceries have been added yet</div>
                 ";
                 echo "</div>"; # - this is cart content closing tag

                 echo "
                   <div id='hidden-form'>
                     <form action='includes/orderfood.php' id='form-inner' method='POST'>
                       <input type='submit' name='submit' value='Submit' id='hidden-submit'/>
                     </form>
                   </div>
                 ";

                 echo "
                   <div id='modal-footer'>
                     <div id='location-and-time-container'>
                       <div id='cart-location'></div>
                       <div id='cart-store-name'></div>
                       <div id='cart-store-address'></div>
                       <div id='cart-delivery-time'></div>
                     </div>
                     <button id='place-order-btn'>Place Order</button>
                   </div>
                 ";
               }
            } else {
              echo "
                <h3 id='cart-modal-heading' verse='3'>Shopping Cart</h3>
                <div class='line-divider'></div>
                <div id='no-groceries-added'>No groceries have been added yet</div>
              ";
              echo "</div>"; # - this is cart content closing tag

              echo "
                <div id='hidden-form'>
                  <form action='includes/orderfood.php' id='form-inner' method='POST'>
                    <input type='submit' name='submit' value='Submit' id='hidden-submit'/>
                  </form>
                </div>
              ";

              echo "
                <div id='modal-footer'>
                  <div id='location-and-time-container'>
                    <div id='cart-location'></div>
                    <div id='cart-store-name'></div>
                    <div id='cart-store-address'></div>
                    <div id='cart-delivery-time'></div>
                  </div>
                  <button id='place-order-btn'>Place Order</button>
                </div>
              ";
            }
          ?>
    	</div>
    </div>
    <!-- End of Cart Modal -->

    <!-- Start of Food item Modal  -->
    <div class="modal-window">
      <div class="modal-inner-container">
        <div class="modal-inner-content">
          <div class="row">
            <h6 class="modal-inner-image-heading"></h6>
            <input type="image" class="modal-image">
            <div id="properties-priority-row">
              <div class="properties-container">
            		<h6 class="modal-select-heading">Properties</h6>
                <form action="" id="selector-form">
              		<select name="weight" class="weight-selector" class="product-options-selector">
              			<option>Weight</option>
              			<option value="1 lb">1 lb</option>
              			<option value="2 lb">2 lb</option>
              			<option value="3 lb">3 lb</option>
              			<option value="4 lb">4 lb</option>
              			<option value="5 lb">5 lb</option>
                    <option value="Any">Any</option>
              		</select>
              		<select name="cost" class="cost-selector" class="product-options-selector">
              			<option>Cost</option>
              			<option value="less-than-1$">&lt; 1$</option>
              			<option value="less-than-2$">&lt; 2$</option>
              			<option value="less-than-3$">&lt; 3$</option>
              			<option value="less-than-4$">&lt; 4$</option>
              			<option value="less-than-5$">&lt; 5$</option>
                    <option value="Any">Any</option>
              		</select>
              		<select name="specialty" class="specialty-selector" class="product-options-selector">
              			<option>Specialty</option>
              			<option value="Organic">Organic</option>
              			<option value="Natural">Natural</option>
              			<option value="Packaged">Packaged</option>
              			<option value="Any">Any</option>
              		</select>
              		<select name="quality" class="quality-selector" class="product-options-selector">
              			<option>Quality</option>
              			<option value="Ripe">Ripe</option>
              			<option value="Unripe">Unripe</option>
                    <option value="Any">Any</option>
              		</select>
                </form>
            	</div>

              <div class="priority-container">
                <h6 class="modal-select-heading">Priority</h6>
                <form action="" id="priority-num-form">
                  <select name="weight-priority" class="weight-priority priority-value">
                    <option value="one" selected="selected">One (high)</option>
                    <option value="two">Two</option>
                    <option value="three">Three</option>
                    <option value="four">Four (low)</option>
                  </select>
                  <select name="cost-priority" class="cost-priority priority-value">
                    <option value="one">One (high)</option>
                    <option value="two" selected="selected">Two</option>
                    <option value="three">Three</option>
                    <option value="four">Four (low)</option>
                  </select>
                  <select name="specialty-priority" class="specialty-priority priority-value">
                    <option value="one">One (high)</option>
                    <option value="two">Two</option>
                    <option value="three" selected="selected">Three</option>
                    <option value="four">Four (low)</option>
                  </select>
                  <select name="quality-priority" class="quality-priority priority-value">
                    <option value="one">One (high)</option>
                    <option value="two">Two</option>
                    <option value="three">Three</option>
                    <option value="four" selected="selected">Four (low)</option>
                  </select>
                </form>
              </div>
              <p id="same-priority-error">*Priority values cannot be the same</p>
            </div>
          </div>
        </div>
        <div class="modal-inner-footer">
          <button class="add-to-cart-btn" id="add-twix-btn">Add to Cart</button>
        </div>
      </div>
    </div>
    <!-- End of Food item Modal  -->

    <?php
      if(isset($_SESSION['address'])){
        $storeAddress = $_SESSION['address'];
        echo "
          <div id='store-modal-window' style='display: block'>
            <div class='close-btn-container' style='display: block'>
              <div class='modal-close-btn'></div>
            </div>
            <div id='store-modal-container'>";
            $sql = "SELECT * FROM current_orders WHERE store_address='$storeAddress';";
            $currData = array();
            $result = mysqli_query($conn, $sql);
            $resultRows = mysqli_num_rows($result);
            if($resultRows > 0){
              while($row = mysqli_fetch_assoc($result)){
                $currData[] = $row;
              }
              $currDataLength = count($currData);
              echo "
                <div class='orders-modal-header'>
                  <h2 style='text-align:center'>Current Orders</h2>
                  <div class='store-address-container'>
                    <div class='orders-store-name' style='text-align:center'>
                      " . $currData[0]['store_name'] . "
                    </div>
                    <div class='orders-store-address' style='text-align:center'>
                      " . $currData[0]['store_address'] . "
                    </div>
                  </div>
                </div>
              ";
              for($a = 0; $a < $currDataLength; $a++){
                $userIdNum = $currData[$a]['user_id'];
                $usrData = array();
                $sqlUsr = "SELECT * FROM users WHERE id=$userIdNum;";
                $resultUsr = mysqli_query($conn, $sqlUsr);
                $resultRowUsr = mysqli_num_rows($resultUsr);
                if($resultRowUsr > 0){
                  while($rowUsr = mysqli_fetch_assoc($resultUsr)){
                    $usrData[] = $rowUsr;
                  }
                  $userFirstName = $usrData[0]['user_first'];
                  $userLastName = $usrData[0]['user_last'];
                  $lastInitial = strtoupper($userLastName[0] . ".");
                }
                echo "
                  <div class='orders-accordion'>
                    <div class='users-name' style='text-align:center'>
                      " . $userFirstName . ' ' . $lastInitial . "
                    </div>
                    <div style='text-align:center'><i class='fa fa-angle-down' style='font-size:36px'></i></div>
                    <div class='num-of-items' style='text-align:center'>";
                    //echo $currData[0]['food_ids'];
                $foodIdsStr = $currData[$a]['food_ids'];
                $foodIdsArr = explode(" ", $foodIdsStr);
                array_pop($foodIdsArr);
                $foodIdsArrLength = count($foodIdsArr);
                echo $foodIdsArrLength . " items";

                # - item names
                $itemNamesStr = $currData[$a]['item_names'];
                $itemNamesArr = explode(" ", $itemNamesStr);
                array_pop($itemNamesArr);
                $itemNamesArrLength = count($itemNamesArr);
                # - end of item names
                echo "
                    </div>
                  </div>
                  <div class='accordion-inner'>
                    ";
                    for($b = 0; $b < $itemNamesArrLength; $b++){
                      echo "
                        <div class='store-order-row'>
                          <div class='store-order-left'>
                            <div class='store-item-name'>" . $itemNamesArr[$b] . "</div>
                            <input type='image' src='../foodbin/img/image" . $foodIdsArr[$b] . ".jpg' class='store-modal-img'/>
                          </div>
                          <div class='store-order-right'>
                            <div class='item-details-heading'>Details</div>";
                            echo "<ul>";
                            for($c = 0; $c < 4; $c++){
                              $itemSpecsStr = $currData[$a]['item_' . $foodIdsArr[$b] . '_specs'];
                              $itemSpecsArr = explode(" | ", $itemSpecsStr);
                              echo "<li>" . $itemSpecsArr[$c] . "</li>";
                            }
                            echo "</ul>";
                      echo "
                          </div>
                        </div>
                        <div class='line-divider'></div>
                      ";
                    }
                echo "
                  <div class='orders-deliver-container'>
                    <button class='deliver-order-btn'>Deliver</button>
                  </div>
                  </div>
                ";
              }
            } else {
              echo "
                <h2 style='text-align: center'>No orders</h2>
              ";
            }
        echo "
            </div>
            <form action='includes/unsetAddress.php' method='POST' id='unset-address-form'>
              <input type='submit' name='submit' id='unset-address-btn'/>
            </form>
          </div>
        ";
      } else {
        echo "
          <div id='store-modal-window'>
            <div class='close-btn-container'>
              <div class='modal-close-btn'></div>
            </div>
            <div id='store-modal-container'>
            </div>
          </div>
        ";
      }
    ?>
	<!-- Close container and columns are added to food modals when user clicks on food item -->

	<div class="close-btn-container">
		<span class="modal-close-btn"></span>
	</div>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="foodbin.js"></script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDrQVQzF7VuwHhRVfm7OykRl2puiMMGjEI&callback=initializeMap"></script>
</body>
</html>
