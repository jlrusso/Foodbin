/*--- Food Item Modals ---*/
var perImageContainers = document.getElementsByClassName("per-image-container");
    modalWindows = document.getElementsByClassName("modal-window"),
    closeContainer = document.getElementsByClassName("close-btn-container")[0],
    row = document.getElementsByClassName("row"),
    middleColumn = document.getElementsByClassName("middle-column")[0],
    lastColumn = document.getElementsByClassName("last-column")[0],
    modalInnerFooter = document.getElementsByClassName("modal-inner-footer"),
    samePriorityError = document.getElementById("same-priority-error");

//append constant close container and middle & third columns to each modal window that pops up
for(let i = 0; i < perImageContainers.length; i++){
    perImageContainers[i].addEventListener("click", function(){
        openFoodModal(i);
    })
}

//open food item modal when user clicks on food item
function openFoodModal(index){
    $(".close-btn-container").css("display", "block");
    modalWindows[index].appendChild(closeContainer);
    modalWindows[index].style.display = "block";
    $(".middle-column").add(".last-column").css("display", "block");
    row[index].appendChild(middleColumn);
    row[index].appendChild(lastColumn);
}

//open food item modal when user clicks "Make Changes" btn in cart modal
function openFoodModal2(attribute){
    var $row = $("#" + attribute).find(".row");
    $(".close-btn-container").css("display", "block");
    $(".middle-column").add(".last-column").css("display", "block");
    $row.append(middleColumn);
    $row.append(lastColumn);
}

//close modal window when user clicks on X btn in modal window
var closeBtnContainers = document.getElementsByClassName("close-btn-container");
for(let i = 0; i < closeBtnContainers.length; i++){
    closeBtnContainers[i].addEventListener("click", function(){
        var thisModalWindow = this.parentElement;
        thisModalWindow.style.display = "none";
    })
}

//close modal window when user clicks on dark area, but not modal content area
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

//open cart modal when user clicks on cart icon in nav bar
function openCartModal(e){
    e.preventDefault();
    if(e.target.matches("#cart")){
        cartModalWindow.style.display = "block";
    }
    cartModalWindow.style.display = "block";
}

//close cart modal if user clicks on dark area of modal window and not modal content area
cartModalWindow.addEventListener("click", function(e){
    if(e.target.matches("#cart-modal-window")){
        this.style.display = "none";
    }
})

//close cart modal when user clicks on X btn in the modal window
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
        $modalContainer = $(".add-to-cart-btn").eq(index).parents(".modal-inner-container"),
        $modalContent = $modalContainer.find(".modal-inner-content"),
        $modalFoodHeading = $modalContent.find(".modal-inner-image-heading").text(),
        $weightSelectorValue = $modalContent.find(".weight-selector option:checked").text(),
        $weightNumVal = $modalContent.find(".weight-priority option:checked").text(),
        $costSelectorValue = $modalContent.find(".cost-selector option:checked").text(),
        $costNumVal = $modalContent.find(".cost-priority option:checked").text(),
        $specialtySelectorValue = $modalContent.find(".specialty-selector option:checked").text(),
        $specialtyNumVal = $modalContent.find(".specialty-priority option:checked").text(),
        $qualitySelectorValue = $modalContent.find(".quality-selector option:checked").text(), 
        $qualityNumVal = $modalContent.find(".quality-priority option:checked").text(),
        modalWindowId = modalWindow.id;

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
var deliveryBtnContainer = document.getElementById("deliver-btn-container"),
    locationInputField = document.getElementById("location-input-field"),
    searchListGroup = document.getElementById("search-list-group"),
    searchListItem = document.querySelectorAll("#search-list-group li"),
    userLocation, userCoords;

