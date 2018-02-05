/*--- Food Item Modals ---*/
var perImageContainers = document.getElementsByClassName("per-image-container");
    modalWindows = document.getElementsByClassName("modal-window"),
    closeContainer = document.getElementsByClassName("close-btn-container")[0],
    row = document.getElementsByClassName("row"),
    middleColumn = document.getElementsByClassName("middle-column")[0],
    lastColumn = document.getElementsByClassName("last-column")[0],
    modalInnerFooter = document.getElementsByClassName("modal-inner-footer");
    samePriorityError = document.getElementById("same-priority-error");

//append constant close container and middle & third columns to each modal window that pops up
for(let i = 0; i < perImageContainers.length; i++){
    perImageContainers[i].addEventListener("click", function(){
        openFoodModal(i);
    })
}

//open food item modal via homepage image click
function openFoodModal(index){
    $(".close-btn-container").css("display", "block");
    modalWindows[index].appendChild(closeContainer);
    modalWindows[index].style.display = "block";
    $(".middle-column").add(".last-column").css("display", "block");
    row[index].appendChild(middleColumn);
    row[index].appendChild(lastColumn);
}

//open food item modal via make-changes-btn in cart modal
function openFoodModal2(attribute){
    var $row = $("#" + attribute).find(".row");
    $(".close-btn-container").css("display", "block");
    $(".middle-column").add(".last-column").css("display", "block");
    $row.append(middleColumn);
    $row.append(lastColumn);
}

//click on close container in modal window to close the modal window
var closeBtnContainers = document.getElementsByClassName("close-btn-container");
for(let i = 0; i < closeBtnContainers.length; i++){
    closeBtnContainers[i].addEventListener("click", function(){
        var thisModalWindow = this.parentElement;
        thisModalWindow.style.display = "none";
    })
}

//event listener for all modal windows to enable modal window click to close the modal window
for(let i = 0; i < modalWindows.length; i++){
    modalWindows[i].addEventListener("click", function(e){ 
        if(e.target.matches(".modal-window")){
            this.style.display = "none";
        } 
    })
}
/*--- End of Food Item Modals ---*/


/*--- Start of Cart Modal ---*/
var cartContainer = document.getElementById("cart-container"),
    cartIconBox = document.getElementById("cart-icon-box"),
    cartModalWindow = document.getElementById("cart-modal-window"),
    cartCloseContainer = document.getElementById("cart-close-container"),
    cartBadge = document.getElementById("cart-badge");

//display cart modal window when cart icon box is clicked
cartContainer.addEventListener("click", openCartModal);
cartBadge.addEventListener("click", openCartModal);

function openCartModal(e){
    if(e.target.matches("#cart")){
        cartModalWindow.style.display = "block";
    }
    cartModalWindow.style.display = "block";
}

cartModalWindow.addEventListener("click", function(e){
    if(e.target.matches("#cart-modal-window")){
        this.style.display = "none";
    }
})

cartCloseContainer.addEventListener("click", function(){
    this.parentElement.style.display = "none";
})
/*--- End of Cart Modal ---*/


/*--- Food Section Sliders ---*/
var innerImageContainers = document.getElementsByClassName("inner-images-container"),
    foodContainerRowIndex,
    currentSectionIndex = 0,
    width = 100,
    slideLeftBtns = document.getElementsByClassName("slide-left-btn"),
    slideRightBtns = document.getElementsByClassName("slide-right-btn");

    for(let i = 0; i < slideLeftBtns.length; i++){
        slideLeftBtns[i].addEventListener("click", function(){
            foodContainerRowIndex = i;
            currentSectionIndex--;
            if(currentSectionIndex < 0){
                currentSectionIndex = 1;
            }
            moveFoodSection();
        })
    }

    for(let i = 0; i < slideRightBtns.length; i++){
        slideRightBtns[i].addEventListener("click", function(){
            foodContainerRowIndex = i;
            currentSectionIndex++;
            if(currentSectionIndex >= 2){
                currentSectionIndex = 0;
            }
            moveFoodSection();
        })
    }

    function moveFoodSection(){
        innerImageContainers[foodContainerRowIndex].style.left = -width * currentSectionIndex + "%";
    }
    

/*--- End of Food Sliders ---*/




