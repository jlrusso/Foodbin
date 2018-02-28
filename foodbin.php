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
                      if (isset($_SESSION['user_id'])){
                        echo "<span id='logged-in' class='yes'></span>";
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
                        echo "<span id='logged-in' class='no'></span>";
                        echo '<li id="login-btn"><a href="login.php">Login</a></li>
                              <li id="signup-btn"><a href="signup.php">Sign Up</a></li>';
                      }
                    ?>
                    <li><a href="#" id="cart-container"><i class="fa fa-shopping-cart" id="shopping-cart" aria-hidden="true"></i><span id="cart-badge"></span></a></li>
                </ul>
            </div>
        </nav>

        <div id="banner-area">
        	<div id="banner-overlay"></div>
            <div id="banner-inner">
                <p id="banner-heading">Groceries just clicks away.</p>
                <p>No need to drive, wait in a long line, or hope that your items are available</p>
                <button type="button" class="banner-btn" id="request-btn">Place an Order</button>
                <button type="button" class="banner-btn" id="deliver-btn">Make a Delivery</button>
            </div>
        </div>

        <div id="how-it-works-area">
          <div class="hiw-row">
            <div class="hiw-row-inner">
              <input type="image" src="../img/map.jpeg" alt="Maps"/>
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
              <input type="image" src="../img/grocery-aisle.jpg" alt="Grocery Aisle"/>
            </div>
          </div>
          <div class="hiw-row">
            <div class="hiw-row-inner">
              <input type="image" src="../img/shoppinglist.jpg" alt="Shopping List"/>
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
        		<form action="">
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
                    <option value="5000-Trader-Joes">Trader Joe's (5000 Folsom Blvd)</option>
                    <option value="5810-Corti-Brothers">Corti Brothers (5810 Folsom Blvd)</option>
                    <option value="3547-Food-Source">Food Source (3547 Bradshaw Rd)</option>
                    <option value="2900-Taylors-Market">Taylor's Market (2900 Freeport Blvd)</option>
                    <option value="4990-Otos-Market">Oto's Market (4990 Freeport Blvd)</option>
                    <option value="7205-Smart-Final">Smart &amp; Final Extra (7205 Freeport Blvd)</option>
                    <option value="1040-Nugget-Markets">Nugget Market's (1040 Florin Rd)</option>
                    <option value="5021-Foodsco">Foodsco (5021 Fruitridge Rd)</option>
                  </select>

                  <select name="san-franciso-store-list" id="san-francisco-store-list" class="store-list">
                    <option style="font-weight: bold" value="Stores Heading">Choose a store:</option>
                    <option value="15-Safeway">Safeway (15 Marina Blvd)</option>
                    <option value="350-Safeway">Safeway (350 Bay St)</option>
                    <option value="145-Safeway">Safeway (145 Jackson St)</option>
                    <option value="759-Ming-Lee-Trading">Ming Lee Trading (759 Jackson St)</option>
                    <option value="1095-Trader-Joes">Trader Joe's (1095 Hyde St)</option>
                    <option value="1335-Safeway">Safeway (1335 Webster St)</option>
                    <option value="1355-The-Market">The Market (1355 Market St)</option>
                    <option value="985-Market-Mayflower-Deli">Market Mayflower &amp; Deli (985 Bush St)</option>
                    <option value="298-Safeway">Safeway (298 King St)</option>
                    <option value="308-Falletti-Foods">Falletti Foods (308 Broderick St)</option>
                  </select>

                  <select name="oakland-store-list" id="oakland-store-list" class="store-list">
                    <option style="font-weight: bold" value="Stores Heading">Choose a store:</option>
                    <option value="5727-Trader-Joes">Trader Joe's (5727 College Ave)</option>
                    <option value="5885-Village-Market">Village Market (5885 Broadway Terrace)</option>
                    <option value="5100-Safeway">Safeway (5100 Broadway)</option>
                    <option value="4038-Piedmont-Grocery-Co">Piedmont Grocery Co (4038 Piedmont Ave)</option>
                    <option value="2096-Safeway">Safeway (2096 Mountain Blvd)</option>
                    <option value="3747-Safeway">Safeway (3747 Grand Ave)</option>
                    <option value="3250-Trader-Joes">Trader Joe's (3250 Lakeshore Ave)</option>
                    <option value="1440-Rockys-Market">Rocky's Market (1440 Leimert Blvd)</option>
                    <option value="1431-Natures-Best-Foods">Nature's Best Foods (1431 Jackson St)</option>
                    <option value="3426-Farmer-Joes-Marketplace">Farmer Joe's Marketplace (3426 Fruitvale Ave)</option>
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
                    <option value="3111-Whole-Food's-Market">Whole Food's Market (3111 Mowry Ave)</option>
                    <option value="39200-Raley's">Raley's (39200 Paseo Padre Pkwy)</option>
                    <option value="3171-Smart-Final">Smart &amp; Final Extra (3171 Walnut Ave)</option>
                    <option value="3890-Indian-Market">Indian Market (3890 Walnut Ave)</option>
                    <option value="39100-Safeway">Safeway (39100 Argonaut Way)</option>
                    <option value="39324-Trader Joe's">Trader Joe's (39324 Argonaut Way)</option>
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
                    <option value="1885-Trader-Joe's">Trader Joe's (1885 University Ave)</option>
                    <option value="2082-Mi-Tierra-Foods">Mi Tierra Foods (2082 San Pablo Ave)</option>
                    <option value="2440-Alex-Market">Alex Market (2440 Sacramento St)</option>
                    <option value="2441-Shattuck-Market">Shattuck Market (2441 Shattuck Ave)</option>
                    <option value="901-Franklin-Bros-Market">Franklin Bros. Market (901 Bancroft Way)</option>
                    <option value="3000-Whole-Foods-Market">Whole Foods Market (3000 Telegraph Ave)</option>
                  </select>

                  <select name="stockton-store-list" id="stockton-store-list" class="store-list">
                    <option style="font-weight: bold" value="Stores Heading">Choose a store:</option>
                    <option value="4255-Raley's">Raley's (4255 E Morada Ln)</option>
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
                    <option value="635-Trader-Joe's">Trader Joe's (635 Coleman Ave)</option>
                    <option value="420-Dai-Thanh-Supermarket">Dai Thanh Supermarket (420 S 2nd St)</option>
                    <option value="1300-Safeway">Safeway (1300 W San Carlos St)</option>
                    <option value="1003-Arteaga's">Arteaga's (1003 Lincoln Ave)</option>
                    <option value="777-Whole-Foods-Market">Whole Foods Market (777 The Alameda)</option>
                    <option value="245-Santo-Market-Inc">Santo Market Inc (245 E Taylor St)</option>
                    <option value="2300-Grocery-Outlet-Bargain-Market">Grocery Outlet Bargain Market (2300 Monterey Rd)</option>
                    <option value="1530-Safeway">Safeway (1530 Hamilton Ave)</option>
                    <option value="675-Mitsuwa-Marketplace">Mitsuwa Marketplace (675 Saratoga Ave)</option>
                  </select>

                  <select name="los-angeles-store-list" id="los-angeles-store-list" class="store-list">
                    <option style="font-weight: bold" value="Stores Heading">Choose a store:</option>
                    <option value="11737-Whole-Foods-Market">Whole Foods Market (11737 San Vicente Blvd)</option>
                    <option value="10250-Gelson's-Market">Gelson's Market (10250 California State Route 2)</option>
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
                    <option value="3303-Gelsons-Market">Gelson's Market (3303 State St)</option>
                    <option value="2840-Grocery-Outlet-Bargain-Market">Grocery Outlet Bargain Market (2840 De La Vina St)</option>
                    <option value="1501-Foodland-Market">Foodland Market (1501 San Andres St)</option>
                    <option value="100-Ralphs">Ralphs (100 W Carrillo St)</option>
                    <option value="324-Santa-Cruz-Market">Santa Cruz Market (324 W Montecito St)</option>
                    <option value="217-Smart-Final">Smart &amp; Final (217 E Gutierrez St)</option>
                    <option value="2010-Vons">Vons (2010 Cliff Dr)</option>
                    <option value="435-Brownies-Market">Brownie's Market (435 De La Vina St)</option>
                  </select>

                  <select name="riverside-store-list" id="riverside-store-list" class="store-list">
                    <option style="font-weight: bold" value="Stores Heading">Choose a store:</option>
                    <option value="4050-Maxi-Foods-Market">Maxi Foods Market (4050 University Ave)</option>
                    <option value="191-Goodwins">Goodwin's Organic Foods and Drinks (191 W Big Springs Rd)</option>
                    <option value="3310-Smart-Final">Smart &amp; Final (3310 Vine St)</option>
                    <option value="6155-Ralphs">Ralphs (6155 Magnolia Ave)</option>
                    <option value="5225-Ralphs">Ralphs (5225 Canyon Crest Dr)</option>
                    <option value="3520-Vons">Vons (3520 Riverside Plaza Dr)</option>
                    <option value="5202-Smart-Final-Extra">Smart &amp; Final Extra (5202 Arlington Ave)</option>
                    <option value="6225-Trader-Joes">Trader Joe's (6225 Riverside Ave)</option>
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
                    <option value="2222-Trader-Joes">Trader Joe's (2222 N Bellflower Blvd)</option>
                    <option value="1930-Ralphs">Ralphs (1930 N Lakewood Blvd)</option>
                    <option value="2930-Ralphs">Ralphs (2930 E 4th St)</option>
                    <option value="600-Vons">Vons (600 E Broadway)</option>
                    <option value="346-Ma-N-Pa-Grocery">Ma N' Pa Grocery (346 Roycroft Ave)</option>
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
                    <option value="5521-Gelson's-Market">Gelson's Market (5521 Alton Pkwy)</option>
                    <option value="7020-Village-Market">Village Market (7020 Scholarship)</option>
                    <option value="6300-Ralphs">Ralphs (6300 Irvine Blvd)</option>
                    <option value="14120-Super-Irvine">Super Irvine (14120 Culver Dr)</option>
                    <option value="14417-Smart-Final-Extra">Smart &amp; Final Extra (14417 Culver Dr)</option>
                    <option value="14400-Ralphs">Ralphs (14400 Culver Dr)</option>
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
                          <input type="image" src="../img/twix.jpg" alt="Twix" data="1"/>
                          <div class="image-btn">Twix</div>
                      </div>
                      <div class="per-image-container">
                        <input type="image" src="../img/marsbar.jpg" alt="Marsbar" data="2"/>
                        <div class="image-btn">Marsbar</div>
                      </div>
                      <div class="per-image-container">
                        <input type="image" src="../img/gummybears.jpg" alt="Gummybears" data="3"/>
                        <div class="image-btn">Gummybears</div>
                      </div>
                      <div class="per-image-container">
                        <input type="image" src="../img/jellybeans.jpg" alt="Jellybeans" data="4"/>
                        <div class="image-btn">Jellybeans</div>
                      </div>
                      <div class="per-image-container">
                        <input type="image" src="../img/mandms.jpg" alt="M&M's" data="5"/>
                        <div class="image-btn">M&amp;M's</div>
                      </div>
                      <div class="per-image-container">
                        <input type="image" src="../img/skittles.jpg" alt="Skittles" data="6"/>
                        <div class="image-btn">Skittles</div>
                      </div>
                      <div class="per-image-container">
                        <input type="image" src="../img/hersheys.png" alt="Hersheys" data="7"/>
                        <div class="image-btn">Hersheys</div>
                      </div>
                      <div class="per-image-container">
                        <input type="image" src="../img/snickers.jpg" alt="Snickers" data="8"/>
                        <div class="image-btn">Snickers</div>
                      </div>
                      <div class="per-image-container">
                        <input type="image" src="../img/sourpatch.jpg" alt="Sourpatch" data="9"/>
                        <div class="image-btn">Sourpatch</div>
                      </div>
                      <div class="per-image-container">
                        <input type="image" src="../img/candycorn.jpg" alt="Candycorn" data="10"/>
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
                        <input type="image" src="../img/broccoli.jpeg" alt="Broccoli" data="11"/>
                        <div class="image-btn">Broccoli</div>
                      </div>
                      <div class="per-image-container">
                        <input type="image" src="../img/squash.jpeg" alt="Squash" data="12"/>
                        <div class="image-btn">Squash</div>
                      </div>
                      <div class="per-image-container">
                        <input type="image" src="../img/cauliflower.jpeg" alt="Cauliflower" data="13"/>
                        <div class="image-btn">Cauliflower</div>
                      </div>
                      <div class="per-image-container">
                        <input type="image" src="../img/carrots.jpeg" alt="Carrots" data="14"/>
                        <div class="image-btn">Carrots</div>
                      </div>
                      <div class="per-image-container">
                        <input type="image" src="../img/celery.jpg" alt="Celery" data="15"/>
                        <div class="image-btn">Celery</div>
                      </div>
                      <div class="per-image-container">
                        <input type="image" src="../img/lettuce.jpg" alt="Lettuce" data="16"/>
                        <div class="image-btn">Lettuce</div>
                      </div>
                      <div class="per-image-container">
                        <input type="image" src="../img/potatoes.jpeg" alt="White potatoes" data="17"/>
                        <div class="image-btn">White Potatoes</div>
                      </div>
                      <div class="per-image-container">
                        <input type="image" src="../img/spinach.jpg" alt="Spinach" data="18"/>
                        <div class="image-btn">Spinach</div>
                      </div>
                      <div class="per-image-container">
                        <input type="image" src="../img/kale.jpeg" alt="Kale" data="19"/>
                        <div class="image-btn">Kale</div>
                      </div>
                        <div class="per-image-container">
                          <input type="image" src="../img/whiteonions.jpg" alt="White Onions" data="20"/>
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
	                        <input type="image" src="../img/apples.jpeg" alt="Apple" data="21"/>
	                        <div class="image-btn">Apples</div>
	                    </div>
	                    <div class="per-image-container">
	                        <input type="image" src="../img/orange.jpeg" alt="Orange" data="22"/>
	                        <div class="image-btn">Oranges</div>
	                    </div>
                        <div class="per-image-container">
	                        <input type="image" src="../img/bananas.jpeg" alt="Bananas" data="23"/>
	                        <div class="image-btn">Bananas</div>
	                    </div>
                        <div class="per-image-container">
	                        <input type="image" src="../img/pears.jpeg" alt="Pears" data="24"/>
	                        <div class="image-btn">Pears</div>
	                    </div>
                        <div class="per-image-container">
	                        <input type="image" src="../img/watermelons.jpeg" alt="Watermelons" data="25"/>
	                        <div class="image-btn">Watermelons</div>
	                    </div>
	                    <div class="per-image-container">
	                        <input type="image" src="../img/pineapples.jpg" alt="Pineapples" data="26"/>
	                        <div class="image-btn">Pineapples</div>
	                    </div>
	                    <div class="per-image-container">
	                        <input type="image" src="../img/kiwi.png" alt="Kiwi" data="27"/>
	                        <div class="image-btn">Kiwis</div>
	                    </div>
                        <div class="per-image-container">
	                        <input type="image" src="../img/tangerines.jpg" alt="Tangerines" data="28"/>
	                        <div class="image-btn">Tangerines</div>
	                    </div>
                        <div class="per-image-container">
	                        <input type="image" src="../img/grapefruits.jpg" alt="Grapefruits" data="29"/>
	                        <div class="image-btn">Grapefruits</div>
	                    </div>
                        <div class="per-image-container">
	                        <input type="image" src="../img/mangoes.jpg" alt="Mangoes" data="30"/>
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
	                        <input type="image" src="../img/almonds.jpg" alt="Almonds" data="31"/>
	                        <div class="image-btn">Almonds</div>
	                    </div>
	                    <div class="per-image-container">
	                        <input type="image" src="../img/peanuts.jpg" alt="Peanuts" data="32"/>
	                        <div class="image-btn">Peanuts</div>
	                    </div>
                        <div class="per-image-container">
	                        <input type="image" src="../img/pistachios.jpeg" alt="Pistachios" data="33"/>
	                        <div class="image-btn">Pistachios</div>
	                    </div>
                        <div class="per-image-container">
	                        <input type="image" src="../img/walnuts.jpg" alt="Walnuts" data="34"/>
	                        <div class="image-btn">Walnuts</div>
	                    </div>
                        <div class="per-image-container">
	                        <input type="image" src="../img/cashews.jpg" alt="Cashews" data="35"/>
	                        <div class="image-btn">Cashews</div>
	                    </div>
	                    <div class="per-image-container">
	                        <input type="image" src="../img/macadamias.jpg" alt="Macadamias" data="36"/>
	                        <div class="image-btn">Macadamias</div>
	                    </div>
	                    <div class="per-image-container">
	                        <input type="image" src="../img/hazelnuts.jpg" alt="Hazelnuts" data="37"/>
	                        <div class="image-btn">Hazelnuts</div>
	                    </div>
                        <div class="per-image-container">
	                        <input type="image" src="../img/pecans.jpg" alt="Pecans" data="38"/>
	                        <div class="image-btn">Pecans</div>
	                    </div>
                        <div class="per-image-container">
	                        <input type="image" src="../img/pinenuts.jpg" alt="Pine Nuts" data="39"/>
	                        <div class="image-btn">Pine Nuts</div>
	                    </div>
                        <div class="per-image-container">
	                        <input type="image" src="../img/chestnuts.jpg" alt="Chestnuts" data="40"/>
	                        <div class="image-btn">Chestnuts</div>
	                    </div>
                    </div>
                </div>
            </section>
            <div class="food-line-divider"></div>


        </div>

        <div id="testimonial-area">
        	<div class="testimonial-row">
	        	<div class="testimonial-column">
	        		<div class="testimonial-heading">
	        			<div class="testimonial-image-container">
	        				<img src="../img/guy-pic.jpeg" alt="Guy User Pic">
	        			</div>
	        			<div class="testimonial-author">
	        				Trevor J.
	        			</div>
	        		</div>
	        		<div class="testimonial-content">
	        			<p><span class="quotes">"</span> With four kids and a super busy schedule, im glad getting groceries is just a click away. <span class="quotes">"</span></p>
	        		</div>
	        	</div>
	        	<div class="testimonial-column">
	        		<div class="testimonial-heading">
	        			<div class="testimonial-image-container">
	        				<img src="../img/girl-pic.jpeg" alt="Girl User Pic">
	        			</div>
	        			<div class="testimonial-author">
	        				Maria T.
	        			</div>
	        		</div>
	        		<div class="testimonial-content">
	        			<p><span class="quotes">"</span> With four kids and a super busy schedule, im glad getting groceries is just a click away. <span class="quotes">"</span></p>
	        		</div>
	        	</div>
	        </div>
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
    			<h3 id="cart-modal-heading">Shopping Cart</h3>
          <div class="line-divider"></div>
          <p id="no-groceries-added">No groceries have been added to your cart yet</p>
    		</div>
        <div id="hidden-form">
          <form action="includes/orderfood.php" id="form-inner" method="POST">
            <input type="submit" name="submit" value="Submit" id="hidden-submit"/>
          </form>
        </div>
        <div id="modal-footer">
          <div id="location-and-store-container">
            <div id="cart-location"></div>
            <div id="cart-store-name"></div>
            <div id="cart-store-address"></div>
          </div>
          <button id="place-order-btn">Place Order</button>
        </div>
    	</div>
    </div>
    <!-- End of Cart Modal -->


    <!-- Candy Food Section -->
    <div class="modal-window" id="twix-window">
      <div class="modal-inner-container">
        <div class="modal-inner-content">
          <div class="row">
            <div class="col-4">
              <h3 class="modal-inner-image-heading">Twix</h3>
              <input type="image" src="../img/twix.jpg" alt="Twix" class="modal-image" data="1"/>
            </div>
          </div>
        </div>
        <div class="modal-inner-footer">
          <button class="add-to-cart-btn" id="add-twix-btn">Add to Cart</button>
        </div>
      </div>
    </div>

    <div class="modal-window" id="marsbar-window">
      <div class="modal-inner-container">
        <div class="modal-inner-content">
          <div class="row">
            <div class="col-4">
              <h3 class="modal-inner-image-heading">Marsbar</h3>
              <input type="image" src="../img/marsbar.jpg" alt="Marsbar" class="modal-image" data="2"/>
            </div>
          </div>
        </div>
        <div class="modal-inner-footer">
          <button class="add-to-cart-btn" id="add-marsbar-btn">Add to Cart</button>
        </div>
      </div>
    </div>

    <div class="modal-window" id="gummybears-window">
      <div class="modal-inner-container">
        <div class="modal-inner-content">
          <div class="row">
            <div class="col-4">
              <h3 class="modal-inner-image-heading">Gummybears</h3>
              <input type="image" src="../img/gummybears.jpg" alt="Gummybears" class="modal-image" data="3"/>
            </div>
          </div>
        </div>
        <div class="modal-inner-footer">
          <button class="add-to-cart-btn" id="add-gummybears-btn">Add to Cart</button>
        </div>
      </div>
    </div>

    <div class="modal-window" id="jellybeans-window">
      <div class="modal-inner-container">
        <div class="modal-inner-content">
          <div class="row">
            <div class="col-4">
              <h3 class="modal-inner-image-heading">Jellybeans</h3>
              <input type="image" src="../img/jellybeans.jpg" alt="Jellybeans" class="modal-image" data="4"/>
            </div>
          </div>
        </div>
        <div class="modal-inner-footer">
          <button class="add-to-cart-btn" id="add-jellybeans-btn">Add to Cart</button>
        </div>
      </div>
    </div>

    <div class="modal-window" id="mandms-window">
      <div class="modal-inner-container">
        <div class="modal-inner-content">
          <div class="row">
            <div class="col-4">
              <h3 class="modal-inner-image-heading">M&amp;Ms</h3>
              <input type="image" src="../img/mandms.jpg" alt="M&M's" class="modal-image" data="5"/>
            </div>
          </div>
        </div>
        <div class="modal-inner-footer">
          <button class="add-to-cart-btn" id="add-m&ms-btn">Add to Cart</button>
        </div>
      </div>
    </div>

    <div class="modal-window" id="skittles-window">
      <div class="modal-inner-container">
        <div class="modal-inner-content">
          <div class="row">
            <div class="col-4">
              <h3 class="modal-inner-image-heading">Skittles</h3>
              <input type="image" src="../img/skittles.jpg" alt="Skittles" class="modal-image" data="6"/>
            </div>
          </div>
        </div>
        <div class="modal-inner-footer">
          <button class="add-to-cart-btn" id="add-skittles-btn">Add to Cart</button>
        </div>
      </div>
    </div>

    <div class="modal-window" id="hersheys-window">
      <div class="modal-inner-container">
        <div class="modal-inner-content">
          <div class="row">
            <div class="col-4">
              <h3 class="modal-inner-image-heading">Hersheys</h3>
              <input type="image" src="../img/hersheys.png" alt="Hersheys" class="modal-image" data="7"/>
            </div>
          </div>
        </div>
        <div class="modal-inner-footer">
          <button class="add-to-cart-btn" id="add-hersheys-btn">Add to Cart</button>
        </div>
      </div>
    </div>

    <div class="modal-window" id="snickers-window">
      <div class="modal-inner-container">
        <div class="modal-inner-content">
          <div class="row">
            <div class="col-4">
              <h3 class="modal-inner-image-heading">Snickers</h3>
              <input type="image" src="../img/snickers.jpg" alt="Snickers" class="modal-image" data="8"/>
            </div>
          </div>
        </div>
        <div class="modal-inner-footer">
          <button class="add-to-cart-btn" id="add-snickers-btn">Add to Cart</button>
        </div>
      </div>
    </div>

    <div class="modal-window" id="sourpatches-window">
      <div class="modal-inner-container">
        <div class="modal-inner-content">
          <div class="row">
            <div class="col-4">
              <h3 class="modal-inner-image-heading">Sourpatches</h3>
              <input type="image" src="../img/sourpatch.jpg" alt="Sourpatch" class="modal-image" data="9"/>
            </div>
          </div>
        </div>
        <div class="modal-inner-footer">
          <button class="add-to-cart-btn" id="add-sourpatches-btn">Add to Cart</button>
        </div>
      </div>
    </div>

    <div class="modal-window" id="candycorn-window">
      <div class="modal-inner-container">
        <div class="modal-inner-content">
          <div class="row">
            <div class="col-4">
              <h3 class="modal-inner-image-heading">Candycorn</h3>
              <input type="image" src="../img/candycorn.jpg" alt="Candycorn" class="modal-image" data="10"/>
            </div>
          </div>
        </div>
        <div class="modal-inner-footer">
          <button class="add-to-cart-btn" id="add-candycorn-btn">Add to Cart</button>
        </div>
      </div>
    </div>
    <!-- End of Candy Section -->
    <div class="modal-window" id="broccoli-window">
  		<div class="modal-inner-container">
  			<div class="modal-inner-content">
  				<div class="row">
  					<div class="col-4">
  						<h3 class="modal-inner-image-heading">Broccoli</h3>
  						<input type="image" src="../img/broccoli.jpeg" alt="Broccoli" class="modal-image" data="11"/>
  					</div>
  				</div>
  			</div>
  			<div class="modal-inner-footer">
  				<button class="add-to-cart-btn" id="add-broccoli-btn">Add to Cart</button>
  			</div>
  		</div>
    </div>

    <div class="modal-window" id="squash-window">
  		<div class="modal-inner-container">
  			<div class="modal-inner-content">
  				<div class="row">
  					<div class="col-4">
						<h3 class="modal-inner-image-heading">Squash</h3>
						<input type="image" src="../img/squash.jpeg" alt="Squash" class="modal-image" data="12"/>
  					</div>
  				</div>
  			</div>
  			<div class="modal-inner-footer">
  				<button class="add-to-cart-btn">Add to Cart</button>
  			</div>
  		</div>
    </div>

    <div class="modal-window" id="cauliflower-window">
  		<div class="modal-inner-container">
  			<div class="modal-inner-content">
  				<div class="row">
  					<div class="col-4">
  						<h3 class="modal-inner-image-heading">Cauliflower</h3>
  						<input type="image" src="../img/cauliflower.jpeg" alt="Cauliflower" class="modal-image" data="13"/>
  					</div>
  				</div>
  			</div>
  			<div class="modal-inner-footer">
  				<button class="add-to-cart-btn">Add to Cart</button>
  			</div>
  		</div>
    </div>

    <div class="modal-window" id="carrots-window">
  		<div class="modal-inner-container">
  			<div class="modal-inner-content">
  				<div class="row">
  					<div class="col-4">
						<h3 class="modal-inner-image-heading">Carrots</h3>
						<input type="image" src="../img/carrots.jpeg" alt="Carrots" class="modal-image" data="14"/>
  					</div>
  				</div>
  			</div>
  			<div class="modal-inner-footer">
  				<button class="add-to-cart-btn">Add to Cart</button>
  			</div>
  		</div>
    </div>

    <div class="modal-window" id="celery-window">
  		<div class="modal-inner-container">
  			<div class="modal-inner-content">
  				<div class="row">
  					<div class="col-4">
						<h3 class="modal-inner-image-heading">Celery</h3>
						<input type="image" src="../img/celery.jpg" alt="Celery" class="modal-image" data="15"/>
  					</div>
  				</div>
  			</div>
  			<div class="modal-inner-footer">
  				<button class="add-to-cart-btn">Add to Cart</button>
  			</div>
  		</div>
    </div>

    <div class="modal-window" id="lettuce-window">
  		<div class="modal-inner-container">
  			<div class="modal-inner-content">
  				<div class="row">
  					<div class="col-4">
						<h3 class="modal-inner-image-heading">Lettuce</h3>
						<input type="image" src="../img/lettuce.jpg" alt="Lettuce" class="modal-image" data="16"/>
  					</div>
  				</div>
  			</div>
  			<div class="modal-inner-footer">
  				<button class="add-to-cart-btn">Add to Cart</button>
  			</div>
  		</div>
    </div>

    <div class="modal-window" id="potatoes-window">
  		<div class="modal-inner-container">
  			<div class="modal-inner-content">
  				<div class="row">
  					<div class="col-4">
						<h3 class="modal-inner-image-heading">Potatoes</h3>
						<input type="image" src="../img/potatoes.jpeg" alt="White Potatoes" class="modal-image" data="17"/>
  					</div>
  				</div>
  			</div>
  			<div class="modal-inner-footer">
  				<button class="add-to-cart-btn">Add to Cart</button>
  			</div>
  		</div>
    </div>

    <div class="modal-window" id="spinach-window">
  		<div class="modal-inner-container">
  			<div class="modal-inner-content">
  				<div class="row">
  					<div class="col-4">
						<h3 class="modal-inner-image-heading">Spinach</h3>
						<input type="image" src="../img/spinach.jpg" alt="Spinach" class="modal-image" data="18"/>
  					</div>
  				</div>
  			</div>
  			<div class="modal-inner-footer">
  				<button class="add-to-cart-btn">Add to Cart</button>
  			</div>
  		</div>
    </div>

    <div class="modal-window" id="kale-window">
  		<div class="modal-inner-container">
  			<div class="modal-inner-content">
  				<div class="row">
  					<div class="col-4">
						<h3 class="modal-inner-image-heading">Kale</h3>
						<input type="image" src="../img/kale.jpeg" alt="Kale" class="modal-image" data="19"/>
  					</div>
  				</div>
  			</div>
  			<div class="modal-inner-footer">
  				<button class="add-to-cart-btn">Add to Cart</button>
  			</div>
  		</div>
    </div>

    <div class="modal-window" id="onions-window">
  		<div class="modal-inner-container">
  			<div class="modal-inner-content">
  				<div class="row">
  					<div class="col-4">
						<h3 class="modal-inner-image-heading">Onions</h3>
						<input type="image" src="../img/whiteonions.jpg" alt="White Onions" class="modal-image" data="20"/>
  					</div>
  				</div>
  			</div>
  			<div class="modal-inner-footer">
  				<button class="add-to-cart-btn">Add to Cart</button>
  			</div>
  		</div>
    </div>

    <div class="modal-window" id="apples-window">
  		<div class="modal-inner-container">
  			<div class="modal-inner-content">
  				<div class="row">
  					<div class="col-4">
						<h3 class="modal-inner-image-heading">Apples</h3>
						<input type="image" src="../img/apples.jpeg" alt="Apples" class="modal-image" data="21"/>
  					</div>
  				</div>
  			</div>
  			<div class="modal-inner-footer">
  				<button class="add-to-cart-btn">Add to Cart</button>
  			</div>
  		</div>
    </div>

    <div class="modal-window" id="oranges-window">
  		<div class="modal-inner-container">
  			<div class="modal-inner-content">
  				<div class="row">
  					<div class="col-4">
						<h3 class="modal-inner-image-heading">Oranges</h3>
						<input type="image" src="../img/orange.jpeg" alt="Oranges" class="modal-image" data="22"/>
  					</div>
  				</div>
  			</div>
  			<div class="modal-inner-footer">
  				<button class="add-to-cart-btn">Add to Cart</button>
  			</div>
  		</div>
    </div>

    <div class="modal-window" id="bananas-window">
  		<div class="modal-inner-container">
  			<div class="modal-inner-content">
  				<div class="row">
  					<div class="col-4">
						<h3 class="modal-inner-image-heading">Bananas</h3>
						<input type="image" src="../img/bananas.jpeg" alt="Bananas" class="modal-image" data="23"/>
  					</div>
  				</div>
  			</div>
  			<div class="modal-inner-footer">
  				<button class="add-to-cart-btn">Add to Cart</button>
  			</div>
  		</div>
    </div>

    <div class="modal-window" id="pears-window">
  		<div class="modal-inner-container">
  			<div class="modal-inner-content">
  				<div class="row">
  					<div class="col-4">
						<h3 class="modal-inner-image-heading">Pears</h3>
						<input type="image" src="../img/pears.jpeg" alt="Pears" class="modal-image" data="24"/>
  					</div>
  				</div>
  			</div>
  			<div class="modal-inner-footer">
  				<button class="add-to-cart-btn">Add to Cart</button>
  			</div>
  		</div>
    </div>

    <div class="modal-window" id="watermelons-window">
  		<div class="modal-inner-container">
  			<div class="modal-inner-content">
  				<div class="row">
  					<div class="col-4">
						<h3 class="modal-inner-image-heading">Watermelons</h3>
						<input type="image" src="../img/watermelons.jpeg" alt="Watermelons" class="modal-image" data="25"/>
  					</div>
  				</div>
  			</div>
  			<div class="modal-inner-footer">
  				<button class="add-to-cart-btn">Add to Cart</button>
  			</div>
  		</div>
    </div>

    <div class="modal-window" id="pineapples-window">
  		<div class="modal-inner-container">
  			<div class="modal-inner-content">
  				<div class="row">
  					<div class="col-4">
						<h3 class="modal-inner-image-heading">Pineapples</h3>
						<input type="image" src="../img/pineapples.jpg" alt="Pineapples" class="modal-image" data="26"/>
  					</div>
  				</div>
  			</div>
  			<div class="modal-inner-footer">
  				<button class="add-to-cart-btn">Add to Cart</button>
  			</div>
  		</div>
    </div>

    <div class="modal-window" id="kiwis-window">
  		<div class="modal-inner-container">
  			<div class="modal-inner-content">
  				<div class="row">
  					<div class="col-4">
						<h3 class="modal-inner-image-heading">Kiwis</h3>
						<input type="image" src="../img/kiwi.png" alt="Kiwis" class="modal-image" data="27"/>
  					</div>
  				</div>
  			</div>
  			<div class="modal-inner-footer">
  				<button class="add-to-cart-btn">Add to Cart</button>
  			</div>
  		</div>
    </div>

    <div class="modal-window" id="tangerines-window">
  		<div class="modal-inner-container">
  			<div class="modal-inner-content">
  				<div class="row">
  					<div class="col-4">
						<h3 class="modal-inner-image-heading">Tangerines</h3>
						<input type="image" src="../img/tangerines.jpg" alt="Tangerines" class="modal-image" data="28"/>
  					</div>
  				</div>
  			</div>
  			<div class="modal-inner-footer">
  				<button class="add-to-cart-btn">Add to Cart</button>
  			</div>
  		</div>
    </div>

    <div class="modal-window" id="grapefruit-window">
  		<div class="modal-inner-container">
  			<div class="modal-inner-content">
  				<div class="row">
  					<div class="col-4">
						<h3 class="modal-inner-image-heading">Grapefruit</h3>
						<input type="image" src="../img/grapefruits.jpg" alt="Grapefruit" class="modal-image" data="29"/>
  					</div>
  				</div>
  			</div>
  			<div class="modal-inner-footer">
  				<button class="add-to-cart-btn">Add to Cart</button>
  			</div>
  		</div>
    </div>

    <div class="modal-window" id="mangoes-window">
  		<div class="modal-inner-container">
  			<div class="modal-inner-content">
  				<div class="row">
  					<div class="col-4">
						<h3 class="modal-inner-image-heading">Mangoes</h3>
						<input type="image" src="../img/mangoes.jpg" alt="Mangoes" class="modal-image" data="30"/>
  					</div>
  				</div>
  			</div>
  			<div class="modal-inner-footer">
  				<button class="add-to-cart-btn">Add to Cart</button>
  			</div>
  		</div>
    </div>

    <div class="modal-window" id="almonds-window">
  		<div class="modal-inner-container">
  			<div class="modal-inner-content">
  				<div class="row">
  					<div class="col-4">
						<h3 class="modal-inner-image-heading">Almonds</h3>
						<input type="image" src="../img/almonds.jpg" alt="Almonds" class="modal-image" data="31"/>
  					</div>
  				</div>
  			</div>
  			<div class="modal-inner-footer">
  				<button class="add-to-cart-btn">Add to Cart</button>
  			</div>
  		</div>
    </div>

    <div class="modal-window" id="peanuts-window">
  		<div class="modal-inner-container">
  			<div class="modal-inner-content">
  				<div class="row">
  					<div class="col-4">
						<h3 class="modal-inner-image-heading">Peanuts</h3>
						<input type="image" src="../img/peanuts.jpg" alt="Peanuts" class="modal-image" data="32"/>
  					</div>
  				</div>
  			</div>
  			<div class="modal-inner-footer">
  				<button class="add-to-cart-btn">Add to Cart</button>
  			</div>
  		</div>
    </div>

    <div class="modal-window" id="pistachios-window">
  		<div class="modal-inner-container">
  			<div class="modal-inner-content">
  				<div class="row">
  					<div class="col-4">
						<h3 class="modal-inner-image-heading">Pistachios</h3>
						<input type="image" src="../img/pistachios.jpeg" alt="Pistachios" class="modal-image" data="33"/>
  					</div>
  				</div>
  			</div>
  			<div class="modal-inner-footer">
  				<button class="add-to-cart-btn">Add to Cart</button>
  			</div>
  		</div>
    </div>

    <div class="modal-window" id="walnuts-window">
  		<div class="modal-inner-container">
  			<div class="modal-inner-content">
  				<div class="row">
  					<div class="col-4">
						<h3 class="modal-inner-image-heading">Walnuts</h3>
						<input type="image" src="../img/walnuts.jpg" alt="Walnuts" class="modal-image" data="34"/>
  					</div>
  				</div>
  			</div>
  			<div class="modal-inner-footer">
  				<button class="add-to-cart-btn">Add to Cart</button>
  			</div>
  		</div>
    </div>

    <div class="modal-window" id="cashews-window">
  		<div class="modal-inner-container">
  			<div class="modal-inner-content">
  				<div class="row">
  					<div class="col-4">
						<h3 class="modal-inner-image-heading">Cashews</h3>
						<input type="image" src="../img/cashews.jpg" alt="Cashews" class="modal-image" data="35"/>
  					</div>
  				</div>
  			</div>
  			<div class="modal-inner-footer">
  				<button class="add-to-cart-btn">Add to Cart</button>
  			</div>
  		</div>
    </div>

    <div class="modal-window" id="macadamias-window">
  		<div class="modal-inner-container">
  			<div class="modal-inner-content">
  				<div class="row">
  					<div class="col-4">
						<h3 class="modal-inner-image-heading">Macadamias</h3>
						<input type="image" src="../img/macadamias.jpg" alt="Macadamias" class="modal-image" data="36"/>
  					</div>
  				</div>
  			</div>
  			<div class="modal-inner-footer">
  				<button class="add-to-cart-btn">Add to Cart</button>
  			</div>
  		</div>
    </div>

    <div class="modal-window" id="hazelnuts-window">
  		<div class="modal-inner-container">
  			<div class="modal-inner-content">
  				<div class="row">
  					<div class="col-4">
						<h3 class="modal-inner-image-heading">Hazelnuts</h3>
						<input type="image" src="../img/hazelnuts.jpg" alt="Hazelnuts" class="modal-image" data="37"/>
  					</div>
  				</div>
  			</div>
  			<div class="modal-inner-footer">
  				<button class="add-to-cart-btn">Add to Cart</button>
  			</div>
  		</div>
    </div>

    <div class="modal-window" id="pecans-window">
  		<div class="modal-inner-container">
  			<div class="modal-inner-content">
  				<div class="row">
  					<div class="col-4">
						<h3 class="modal-inner-image-heading">Pecans</h3>
						<input type="image" src="../img/pecans.jpg" alt="Pecans" class="modal-image" data="38"/>
  					</div>
  				</div>
  			</div>
  			<div class="modal-inner-footer">
  				<button class="add-to-cart-btn">Add to Cart</button>
  			</div>
  		</div>
    </div>

    <div class="modal-window" id="pinenuts-window">
  		<div class="modal-inner-container">
  			<div class="modal-inner-content">
  				<div class="row">
  					<div class="col-4">
						<h3 class="modal-inner-image-heading">Pine Nuts</h3>
						<input type="image" src="../img/pinenuts.jpg" alt="Pine Nuts" class="modal-image" data="39"/>
  					</div>
  				</div>
  			</div>
  			<div class="modal-inner-footer">
  				<button class="add-to-cart-btn">Add to Cart</button>
  			</div>
  		</div>
    </div>

    <div class="modal-window" id="chestnuts-window">
  		<div class="modal-inner-container">
  			<div class="modal-inner-content">
  				<div class="row">
  					<div class="col-4">
						<h3 class="modal-inner-image-heading">Chestnuts</h3>
						<input type="image" src="../img/chestnuts.jpg" alt="Chestnuts" class="modal-image" data="40"/>
  					</div>
  				</div>
  			</div>
  			<div class="modal-inner-footer">
  				<button class="add-to-cart-btn">Add to Cart</button>
  			</div>
  		</div>
    </div>


	<!-- will add these columns and close-btn to modal via JS when user clicks on food image -->

	<div class="close-btn-container">
		<span class="modal-close-btn"></span>
	</div>



	<div class="col-4 middle-column">
		<h3 class="modal-select-heading">Properties</h3>
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

  <div class="col-4 last-column resetter">
    <h3 class="modal-select-heading">Priority</h3>
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




	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDrQVQzF7VuwHhRVfm7OykRl2puiMMGjEI&callback=initMap"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="foodbin.js"></script>
</body>
</html>
