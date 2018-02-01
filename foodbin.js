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
        $(".close-btn-container").css("display", "block");
        modalWindows[i].appendChild(closeContainer);
        modalWindows[i].style.display = "block";
        $(".middle-column").add(".last-column").css("display", "block");
        row[i].appendChild(middleColumn);
        row[i].appendChild(lastColumn);
    })
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
var cartContainer = document.getElementById("cart-container");
var cartIconBox = document.getElementById("cart-icon-box"),
    cartModalWindow = document.getElementById("cart-modal-window"),
    cartCloseContainer = document.getElementById("cart-close-container");

//display cart modal window when cart icon box is clicked
cartContainer.addEventListener("click", function(e){
    if(e.target.matches("#cart")){
        console.log("container clicked");
        cartModalWindow.style.display = "block";
    }
    cartModalWindow.style.display = "block";
})

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




/*--- Initialize Google Maps API ---*/
var locationInputField = document.getElementById("location-input-field"),
searchListGroup = document.getElementById("search-list-group"),
searchListItem = document.querySelectorAll("#search-list-group li"),
userLocation, userCoords;

locationInputField.addEventListener("click", function(){
    if(searchListGroup.style.height !== "215px"){
        searchListGroup.style.height = "215px";
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
    {location: "San Francisco, CA", coords:{lat: 37.774929, lng: -122.419416}},
    {location: "Las Vegas, NV", coords: {lat: 36.169941, lng: -115.139830}},
    {location: "New York, CA", coords: {lat: 40.712775, lng: -74.005973}},
    {location: "Chicago, IL", coords: {lat: 41.878114,lng: -87.629798}},
    {location: "Dallas, TX", coords: {lat: 32.776664,lng: -96.796988}},
    {location: "Seattle, WA", coords: {lat: 47.606209,lng: -122.332071}},
    {location: "Houston, TX", coords: {lat: 29.760427,lng: -95.369803}},
    {location: "Boston, MS", coords: {lat: 42.360082,lng: -71.058880}},
    {location: "Washington, D.C.", coords: {lat: 38.907192,lng: -77.036871}},
    {location: "San Antonio, TX", coords: {lat: 29.424122,lng: -98.493628}},
    {location: "Phoenix, AZ", coords: {lat: 33.448377,lng: -112.074037}},
    {location: "San Diego, CA", coords: {lat: 32.715738,lng: -117.161084}},
    {location: "Philadelphia, PN", coords: {lat: 39.952584,lng: -75.165222}},
    {location: "Austin, TX", coords: {lat: 30.267153,lng: -97.743061}},
    {location: "Denver, CO", coords: {lat: 39.739236,lng: -104.990251}},
    {location: "Nashville, TN", coords: {lat: 36.162664,lng: -86.781602}},
    {location: "Indianapolis, IN", coords: {lat: 39.768403,lng: -86.158068}},
    {location: "Milwaukee, WI", coords: {lat: 43.038902,lng: -87.906474}},
    {location: "San Jose, CA", coords: {lat: 37.338208,lng: -121.886329}},
    {location: "Baltimore, MD", coords: {lat: 39.290385,lng: -76.612189}},
    {location: "Charlotte, NC", coords: {lat: 35.227087,lng: -80.843127}},
    {location: "Detroit, MI", coords: {lat: 42.331427,lng: -83.045754}},
    {location: "Minneapolis, MN", coords: {lat: 44.977753,lng: -93.2650}},
    {location: "Riverside, CA", coords: {lat: 33.9533, lng: -117.3962}}
];

var mapElement = document.getElementById("map");

function initMap(){
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
                    createMapObject(10, userLocation, userCoords);
                }
            });
            $("#search-list-group").animate({
                scrollTop: $("li:contains(" + thisItem + ")").offset().top - $("#search-list-group").offset().top + $("#search-list-group").scrollTop()
            }, "500");
            console.log($("#search-list-group").scrollTop());
        });
    };

    //default map zoom and center values
    function options1(){
        return {
            zoom: 4,
            center: {lat: 39.0997, lng: -94.5786}
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
        addMarker(userLocation, coords);   
        //addMarker(userLocation, coords); 
    }

    //adds marker based on user location input and the coordinates for the city name
    function addMarker(userLocation, userCoordinates){
        var marker = new google.maps.Marker({
            map: mapInstance2,
            label: userLocation[0],
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
}; //end of initMap function
/*--- End of Google Maps API ---*/

$(window).on('beforeunload', function() {
   $(window).scrollTop(0);
});


$("#search-case-list a").on("click", function(e){
    e.preventDefault();
});




/*--- Add Item to Cart with Add Btn ---*/
var addToCartBtns = document.getElementsByClassName("add-to-cart-btn");
var priorityNumForm = document.getElementById("priority-num-form");
var selectorForm = document.getElementById("selector-form");
var $cartBadgeNum = $("#cart:after");
$cartBadgeNum.css("background-color", "green");
var modalInnerImageHeadings = document.getElementsByClassName("modal-inner-image-heading");
var modalImages = document.getElementsByClassName("modal-image");
var gotHeading;
var cartItems = 0;
var placeOrderBtn = document.getElementById("place-order-btn");
var noGroceriesAdded = document.getElementById("no-groceries-added");

for(let i = 0; i < addToCartBtns.length; i++){
    addToCartBtns[i].addEventListener("click", function(){
        var modalWindow = this.parentElement.parentElement.parentElement;
        var $modalContainer = $(this).parents(".modal-inner-container"),
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
                var $currModalFooter = modalInnerFooter[i];
                $currModalFooter.prepend(samePriorityError);
                samePriorityError.style.display = "block";
                return false;
            }


            itemImageSrc = modalImages[i].getAttribute("src");
            gotHeading = modalInnerImageHeadings[i].textContent;
            createCartItem(
                gotHeading, itemImageSrc, $weightSelectorValue, $weightNumVal, $costSelectorValue, $costNumVal, $specialtySelectorValue, $specialtyNumVal, $qualitySelectorValue, $qualityNumVal
            );
            cartItems++;
            $cartBadgeNum.css("background-color", "green");
            priorityNumForm.reset();
            selectorForm.reset();
            modalWindow.style.display = "none";            
    })
}
/*--- End of Add Btn to Cart ---*/

function createCartItem(heading, imageSrc, weight, weightP, cost, costP, specialty, specialtyP, quality, qualityP){
    var cartContent = document.getElementById("cart-modal-content");
    var newCartRow = document.createElement("div");
    newCartRow.classList.add("cart-row");
    var pictureColumn = document.createElement("div");
    pictureColumn.classList.add("cart-col-4");
    pictureColumn.classList.add("picture-column");
    var newImage = document.createElement("input");
    newImage.setAttribute("type", "image");
    newImage.setAttribute("src", imageSrc);
    pictureColumn.appendChild(newImage);
    

    var newMidCol = document.createElement("div");
    newMidCol.classList.add("cart-col-4");
    newMidCol.classList.add("heading-and-details");
    var newHead = document.createElement("h4");
    newHead.classList.add("cart-modal-food-heading");
    newHead.textContent = heading;
    newMidCol.appendChild(newHead);

    var newListGroup = document.createElement("ul");
    newListGroup.classList.add("food-item-details");

    var listItem1 = document.createElement("li");
    var listText1 = document.createTextNode("Weight: " + weight + ", Priority: " + weightP);
    listItem1.appendChild(listText1);
    newListGroup.appendChild(listItem1);

    var listItem2 = document.createElement("li");
    var listText2 = document.createTextNode("Cost: " + cost + ", Priority: " + costP);
    listItem2.appendChild(listText2);
    newListGroup.appendChild(listItem2);

    var listItem3 = document.createElement("li");
    var listText3 = document.createTextNode("Specialty: " + specialty + ", Priority: " + specialtyP);
    listItem3.appendChild(listText3);
    newListGroup.appendChild(listItem3);

    var listItem4 = document.createElement("li");
    var listText4 = document.createTextNode("Quality: " + quality + ", Priority: " + qualityP);
    listItem4.appendChild(listText4);
    newListGroup.appendChild(listItem4);

    newMidCol.appendChild(newListGroup);

    var newLastCol = document.createElement("div");
    newLastCol.classList.add("cart-col-4");
    var btnContainer = document.createElement("div");
    btnContainer.classList.add("cart-item-btn-container");
    var btn1 = document.createElement("button");
    btn1.classList.add("make-changes-btn");
    btn1.textContent = "Make Changes";
    var btn2 = document.createElement("button");
    btn2.classList.add("remove-item-btn");
    btn2.textContent = "Remove Item";
    btnContainer.appendChild(btn1);
    btnContainer.appendChild(btn2);
    newLastCol.appendChild(btnContainer);

    var lineDivider = document.createElement("div");
    lineDivider.classList.add("line-divider")

    newCartRow.appendChild(pictureColumn);
    newCartRow.appendChild(newMidCol);
    newCartRow.appendChild(newLastCol);
    cartContent.appendChild(newCartRow);
    cartContent.appendChild(lineDivider);
    placeOrderBtn.style.display = "block";
    noGroceriesAdded.style.display = "none";

}

$(".banner-btn").click(function(){
    $("html, body").animate({
        scrollTop: $("#user-location-section").offset().top - 19
    }, "slow");
})

$("#ca-locations a").click(function(e){
    e.preventDefault();
    $("html, body").animate({
        scrollTop: $("#user-location-section").offset().top - 20
    });
})