/*--- Add Item to Cart with Add Btn ---*/
var addToCartBtns = document.getElementsByClassName("add-to-cart-btn");
var priorityNumForm = document.getElementById("priority-num-form");
var selectorForm = document.getElementById("selector-form");
var modalInnerImageHeadings = document.getElementsByClassName("modal-inner-image-heading");
var modalImages = document.getElementsByClassName("modal-image");
var gotHeading;
var cartItems = 0;
var placeOrderBtn = document.getElementById("place-order-btn");
var noGroceriesAdded = document.getElementById("no-groceries-added");

for(let i = 0; i < addToCartBtns.length; i++){
    addToCartBtns[i].addEventListener("click", function(){
        addFoodItem(i);
    });
}
function addFoodItem(index){
    var modalWindow = addToCartBtns[index].parentElement.parentElement.parentElement,
        modalWindowId = modalWindow.id;
        $modalContainer = $(".add-to-cart-btn").eq(index).parents(".modal-inner-container"),
        $modalContent = $modalContainer.find(".modal-inner-content"),
        $modalFoodHeading = $modalContent.find(".modal-inner-image-heading").text();

        $weightSelectorValue = $modalContent.find(".weight-selector option:checked").text(),
        $weightNumVal = $modalContent.find(".weight-priority option:checked").text(),

        $costSelectorValue = $modalContent.find(".cost-selector option:checked").text(),
        $costNumVal = $modalContent.find(".cost-priority option:checked").text(),

        $specialtySelectorValue = $modalContent.find(".specialty-selector option:checked").text(),
        $specialtyNumVal = $modalContent.find(".specialty-priority option:checked").text(),

        $qualitySelectorValue = $modalContent.find(".quality-selector option:checked").text(); 
        $qualityNumVal = $modalContent.find(".quality-priority option:checked").text();

        //check to see if any two priority values are the same
        if($weightNumVal == $costNumVal || 
            $weightNumVal == $specialtyNumVal || 
            $weightNumVal == $qualityNumVal || 
            $costNumVal == $specialtyNumVal ||
            $costNumVal == $qualityNumVal ||
            $specialtyNumVal == $qualityNumVal){
            var $currModalFooter = modalInnerFooter[index];
            $currModalFooter.prepend(samePriorityError);
            samePriorityError.style.display = "block";
            return false;
        }


        itemImageSrc = modalImages[index].getAttribute("src");
        gotHeading = modalInnerImageHeadings[index].textContent;
        createCartItem(
            modalWindowId, gotHeading, itemImageSrc, $weightSelectorValue, 
            $weightNumVal, $costSelectorValue, $costNumVal, 
            $specialtySelectorValue, $specialtyNumVal, 
            $qualitySelectorValue, $qualityNumVal
        );
        cartItems++;
        cartBadge.textContent = cartItems;
        cartBadge.style.display = "block";
        priorityNumForm.reset();
        selectorForm.reset();
        modalWindow.style.display = "none";            
}

/*--- End of Add Btn to Cart ---*/

