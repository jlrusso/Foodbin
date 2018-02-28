var imageContainer = document.getElementById("image-container"),
 		inputFileElement = document.getElementById("file-input"),
 		changePicBtn = document.getElementById("change-pic-btn"),
		uploadPicBtn = document.getElementById("upload-pic-btn");
changePicBtn.addEventListener("click", function(){
	inputFileElement.click();
	changePicBtn.style.display = "none";
	uploadPicBtn.style.display = "block";
})

uploadPicBtn.addEventListener("click", function(){
	changePicBtn.style.display = "block";
	uploadPicBtn.style.display = "none";
})

/*--- Start of User Icon JS --*/
    var userIcon = document.getElementsByClassName("fa-user")[0],
        userList = document.getElementsByClassName("user-list")[0];
        username = document.getElementById("user");
        userParent = document.getElementById("user-parent");
        if(userIcon){
            userIcon.addEventListener("click", function(){
                userList.classList.toggle("show-user-list");
            });
        }

    window.addEventListener("click", function(e){
        if(userIcon){
            if(!e.target.matches(".fa-user")){
                if(userList.classList.contains("show-user-list")){
                    userList.classList.remove("show-user-list");
                }
            }
        }
    });

    userParent.addEventListener("click", function(){
      user.click();
    })
/*--- End of User Icon JS ---*/

/*--- When user clicks order completed btn ---*/
var currentOrderRow = document.getElementById("current-order-row");
var eraseOrderBtn = document.getElementById("erase-order-btn");
if(currentOrderRow){
  var entireOrdersSection = document.getElementsByClassName(".col-8")[0],
      currentOrderHeading = document.getElementById("current-order-heading"),
      currentOrderOuter = document.getElementById("current-order-outer"),
      currentOrderDestination = document.getElementsByClassName(".location-address-name-container")[0],
      orderCompletedBtn = document.getElementById("order-completed-btn");
}
var previousOrdersContainer = document.getElementById("previous-orders-container");
var previousOrdersHeading = document.getElementById("previous-orders-heading");
var previousOrderFooter;

if(orderCompletedBtn) {
  orderCompletedBtn.addEventListener("click", function(){
    localStorage.setItem("order-in-progress", "no");
    removeCurrentOrder();
  });
}
//
// function addPreviousOrderToContainer(){
//   var previousOrderOuter = document.createElement("div");
//   previousOrderOuter.setAttribute("class", "previous-order-outer");
//   var previousOrderLocation = document.createElement("div");
//   previousOrderLocation.setAttribute("class", "store-location-container");
//   copyCurrentStoreLocation(previousOrderLocation);
//   var previousOrderRow = document.createElement("div");
//   previousOrderRow.setAttribute("class", "previous-order-row");
//   copyCurrentOrderToPrevious(previousOrderOuter, previousOrderRow);
//   previousOrderOuter.appendChild(previousOrderLocation);
//   previousOrderOuter.appendChild(previousOrderRow);
//   createPreviousOrderFooter(previousOrderOuter);
//   copyLineDividerToPreviousOrder(previousOrderOuter);
//   previousOrdersContainer.appendChild(previousOrderOuter);
//   previousOrdersContainer.style.display = "block";
//   removeCurrentOrder();
// }
//
// function createPreviousOrderFooter(previousOrderOuter){
//   var previousOrderFooter = document.createElement("div");
//   previousOrderFooter.setAttribute("class", "previous-order-footer");
//   createFooterBtns(previousOrderFooter);
//   previousOrderOuter.appendChild(previousOrderFooter);
// }
//
// function createFooterBtns(previousOrderFooter){
//   var orderAgainBtn = document.createElement("button");
//   orderAgainBtn.setAttribute("class", "order-again-btn");
//   var orderAgainTxt = document.createTextNode("Order Again");
//   orderAgainBtn.appendChild(orderAgainTxt);
//   var removeOrderBtn = document.createElement("button");
//   removeOrderBtn.setAttribute("class", "remove-order-btn");
//   var removeOrderTxt = document.createTextNode("Remove Order");
//   removeOrderBtn.appendChild(removeOrderTxt);
//   previousOrderFooter.appendChild(orderAgainBtn);
//   previousOrderFooter.appendChild(removeOrderBtn);
// }
//
// function copyCurrentOrderToPrevious(previousOrderOuter, previousOrderRow){
//   $("#current-order-outer").find(".store-location-container").clone().appendTo(previousOrderOuter);
//   $("#current-order-row").find(".order-item").clone().appendTo(previousOrderRow);
// }
//
// function copyCurrentStoreLocation(previousOrderLocation){
//   $("#current-order-outer").children(".store-location-container").find("div").clone().appendTo(previousOrderLocation);
// }
//
// function copyLineDividerToPreviousOrder(previousOrderOuter){
//   $("#current-order-outer").find(".line-divider").clone().appendTo(previousOrderOuter);
// }

function removeCurrentOrder(){
  $("#current-order-outer").add("#current-order-heading").animate({
    height: "0px"
  }, 1000, function(){
    setTimeout(function(){
      eraseOrderBtn.click();
      $(this).remove();
    }, 50)
  })
}

/*--- End of 'order completed' btn click ---*/


/*--- Set the Width of itemListInner based on number of items in the order row ---*/

var ordersContainer = document.getElementById("all-orders-container");

/*--- End of Setting width of itemListInner ---*/