locationInputField.addEventListener("click", function(){
    if(searchListGroup.style.height !== "150px"){
        searchListGroup.style.height = "150px";
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
    {location: "Fremont, CA", coords: {lat: 37.5483, lng: -121.9886}},
    {location: "Berkeley, CA", coords: {lat: 37.8716, lng: -122.2727}},
    {location: "Stockton, CA", coords: {lat: 37.9577, lng: -121.2908}},
    {location: "Santa Barbara, CA", coords: {lat: 34.4208, lng: -119.6982}},
    {location: "Long Beach, CA", coords: {lat: 33.7701, lng: -118.1937}},
    {location: "Anaheim, CA", coords: {lat: 33.8366, lng: -117.9143}},
    {location: "Irvine, CA", coords: {lat: 33.6846, lng: -117.8265}},
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
    {storeName: "Smart & Final Extra", address: "7205 Freeport Blvd, Sacramento, CA 95831", coords: {lat: 38.4943793, lng: -121.50473090000003}},
    {storeName: "Nugget Markets", address: "1040 Florin Rd, Sacramento, CA 95831", coords: {lat: 38.4946749, lng: -121.52080899999999}},
    {storeName: "Foodsco", address: "5021 Fruitridge Rd, Sacramento, CA 95820", coords: {lat: 38.5269495, lng: -121.44444900000002}},
];

var sanDiegoStores = [
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
    {storeName: "Vons", address: "3610 Adams Ave, San Diego, CA 92116", coords: {lat: 32.7640694, lng: -117.11453510000001}}
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

var fremontStores = [
    {storeName: "Lucky", address: "35820 Fremont Blvd, Fremont, CA 94536", coords: {lat: 37.5675554, lng: -122.02325129999997}},
    {storeName: "Maiwand Market", address: "37235 Fremont Blvd, Fremont, CA 94536", coords: {lat: 37.5587722, lng: -122.00875769999999}},
    {storeName: "Whole Foods Market", address: "3111 Mowry Ave, Fremont, CA 94538", coords: {lat: 37.5549923, lng: -121.98521010000002}},
    {storeName: "Raley's", address: "39200 Paseo Padre Pkwy, Fremont, CA 94538", coords: {lat: 37.5536735, lng: -121.97890660000002}},
    {storeName: "Smart & Final Extra", address: "3171 Walnut Ave, Fremont, CA 94538", coords: {lat: 37.5513737, lng: -121.98059649999999}},
    {storeName: "Indian Market", address: "3890 Walnut Ave, Fremont, CA 94538", coords: {lat: 37.546324, lng: -121.98159599999997}},
    {storeName: "Safeway", address: "39100 Argonaut Way, Fremont, CA 94538", coords: {lat: 37.545291, lng: -121.98929129999999}},
    {storeName: "Trader Joe's", address: "39324 Argonaut Way, Fremont, CA 94538", coords: {lat: 37.5435052, lng: -121.98624799999999}},
    {storeName: "India Cash & Carry", address: "39175 Farwell Dr, Fremont, CA 94538", coords: {lat: 37.5300068, lng: -121.99900030000003}},
    {storeName: "Grocery Outlet Bargain Market", address: "4949 Stevenson Blvd f, Fremont, CA 94538", coords: {lat: 37.5297689, lng: -121.98327080000001}},
    {storeName: "Safeway", address: "3902 Washington Blvd, Fremont, CA 94538", coords: {lat: 37.5316114, lng: -121.95720990000001}}
];
var berkeleyStores = [
    {storeName: "Berkeley Natural Grocery Company", address: "1336 Gilman St, Albany, CA 94706", coords: {lat: 37.880892, lng: -122.288567}},
    {storeName: "Safeway", address: "1444 Shattuck Pl, Berkeley, CA 94709", coords: {lat: 37.88076640000001, lng: -122.27002749999997}},
    {storeName: "Cedar Market", address: "1601 California St, Berkeley, CA 94703", coords: {lat: 37.8768539, lng: -122.28027329999998}},
    {storeName: "Safeway Community Markets", address: "1550 Shattuck Ave, Berkeley, CA 94709", coords: {lat: 37.8787907, lng: -122.26997069999999}},
    {storeName: "Foothill Club Market", address: "2700 Hearst Ave, Berkeley, CA 94720", coords: {lat: 37.87544279999999, lng: -122.25581820000002}},
    {storeName: "Trader Joe's", address: "1885 University Ave, Berkeley, CA 94703", coords: {lat: 37.871738, lng: -122.27326640000001}},
    {storeName: "Mi Tierra Foods", address: "2082 San Pablo Ave, Berkeley, CA 94702", coords: {lat: 37.8680016, lng: -122.2921038}},
    {storeName: "Alex Market", address: "2440 Sacramento St, Berkeley, CA 94702", coords: {lat: 37.8624588, lng: -122.28140810000002}},
    {storeName: "Shattuck Market", address: "2441 Shattuck Ave, Berkeley, CA 94704", coords: {lat: 37.8650546, lng: -122.26710049999997}},
    {storeName: "Franklin Bros. Market", address: "901 Bancroft Way, Berkeley, CA 94710", coords: {lat: 37.8638964, lng: -122.29508900000002}},
    {storeName: "Whole Foods Market", address: "3000 Telegraph Ave, Berkeley, CA 94705", coords: {lat: 37.8556007, lng: -122.2601477}},
];

var stocktonStores = [
    {storeName: "Raley's", address: "4255 E Morada Ln, Stockton, CA 95212", coords: {lat: 38.0397617, lng: -121.26014190000001}},
    {storeName: "Food 4 Less", address: "789 W Hammer Ln, Stockton, CA 95210", coords: {lat: 38.0228413, lng: -121.32136459999998}},
    {storeName: "SF Supermarket", address: "8004 West Ln, Stockton, CA 95210", coords: {lat: 38.022886, lng: -121.29322769999999}},
    {storeName: "WinCo Foods", address: "5110 Montauban Ave, Stockton, CA 95210", coords: {lat: 38.0046898, lng: -121.28375819999997}},
    {storeName: "Safeway", address: "6445 Pacific Ave, Stockton, CA 95207", coords: {lat: 38.0085011, lng: -121.32089209999998}},
    {storeName: "Smart & Final Extra", address: "744 W Hammer Ln, Stockton, CA 95210", coords: {lat: 38.0199804, lng: -121.3210004}},
    {storeName: "Grocery Outlet Bargain Market", address: "6618 Pacific Ave, Stockton, CA 95207", coords: {lat: 38.0105832, lng: -121.3193422}},
    {storeName: "Save Mart Supermarkets", address: "4725 Quail Lakes Dr, Stockton, CA 95207", coords: {lat: 37.9864003, lng: -121.3421659}},
    {storeName: "La Superior Super Mercados", address: "1536 Waterloo Rd, Stockton, CA 95205", coords: {lat: 37.9721818, lng: -121.26756339999997}},
    {storeName: "Madison Market", address: "748 N Madison St, Stockton, CA 95202", coords: {lat: 37.959899, lng: -121.2955369}}
];
var sanJoseStores = [
    {storeName: "H Mart", address: "1179 S De Anza Blvd, San Jose, CA 95129", coords: {lat: 37.3041788, lng: -122.0336532}},
    {storeName: "Lion Market", address: "471 Saratoga Ave, San Jose, CA 95129", coords: {lat: 37.3191117, lng: -121.97438199999999}},
    {storeName: "Trader Joe's", address: "635 Coleman Ave, San Jose, CA 95110", coords: {lat: 37.3411464, lng: -121.90929570000003}},
    {storeName: "Dai Thanh Supermarket", address: "420 S 2nd St, San Jose, CA 95113", coords: {lat: 37.3305671, lng: -121.88368500000001}},
    {storeName: "Safeway", address: "1300 W San Carlos St, San Jose, CA 95126", coords: {lat: 37.3229324, lng: -121.9119445}},
    {storeName: "Arteaga's", address: "1003 Lincoln Ave, San Jose, CA 95125", coords: {lat: 37.3121834, lng: -121.90422619999998}},
    {storeName: "Whole Foods Market", address: "777 The Alameda, San Jose, CA 95126", coords: {lat: 37.3321739, lng: -121.90481360000001}},
    {storeName: "Santo Market Inc", address: "245 E Taylor St, San Jose, CA 95112", coords: {lat: 37.3517084, lng: -121.89530910000002}},
    {storeName: "Grocery Outlet Bargain Market", address: "2300 Monterey Rd, San Jose, CA 95112", coords: {lat: 37.301419, lng: -121.85831350000001}},
    {storeName: "Safeway", address: "1530 Hamilton Ave, San Jose, CA 95125", coords: {lat: 37.2933062, lng: -121.9109977}},
    {storeName: "Mitsuwa Marketplace", address: "675 Saratoga Ave, San Jose, CA 95129", coords: {lat: 37.3150592, lng: -121.97794770000002}}
];
var losAngelesStores = [
    {storeName: "Whole Foods Market", address: "11737 San Vicente Blvd, Los Angeles, CA 90049", coords: {lat: 34.0536448, lng: -118.46738620000002}},
    {storeName: "Gelson's Market", address: "10250 California State Route 2, Los Angeles, CA 90067", coords: {lat: 34.0596051, lng: -118.4194354}},
    {storeName: "Super King Market", address: "2716 N San Fernando Rd, Los Angeles, CA 90065", coords: {lat: 34.1096587, lng: -118.24305579999998}},
    {storeName: "Vons", address: "4520 Sunset Blvd, Los Angeles, CA 90028", coords: {lat: 34.0970404, lng: -118.28798549999999}},
    {storeName: "Fresco Community Market", address: "5914 Monterey Rd, Los Angeles, CA 90042", coords: {lat: 34.104784, lng: -118.18324280000002}},
    {storeName: "Pavilions", address: "727 N Vine St, Los Angeles, CA 90038", coords: {lat: 34.0845782, lng: -118.3272177}},
    {storeName: "Ralph's", address: "5245 W Centinela Ave, Los Angeles, CA 90045", coords: {lat: 33.9790634, lng: -118.37152100000003}},
    {storeName: "Whole Foods Market", address: "788 S Grand Ave, Los Angeles, CA 90017", coords: {lat: 34.0460562, lng: -118.25774380000001}},
    {storeName: "Smart & Final Extra", address: "845 S Figueroa St #100, Los Angeles, CA 90017", coords: {lat: 34.0475167, lng: -118.2628287}},
    {storeName: "Vons", address: "3461 W 3rd St, Los Angeles, CA 90020", coords: {lat: 34.0699936, lng: -118.2908984}},
    {storeName: "Urban Radish", address: "661 Imperial St, Los Angeles, CA 90021", coords: {lat: 34.0361074, lng: -118.2316935}},
];
var santaBarbaraStores = [
    {storeName: "European Deli Market", address: "4422 Hollister Ave, Santa Barbara, CA 93110", coords: {lat: 34.4402771, lng: -119.77074579999999}},
    {storeName: "Vons", address: "3855 State St, Santa Barbara, CA 93105", coords: {lat: 34.4384846, lng: -119.7495222}},
    {storeName: "Whole Foods Market", address: "3761 State St, Santa Barbara, CA 93105", coords: {lat: 34.439222, lng: -119.7452194}},
    {storeName: "Gelson's Market", address: "3303 State St, Santa Barbara, CA 93105, USA", coords: {lat: 34.4395706, lng: -119.73534919999997}},
    {storeName: "Grocery Outlet Bargain Market", address: "2840 De La Vina St, Santa Barbara, CA 93105", coords: {lat: 34.4375348, lng: -119.72621930000003}},
    {storeName: "Foodland Market", address: "1501 San Andres St, Santa Barbara, CA 93101", coords: {lat: 34.4186878, lng: -119.71653559999999}},
    {storeName: "Ralph's", address: "100 W Carrillo St, Santa Barbara, CA 93101", coords: {lat: 34.4200294, lng: -119.70422830000001}},
    {storeName: "Santa Cruz Market", address: "324 W Montecito St, Santa Barbara, CA 93101", coords: {lat: 34.4112431, lng: -119.69728409999999}},
    {storeName: "Smart & Final", address: "217 E Gutierrez St, Santa Barbara, CA 93101", coords: {lat: 34.4189521, lng: -119.69221570000002}},
    {storeName: "Vons", address: "2010 Cliff Dr, Santa Barbara, CA 93109", coords: {lat: 34.4025252, lng: -119.723747}},
    {storeName: "Brownie's Market", address: "435 De La Vina St, Santa Barbara, CA 93101", coords: {lat: 34.4144594, lng: -119.69777349999998}}
];
var riversideStores = [
    {storeName: "Maxi Foods Market", address: "4050 University Ave, Riverside, CA 92501", coords: {lat: 33.9830631, lng: -117.37890759999999}},
    {storeName: "Goodwin's Organic Foods and Drinks", address: "191 W Big Springs Rd, Riverside, CA 92507", coords: {lat: 33.975942, lng: -117.3154222}},
    {storeName: "Smart & Final", address: "3310 Vine St, Riverside, CA 92507", coords: {lat: 33.9834169, lng: -117.36502210000003}},
    {storeName: "Ralphs", address: "6155 Magnolia Ave, Riverside, CA 92506", coords: {lat: 33.9591705, lng: -117.39444279999998}},
    {storeName: "Ralphs", address: "5225 Canyon Crest Dr, Riverside, CA 92507", coords: {lat: 33.9552904, lng: -117.33018149999998}},
    {storeName: "Vons", address: "3520 Riverside Plaza Dr, Riverside, CA 92506", coords: {lat: 33.9548964, lng: -117.38940339999999}},
    {storeName: "Smart & Final Extra", address: "5202 Arlington Ave, Riverside, CA 92504", coords: {lat: 33.9446028, lng: -117.41644400000001}},
    {storeName: "Trader Joe's", address: "6225 Riverside Ave, Riverside, CA 92506", coords: {lat: 33.955921, lng: -117.38852409999998}},
    {storeName: "Albertsons", address: "2975 Van Buren Boulevard, Riverside, CA 92503", coords: {lat: 33.9099358, lng: -117.4363358}},
    {storeName: "Smart & Final Extra", address: "2744 Canyon Springs Pkwy, Riverside, CA 92507", coords: {lat: 33.9414981, lng: -117.2803836}},
    {storeName: "Sprouts Farmers Market", address: "475 E Alessandro Blvd, Riverside, CA 92508", coords: {lat: 33.9163108, lng: -117.3236306}},
];
var longBeachStores = [
    {storeName: "Northgate Gonzalez Markets", address: "4700 Cherry Ave, Long Beach, CA 90807", coords: {lat: 33.8445794, lng: -118.1670143}},
    {storeName: "Vons", address: "4550 Atlantic Ave, Long Beach, CA 90807", coords: {lat: 33.8410622, lng: -118.18280060000001}},
    {storeName: "Ralphs", address: "2250 E Carson St, Long Beach, CA 90807", coords: {lat: 33.8306903, lng: -118.16502309999998}},
    {storeName: "Albertsons", address: "101 E Willow St, Long Beach, CA 90806", coords: {lat: 33.8056952, lng: -118.19232640000001}},
    {storeName: "Ralphs", address: "3380 N Los Coyotes Diagonal, Long Beach, CA 90808", coords: {lat: 33.8181205, lng: -118.10879950000003}},
    {storeName: "Trader Joe's", address: "2222 N Bellflower Blvd, Long Beach, CA 90815", coords: {lat: 33.7967882, lng: -118.12298149999998}},
    {storeName: "Ralphs", address: "1930 N Lakewood Blvd, Long Beach, CA 90815", coords: {lat: 33.7921236, lng: -118.14142859999998}},
    {storeName: "Ralphs", address: "2930 E 4th St, Long Beach, CA 90814", coords: {lat: 33.7713424, lng: -118.1575014}},
    {storeName: "Vons", address: "600 E Broadway, Long Beach, CA 90802", coords: {lat: 33.7689188, lng: -118.18433670000002}},
    {storeName: "Ma N' Pa Grocery", address: "346 Roycroft Ave, Long Beach, CA 90814", coords: {lat: 33.7697332, lng: -118.13810330000001}},
    {storeName: "Vons", address: "3900 E Ocean Blvd, Long Beach, CA 90803", coords: {lat: 33.7597895, lng: -118.1471611}},
];
var anaheimStores = [
    {storeName: "Vons", address: "12961 W Chapman Ave, Garden Grove, CA 92840", coords: {lat: 33.7896752, lng: -117.90720379999999}},
    {storeName: "Super King Markets", address: "10500 S Magnolia Ave, Anaheim, CA 92804", coords: {lat: 33.8102723, lng: -117.97574639999999}},
    {storeName: "Vallarta Supermarkets", address: "2394 W Lincoln Ave, Anaheim, CA 92801", coords: {lat: 33.8313679, lng: -117.96720449999998}},
    {storeName: "Food 4 Less", address: "1616 W Katella Ave, Anaheim, CA 92802", coords: {lat: 33.8018771, lng: -117.9377907}},
    {storeName: "Vons", address: "130 W Lincoln Ave, Anaheim, CA 92805", coords: {lat: 33.8351714, lng: -117.91458269999998}},
    {storeName: "Walmart Neighborhood Market", address: "1120 S Anaheim Blvd, Anaheim, CA 92805", coords: {lat: 33.8194611, lng: -117.9080356}},
    {storeName: "Vons", address: "810 S State College Blvd, Anaheim, CA 92806", coords: {lat: 33.831271, lng: -117.88862499999999}},
    {storeName: "Vons", address: "5600 E Santa Ana Canyon Rd, Anaheim, CA 92807", coords: {lat: 33.8498098, lng: -117.7917195}},
    {storeName: "Ralphs", address: "711 S Weir Canyon Rd, Anaheim, CA 92808", coords: {lat: 33.8615302, lng: -117.74013150000002}},
    {storeName: "Northgate Gonzalez Markets", address: "2030 E Lincoln Ave, Anaheim, CA 92806", coords: {lat: 33.837602, lng: -117.8885368}},
    {storeName: "Wholesome Choice", address: "5755 La Palma Ave, Anaheim, CA 92807", coords: {lat: 33.8595085, lng: -117.7888251}}
];
var irvineStores = [
    {storeName: "Whole Foods Market", address: "8525 Irvine Center Dr, Irvine, CA 92618", coords: {lat: 33.6463128, lng: -117.74437080000001}},
    {storeName: "Albertsons", address: "6601 Quail Hill Pkwy, Irvine, CA 92603", coords: {lat: 33.6552144, lng: -117.77975730000003}},
    {storeName: "Albertsons", address: "4541 Campus Dr, Irvine, CA 92612", coords: {lat: 33.6501347, lng: -117.8313612}},
    {storeName: "Albertsons", address: "3825 Alton Pkwy, Irvine, CA 92606", coords: {lat: 33.6837153, lng: -117.813988}},
    {storeName: "Ralphs", address: "17605 Harvard Ave, Irvine, CA 92614", coords: {lat: 33.6773086, lng: -117.83302750000001}},
    {storeName: "Gelson's Market", address: "5521 Alton Pkwy, Irvine, CA 92618", coords: {lat: 33.6702916, lng: -117.7867501}},
    {storeName: "Village Market", address: "7020 Scholarship, Irvine, CA 92612", coords: {lat: 33.6660729, lng: -117.85317609999998}},
    {storeName: "Ralphs", address: "6300 Irvine Blvd, Irvine, CA 92620", coords: {lat: 33.6966115, lng: -117.74277599999999}},
    {storeName: "Super Irvine", address: "14120 Culver Dr, Irvine, CA 92604", coords: {lat: 33.7082775, lng: -117.782193}},
    {storeName: "Smart & Final Extra", address: "14417 Culver Dr, Irvine, CA 92604", coords: {lat: 33.7064765, lng: -117.78725550000001}},
    {storeName: "Ralphs", address: "14400 Culver Dr, Irvine, CA 92604", coords: {lat: 33.7058189, lng: -117.78607369999997}},
];

// end of california cities and grocery stores arrays
var locationSelected, storeSelected,
    mapElement = document.getElementById("map"),
    storeLists = document.getElementsByClassName("store-list"),
    sacramentoStoreList = document.getElementById("sacramento-store-list"),
    sanDiegoStoreList = document.getElementById("san-diego-store-list"),
    oaklandStoreList = document.getElementById("oakland-store-list"),
    sanFranciscoStoreList = document.getElementById("san-francisco-store-list"),
    fremontStoreList = document.getElementById("fremont-store-list"),
    berkeleyStoreList = document.getElementById("berkeley-store-list"),
    stocktonStoreList = document.getElementById("stockton-store-list"),
    sanJoseStoreList = document.getElementById("san-jose-store-list"),
    losAngelesStoreList = document.getElementById("los-angeles-store-list"),
    santaBarbaraStoreList = document.getElementById("santa-barbara-store-list"),
    riversideStoreList = document.getElementById("riverside-store-list"),
    longBeachStoreList = document.getElementById("long-beach-store-list"),
    anaheimStoreList = document.getElementById("anaheim-store-list"),
    irvineStoreList = document.getElementById("irvine-store-list");

var userInfoWindow;
var storeMarkers = [];
var storeCartName;
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
            locationSelected = this.textContent;
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
                storeMapSetup(this.textContent);
                sacramentoStoreList.style.display = "block";
                sacramentoStoreList.options[0].selected = true;
            break;
            case ($(this).text() === "Oakland, CA"):
                storeMapSetup(this.textContent);
                oaklandStoreList.style.display = "block";
                oaklandStoreList.options[0].selected = true;
            break;
            case ($(this).text() === "San Francisco, CA"):
                storeMapSetup(this.textContent);
                sanFranciscoStoreList.style.display = "block";
                sanFranciscoStoreList.options[0].selected = true;
            break;
            case ($(this).text() === "San Diego, CA"):
                storeMapSetup(this.textContent);
                sanDiegoStoreList.style.display = "block";
                sanDiegoStoreList.options[0].selected = true;
            break;
            case ($(this).text() === "Fremont, CA"):
                storeMapSetup(this.textContent);
                fremontStoreList.style.display = "block";
                fremontStoreList.options[0].selected = true;
            break;
            case ($(this).text() === "Berkeley, CA"):
                storeMapSetup(this.textContent);
                berkeleyStoreList.style.display = "block";
                berkeleyStoreList.options[0].selected = true;
            break;
            case ($(this).text() === "Stockton, CA"):
                storeMapSetup(this.textContent);
                stocktonStoreList.style.display = "block";
                stocktonStoreList.options[0].selected = true;
            break;
            case ($(this).text() === "San Jose, CA"):
                storeMapSetup(this.textContent);
                sanJoseStoreList.style.display = "block";
                sanJoseStoreList.options[0].selected = true;
            break;
            case ($(this).text() === "Los Angeles, CA"):
                storeMapSetup(this.textContent);
                losAngelesStoreList.style.display = "block";
                losAngelesStoreList.options[0].selected = true;
            break;
            case ($(this).text() === "Santa Barbara, CA"):
                storeMapSetup(this.textContent);
                santaBarbaraStoreList.style.display = "block";
                santaBarbaraStoreList.options[0].selected = true;
            break;
            case ($(this).text() === "Riverside, CA"):
                storeMapSetup(this.textContent);
                riversideStoreList.style.display = "block";
                riversideStoreList.options[0].selected = true;
            break;
            case ($(this).text() === "Long Beach, CA"):
                storeMapSetup(this.textContent);
                longBeachStoreList.style.display = "block";
                longBeachStoreList.options[0].selected = true;
            break;
            case ($(this).text() === "Anaheim, CA"):
                storeMapSetup(this.textContent);
                anaheimStoreList.style.display = "block";
                anaheimStoreList.options[0].selected = true;
            break;
            case ($(this).text() === "Irvine, CA"):
                storeMapSetup(this.textContent);
                irvineStoreList.style.display = "block";
                irvineStoreList.options[0].selected = true;
            break;
        }
    })

    //start of cityStoreSetup functions
    function storeMapSetup($selectedCity){
        $(".store-list").on("change", function(){
            switch(true){
                case ($selectedCity === "Sacramento, CA"):
                    addStoreToMap(sacramentoStores);
                break;
                case ($selectedCity === "San Francisco, CA"):
                    addStoreToMap(sanFranciscoStores);
                break;
                case ($selectedCity === "Oakland, CA"):
                    addStoreToMap(oaklandStores);
                break;
                case ($selectedCity === "San Diego, CA"):
                    addStoreToMap(sanDiegoStores);
                break;
                case ($selectedCity === "Fremont, CA"):
                    addStoreToMap(fremontStores);
                break;
                case ($selectedCity === "Berkeley, CA"):
                    addStoreToMap(berkeleyStores);
                break;
                case ($selectedCity === "Stockton, CA"):
                    addStoreToMap(stocktonStores);
                break;
                case ($selectedCity === "San Jose, CA"):
                    addStoreToMap(sanJoseStores);
                break;
                case ($selectedCity === "Los Angeles, CA"):
                    addStoreToMap(losAngelesStores);
                break;
                case ($selectedCity === "Santa Barbara, CA"):
                    addStoreToMap(santaBarbaraStores);
                break;
                case ($selectedCity === "Riverside, CA"):
                    addStoreToMap(riversideStores);
                break;
                case ($selectedCity === "Long Beach, CA"):
                    addStoreToMap(longBeachStores);
                break;
                case ($selectedCity === "Anaheim, CA"):
                    addStoreToMap(anaheimStores);
                break;
                case ($selectedCity === "Irvine, CA"):
                    addStoreToMap(irvineStores);
                break;
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

    //this function takes in all the store addresses for a given location and matches the one that is selected
    function addStoreToMap(storeArr){
        deleteMarkers();
        var $storeOptionText = $(".store-list option:selected").text();
        var firstP = $storeOptionText.indexOf("(");
        var lastP = $storeOptionText.indexOf(")");
        var $finalOptionText = $storeOptionText.substring(firstP + 1, lastP).toUpperCase();
        storeAddress = $storeOptionText.substring(firstP + 1, lastP);
        storeArr.forEach(function(store){
            var add = store.address;
            if(add.toUpperCase().lastIndexOf($finalOptionText) > -1){
                let storeName = store.storeName;
                storeCartName = storeName;
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


//when user clicks on "Deliver From Here" btn
var deliveryBtn = document.getElementById("delivery-btn"),
    deliveryBtnCaption = document.getElementById("delivery-btn-caption"),
    locationStoreContainer = document.getElementById("location-and-store-container"),
    cartLocation = document.getElementById("cart-location"),
    cartStoreName = document.getElementById("cart-store-name"),
    cartStoreAddress = document.getElementById("cart-store-address");

deliveryBtn.addEventListener("click", function(e){
    $("#cart-location").add("#cart-store-name").add("#cart-store-address").text("");
    e.preventDefault();
    if(locationSelected == undefined || storeAddress == undefined){
        deliveryBtnCaption.style.display = "block";
        return;
    } else {
        deliveryBtnCaption.style.display = "none";
        locationStoreContainer.style.display = "grid";
        locationText = document.createTextNode(locationSelected);
        addressText = document.createTextNode(storeAddress);
        storeNameText = document.createTextNode(storeCartName);
        cartLocation.appendChild(locationText);
        cartStoreName.appendChild(storeNameText);
        cartStoreAddress.appendChild(addressText);
    }
})

    







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