//make food item row in cart modal with options selected from the food item modal, and food heading
function createCartItem(windowId, heading, imageSrc, weight, weightP, cost, costP, specialty, specialtyP, quality, qualityP){
    
    //create new cart row, cart columns, and add to cart-modal-content div
    var cartContent = document.getElementById("cart-modal-content");
    var newCartRow = document.createElement("div");
    newCartRow.classList.add("cart-row");
    var leftCartCol = document.createElement("div");
    leftCartCol.classList.add("left-cart-col");
    var leftColHeading = document.createElement("h4");
    leftColHeading.classList.add("left-col-heading");
    leftColHeading.textContent = heading;
    var imageContainer = document.createElement("div");
    imageContainer.classList.add("col-image-container")
    var newImage = document.createElement("input");
    newImage.setAttribute("type", "image");
    newImage.setAttribute("src", imageSrc);
    imageContainer.appendChild(newImage);
    var rightCartCol = document.createElement("div");
    rightCartCol.classList.add("right-cart-col");
    var rightColHeading = document.createElement("h4");
    rightColHeading.classList.add("right-col-heading");
    rightColHeading.textContent = "Details";

    //create list and list items with text from select options checked
    var detailsList = document.createElement("ul");
    detailsList.classList.add("details-list");
    var listItem1 = document.createElement("li");
    var listText1 = document.createTextNode("Weight: " + weight + ", Priority: " + weightP);
    listItem1.appendChild(listText1);
    detailsList.appendChild(listItem1);
    var listItem2 = document.createElement("li");
    var listText2 = document.createTextNode("Cost: " + cost + ", Priority: " + costP);
    listItem2.appendChild(listText2);
    detailsList.appendChild(listItem2);
    var listItem3 = document.createElement("li");
    var listText3 = document.createTextNode("Specialty: " + specialty + ", Priority: " + specialtyP);
    listItem3.appendChild(listText3);
    detailsList.appendChild(listItem3);
    var listItem4 = document.createElement("li");
    var listText4 = document.createTextNode("Quality: " + quality + ", Priority: " + qualityP);
    listItem4.appendChild(listText4);
    detailsList.appendChild(listItem4);
    
    //append created columns to the create cart row
    leftCartCol.appendChild(leftColHeading);
    leftCartCol.appendChild(imageContainer);
    rightCartCol.appendChild(rightColHeading);
    rightCartCol.appendChild(detailsList);
    newCartRow.appendChild(leftCartCol);
    newCartRow.appendChild(rightCartCol);

    // create btn container and btn elements
    var btnContainer = document.createElement("div");
    btnContainer.classList.add("item-btns-container");
    var btn1 = document.createElement("button");
    btn1.classList.add("make-changes-btn");
    btn1.setAttribute("for", "");
    btn1.setAttribute("for", windowId);
    btn1.textContent = "Make Changes";
    var btn2 = document.createElement("button");
    btn2.classList.add("remove-item-btn");
    btn2.textContent = "Remove Item";
    btnContainer.appendChild(btn1);
    btnContainer.appendChild(btn2);
    rightCartCol.appendChild(btnContainer);

    //create line divider between food items in cart
    var lineDivider = document.createElement("div");
    lineDivider.classList.add("line-divider")

    cartContent.appendChild(newCartRow);
    cartContent.appendChild(lineDivider);
    placeOrderBtn.style.display = "block";
    noGroceriesAdded.style.display = "none";   
}

//add click event and run code if either the remove-item-btn or make-changes-btn is clicked
$("body").click(function(event){
    if(event.target.matches(".make-changes-btn")){
        let foodAtt = $(event.target).attr("for");
        cartModalWindow.style.display = "none";
        let currFoodRow = event.target.parentElement.parentElement.parentElement;
        let $nextLineDivider = $(event.target).parents(".cart-row").next(".line-divider");
        $nextLineDivider.css("display", "none");
        currFoodRow.style.display = "none";
        cartItems--;
        cartBadge.textContent = cartItems;
        if(cartBadge.textContent === "0"){
            cartBadge.style.display = "none";
        }
        $("#" + foodAtt).css("display", "block");
        openFoodModal2(foodAtt);
    }
    if(event.target.matches(".remove-item-btn")){
        var $thisBtn = event.target;
        let thisFoodRow = $thisBtn.parentElement.parentElement.parentElement;
        let $nextLineDivider = $(event.target).parents(".cart-row").next(".line-divider");
        $nextLineDivider.css("display", "none");
        thisFoodRow.style.display = "none";
        cartItems--;
        cartBadge.textContent = cartItems;
        if(cartBadge.textContent === "0"){
            cartBadge.style.display = "none";
        }
    }   
});

/*--- Initialize Google Maps API ---*/
var locationInputField = document.getElementById("location-input-field"),
searchListGroup = document.getElementById("search-list-group"),
searchListItem = document.querySelectorAll("#search-list-group li"),
userLocation, userCoords;

locationInputField.addEventListener("click", function(){
    if(searchListGroup.style.height !== "185px"){
        searchListGroup.style.height = "185px";
    }
});

locationInputField.addEventListener("input", function(){
    let inputValue = this.value.toUpperCase();
    for(let i = 0; i < searchListItem.length; i++){
        let currItem = searchListItem[i];
        if(currItem.textContent.toUpperCase().indexOf(inputValue) > -1){
            currItem.style.display = "";
        } else {
            currItem.style.display = "none";
        }    
    }
});


//New Content
var storedLocations = [
    {location: "Sacramento, CA", coords: {lat: 38.581572, lng: -121.494400}},
    {location: "Los Angeles, CA", coords: {lat: 34.052234, lng: -118.243685}},
    {location: "Oakland, CA", coords: {lat: 37.8044, lng: -122.2711}},
    {location: "San Francisco, CA", coords:{lat: 37.774929, lng: -122.419416}},
    {location: "San Diego, CA", coords: {lat: 32.715738,lng: -117.161084}},
    {location: "San Jose, CA", coords: {lat: 37.338208,lng: -121.886329}},
    {location: "Riverside, CA", coords: {lat: 33.9533, lng: -117.3962}}
];

//start of california cities and grocery stores arrays
var sacramentoStores = [
    {storeName: "Safeway", address: "1025 Alhambra Blvd, Sacramento, CA 95816", coords: {lat: 38.5716084, lng: -121.464628699999}},
    {storeName: "Safeway", address: "1814 19th St, Sacramento, CA 95811", coords: {lat: 38.567982, lng: -121.48602800000003}},
    {storeName: "Sacramento Natural Foods Co-op", address: "2820 R St, Sacramento, CA 95816", coords: {lat: 38.564632, lng: -121.472913}},
    {storeName: "Trader Joe's", address: "5000 Folsom Blvd, Sacramento, CA 95819", coords: {lat: 38.5604536, lng: -121.4448777}},
    {storeName: "Corti Brothers", address: "5810 Folsom Blvd, Sacramento, CA 95819", coords: {lat: 38.5571126, lng: -121.43630050000002}},
    {storeName: "Food Source", address: "3547 Bradshaw Rd, Sacramento, CA 95827", coords: {lat: 38.5583289, lng: -121.33411469999999}},
    {storeName: "Taylor's Market", address: "2900 Freeport Blvd, Sacramento, CA 95818", coords: {lat: 38.5518472, lng: -121.48892610000001}},
    {storeName: "Oto's Marketplace", address: "4990 Freeport Blvd, Sacramento, CA 95822", coords: {lat: 38.5289733, lng: -121.49626739999997}},
    {storeName: "Smart & Final", address: "6340 Stockton Blvd, Sacramento, CA 95824", coords: {lat: 38.511698, lng: -121.43724259999999}},
    {storeName: "Mi Rancho", address: "2355 Florin Rd, Sacramento, CA 95822, USA", coords: {lat: 38.4974369, lng: -121.4834611}},
    {storeName: "India House of Grocery", address: "6618 Florin Rd # B, Sacramento, CA 95828", coords: {lat: 38.4952973, lng: -121.42554369999999}},
    {storeName: "Smart & Final Extra", address: "7205 Freeport Blvd, Sacramento, CA 95831", coords: {lat: 38.4943793, lng: -121.50473090000003}},
    {storeName: "Nugget Markets", address: "1040 Florin Rd, Sacramento, CA 95831", coords: {lat: 38.4946749, lng: -121.52080899999999}},
    {storeName: "Foodsco", address: "5021 Fruitridge Rd, Sacramento, CA 95820", coords: {lat: 38.5269495, lng: -121.44444900000002}},
];

var sandiegoStores = [
    {storeName: "Ralphs", address: "1666 Rosecrans St, San Diego, CA 92106", coords: {lat: 32.728515, lng: -117.22638360000002}},
    {storeName: "Vons", address: "3645 Midway Dr, San Diego, CA 92110", coords: {lat: 32.7510758, lng: -117.21749720000003}},
    {storeName: "Ralphs", address: "3345 Sports Arena Blvd, San Diego, CA 92110", coords: {lat: 32.7516318, lng: -117.21101880000003}},
    {storeName: "Vons", address: "515 W Washington St, San Diego, CA 92103", coords: {lat: 32.7493889, lng: -117.16813400000001}},
    {storeName: "Ralphs", address: "1020 University Ave, San Diego, CA 92103", coords: {lat: 32.74927, lng: -117.15476699999999}},
    {storeName: "Ralphs", address: "101 G St, San Diego, CA 92101", coords: {lat: 32.7121107, lng: -117.16332019999999}},
    {storeName: "Grocery Outlet Bargain Market", address: "1002 Market street, San Diego, CA 92101", coords: {lat: 32.7119291, lng: -117.1551101}},
    {storeName: "Ralphs", address: "4315 Mission Blvd, San Diego, CA 92109", coords: {lat: 32.7942864, lng: -117.25406350000003}},
    {storeName: "Vons", address: "1702 Garnet Ave, San Diego, CA 92109", coords: {lat: 32.8020198, lng: -117.23895449999998}},
    {storeName: "Albertsons", address: "655 14th St, San Diego, CA 92101", coords: {lat: 32.7120903, lng: -117.15136000000001}},
    {storeName: "Ralphs", address: "5680 Mission Center Rd, San Diego, CA 92108", coords: {lat: 32.7748544, lng: -117.155842}},
    {storeName: "Vons", address: "3610 Adams Ave, San Diego, CA 92116", coords: {lat: 32.7640694, lng: -117.11453510000001}},
    {storeName: "Ralphs", address: "6670 Montezuma Rd, San Diego, CA 92115", coords: {lat: 32.7695215, lng: -117.05427529999997}},
    {storeName: "Windmill Farms", address: "6386 Del Cerro Blvd, San Diego, CA 92120", coords: {lat: 32.7838935, lng: -117.0598693}},
    {storeName: "Keils", address: "7403 Jackson Dr, San Diego, CA 92119", coords: {lat: 32.8037513, lng: -117.04444430000001}},
    {storeName: "Ralphs", address: "3011 Alta View Dr, San Diego, CA 92139", coords: {lat: 32.6769872, lng: -117.03831130000003}}
];

var sanFranciscoStores = [
    {storeName: "Safeway", address: "15 Marina Blvd, San Francisco, CA 94123", coords: {lat: 37.8044556, lng: -122.4328266}},
    {storeName: "Safeway", address: "350 Bay St, San Francisco, CA 94133", coords: {lat: 37.8059079, lng: -122.412709}},
    {storeName: "Safeway", address: "145 Jackson St, San Francisco, CA 94111", coords: {lat: 37.7969149, lng: -122.39865930000002}},
    {storeName: "Ming Lee Trading", address: "759 Jackson St, San Francisco, CA 94133", coords: {lat: 37.7957754, lng: -122.40761609999998}},
    {storeName: "Trader Joe's", address: "1095 Hyde St, San Francisco, CA 94109", coords: {lat: 37.7907143, lng: -122.41777780000001}},
    {storeName: "Safeway", address: "1335 Webster St, San Francisco, CA 94115", coords: {lat: 37.7827425, lng: -122.4314956}},
    {storeName: "The Market", address: "1355 Market St, San Francisco, CA 94103", coords: {lat: 37.7767687, lng: -122.41661640000001}},
    {storeName: "Market Mayflower & Deli", address: "985 Bush St, San Francisco, CA 94109", coords: {lat: 37.7893193, lng: -122.41332}},
    {storeName: "Safeway", address: "298 King St, San Francisco, CA 94107", coords: {lat: 37.7766671,lng: -122.39410880000003}},
    {storeName: "Falletti Foods", address: "308 Broderick St, San Francisco, CA 94117", coords: {lat: 37.7732175, lng: -122.43890520000002}},
];

var oaklandStores = [
    {storeName: "Trader Joe's", address: "5727 College Ave, Oakland, CA 94618", coords: {lat: 37.8455055, lng: -122.25272789999997}},
    {storeName: "Village Market", address: "5885 Broadway Terrace, Oakland, CA 94618", coords: {lat: 37.8408077, lng: -122.2364288}},
    {storeName: "Safeway", address: "5100 Broadway, Oakland, CA 94611", coords: {lat: 37.8349287, lng: -122.24862860000002}},
    {storeName: "Piedmont Grocery Co", address: "4038 Piedmont Ave, Oakland, CA 94611", coords: {lat: 37.8255569, lng: -122.25278930000002}},
    {storeName: "Safeway", address: "2096 Mountain Blvd, Oakland, CA 94611", coords: {lat: 37.8254544, lng: -122.2089876}},
    {storeName: "Safeway", address: "3747 Grand Ave, Oakland, CA 94610", coords: {lat: 37.8173247, lng: -122.24567660000002}},
    {storeName: "Trader Joe's", address: "3250 Lakeshore Ave, Oakland, CA 94610", coords: {lat: 37.8097627, lng: -122.24424569999996}},
    {storeName: "Rocky's Market", address: "1440 Leimert Blvd, Oakland, CA 94602", coords: {lat: 37.8118533, lng: -122.21228400000001}},
    {storeName: "Nature's Best Foods", address: "1431 Jackson St, Oakland, CA 94612", coords: {lat: 37.8027177, lng: -122.26519960000002}},
    {storeName: "Farmer Joe's Marketplace", address: "3426 Fruitvale Ave, Oakland, CA 94602", coords: {lat: 37.7995471, lng: -122.21597509999998}},
];
// end of california cities and grocery stores arrays

var mapElement = document.getElementById("map"),
    storeLists = document.getElementsByClassName("store-list"),
    sacramentoStoreList = document.getElementById("sacramento-store-list"),
    sanDiegoStoreList = document.getElementById("san-diego-store-list"),
    oaklandStoreList = document.getElementById("oakland-store-list"),
    sanFranciscoStoreList = document.getElementById("san-francisco-store-list");

var userInfoWindow;
var storeMarkers = [];
function initMap(){
    userInfoWindow = new google.maps.InfoWindow;
    if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      

      userInfoWindow.setPosition(pos);
      userInfoWindow.setContent('User location:');
      userInfoWindow.open(mapInstance1);
      //map.setCenter(pos);
    }, function() {
      handleLocationError(true, userInfoWindow, mapInstance1.getCenter());
    });
  } else {
    // Browser doesn't support Geolocation
    handleLocationError(false, userInfoWindow, mapInstance1.getCenter());
  }





    for (let i = 0; i < searchListItem.length; i++){
        searchListItem[i].addEventListener("click", function(){
            var thisItem = this.textContent;
            var itemScrollHeight = this.scrollHeight;
            searchListGroup.style.height = itemScrollHeight + "px";
            //go through stored location names in location object and compare to list item selected
            storedLocations.forEach(function(storedLocation){
                if(storedLocation.location === thisItem){
                    locationInputField.value = thisItem;
                    userLocation = storedLocation.location;
                    userCoords = storedLocation.coords;
                    createMapObject(11, userLocation, userCoords);
                }
            });
            $("#search-list-group").animate({
                scrollTop: $("li:contains(" + thisItem + ")").offset().top - $("#search-list-group").offset().top + $("#search-list-group").scrollTop()
            }, "500");
        });
    };

    //default map zoom and center values
    function options1(){
        return {
            zoom: 5,
            center: {lat: 38.415405, lng: -120.770234}
        }
    }

    //zoom and center values used when user chooses a location
    function options2(z, coords){
        return {
            zoom: z,
            center: coords
        }
    }

    //initilize map instance after calling function that incorporates zoom level, location name, and coordinates
    var mapInstance1 = new google.maps.Map(mapElement, options1());
    var mapInstance2;
    function createMapObject(z, userLocation, coords){
        mapInstance2 = new google.maps.Map(mapElement, options2(z, coords));
        addLocationMarker(userLocation, coords);
    }

    //adds marker based on user location input and the coordinates for the city name
    function addLocationMarker(userLocation, userCoordinates){
        var marker = new google.maps.Marker({
            map: mapInstance2,
            //label: userLocation[0],
            animation: google.maps.Animation.DROP,
            position: userCoordinates
        });

        var infoWindow = new google.maps.InfoWindow({
            content: "<h4>" + userLocation + "</h4>"
        });
        marker.addListener("click", function(){
            infoWindow.open(map, marker);
        });
    };

    //show store marker on map when user clicks on store list option for sacramento location
    
    $("#search-list-group li a").click(function(){
        for(let i = 0; i < storeLists.length; i++){
            storeLists[i].style.display = "none";
            storeLists[i].options[0].selected = true;
        }
        switch(true){
            case ($(this).text() === "Sacramento, CA"):
                console.log(this.textContent);
                let sacramentoCity = this.textContent;
                sacStoreMapSetup(sacramentoCity);
                sacramentoStoreList.style.display = "block";
                sacramentoStoreList.options[0].selected = true;
            break;
            case ($(this).text() === "Oakland, CA"):
                let oaklandCity = this.textContent;
                console.log(this.textContent);
                oaklandStoreMapSetup(oaklandCity);
                oaklandStoreList.style.display = "block";
                oaklandStoreList.options[0].selected = true;
            break;
            case ($(this).text() === "San Francisco, CA"):
                let sanfranCity = this.textContent;
                console.log(this.textContent);
                sanfranStoreMapSetup(sanfranCity);
                sanFranciscoStoreList.style.display = "block";
                sanFranciscoStoreList.options[0].selected = true;
            break;
            case ($(this).text() === "San Diego, CA"):
                let sandiegoCity = this.textContent;
                console.log(this.textContent);
                sandiegoStoreMapSetup(sandiegoCity);
                sanDiegoStoreList.style.display = "block";
                sanDiegoStoreList.options[0].selected = true;
            break;
        }
    })

    //start of cityStoreSetup functions
    function sacStoreMapSetup($selectedCity){
        $("#sacramento-store-list").on("change", function(){
            var thisStoreList = $(this).id;
            if($selectedCity === "Sacramento, CA"){
                addStoreToMap(sacramentoStores);
            }
        });
    }

    function sanfranStoreMapSetup($selectedCity){
        $("#san-francisco-store-list").on("change", function(){
            var thisStoreList = $(this).id;
            if($selectedCity === "San Francisco, CA"){
                addStoreToMap(sanFranciscoStores, thisStoreList);
            }
        });
    }

    function oaklandStoreMapSetup($selectedCity){
        $("#oakland-store-list").on("change", function(){
            if($selectedCity === "Oakland, CA"){
                addStoreToMap(oaklandStores);
            }
        });
    }

    function sandiegoStoreMapSetup($selectedCity){
        $("#san-diego-store-list").on("change", function(){
            if($selectedCity === "San Diego, CA"){
                addStoreToMap(sandiegoStores);
            }
        });
    }
    //end of cityStoreSetup functions
    
    
    function setMapOnAll(mapInstance2) {
        for (var i = 0; i < storeMarkers.length; i++) {
          storeMarkers[i].setMap(mapInstance2);
        }
    }
    function clearMarkers(){
        setMapOnAll(null);
    }
    function deleteMarkers(){
        clearMarkers();
        storeMarkers = [];
    }

    function addStoreToMap(storeArr, thisStoreList){
        deleteMarkers();
        var $storeOptionText = $(".store-list option:selected").text();
        console.log($storeOptionText);
        var firstP = $storeOptionText.indexOf("(");
        var lastP = $storeOptionText.indexOf(")");
        var $finalOptionText = $storeOptionText.substring(firstP + 1, lastP).toUpperCase();

        storeArr.forEach(function(store){
            var add = store.address;
            if(add.toUpperCase().lastIndexOf($finalOptionText) > -1){
                let storeName = store.storeName;
                let storeCoords = store.coords;
                let storeAddress = store.address;
                addStoreMarkers(storeName, storeCoords, storeAddress);
            }
        });
    }


    //add store to map when that store option is selected
    
    function addStoreMarkers(storeName, storeCoords, storeAddress){
        var marker = new google.maps.Marker({
            map: mapInstance2,
            icon: "../img/shopping-cart.png",
            animation: google.maps.Animation.DROP,
            position: storeCoords
        });
        storeMarkers.push(marker);

        var infoWindow = new google.maps.InfoWindow({
            content: "<p style='font-weight: bold'>" + storeName + "</p><br/>" +
                     "<span>" + storeAddress + "</span><br/>" +
                     "<a href='https://maps.google.com/?q=" + storeName + " " + storeAddress + "' target='_blank' style='color: #427fed'>View on Google Maps</a>"
        })
      
        infoWindow.open(map, marker);
        marker.addListener("click", function(){
            infoWindow.open(map, marker);
        })
    }
}; //end of initMap function


function handleLocationError(browserHasGeolocation, info, pos) {
  info.setPosition(pos);
  info.setContent(browserHasGeolocation ?
                        'Error: The Geolocation service failed.' :
                        'Error: Your browser doesn\'t support geolocation.');
  info.open(mapElement);
}
/*--- End of Google Maps API ---*/


    







$(window).on('beforeunload', function() {
   $(window).scrollTop(0);
});


$("#search-case-list a").on("click", function(e){
    e.preventDefault();
});


$(".banner-btn").click(function(){
    $("html, body").animate({
        scrollTop: $("#user-location-section").offset().top - 60
    }, "slow");
})

$("#ca-locations a").click(function(e){
    e.preventDefault();
    $("html, body").animate({
        scrollTop: $("#user-location-section").offset().top - 60
    });
})
