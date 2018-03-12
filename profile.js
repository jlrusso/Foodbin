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
/*--- End of User Icon JS ---*/

/*--- Check if Order is in Progress ---*/
var orderInProgress = document.getElementById("order-in-progress"),
    orderInProgressVal;
if(orderInProgress){
  orderInProgressVal = orderInProgress.textContent;
}
/*--- End of Order in Progress Check ---*/

/*--- Check if Order is being Editted ---*/
var editInProgress = document.getElementById("edit-in-progress"),
    editInProgressVal;
if(editInProgress){
  editInProgressVal = editInProgress.textContent;
}
/*--- End of Edit Order Check ---*/

/*--- Check if Same Order in Progress ---*/
var sameOrderInProgress = document.getElementById("same-order-in-progress"),
    sameOrderInProgressVal;
if(sameOrderInProgress){
  sameOrderInProgressVal = sameOrderInProgress.textContent;
}
/*--- Check if Same Order in Progress ---*/

/*--- When user clicks order completed btn ---*/
var currentOrderRow = document.getElementById("current-order-row");
var currOrderTooltip = document.getElementById("curr-order-tooltip");
var completeOrderSubmit = document.getElementById("complete-order-submit");
if(currentOrderRow){
  var entireOrdersSection = document.getElementsByClassName(".col-8")[0],
      currentOrderHeading = document.getElementById("current-order-heading"),
      currentOrderOuter = document.getElementById("current-order-outer"),
      currentOrderDestination = document.getElementsByClassName(".location-address-name-container")[0],
      orderCompletedBtn = document.getElementById("order-completed-btn");
}
var previousOrdersContainer = document.getElementById("previous-orders-container");
var previousOrdersHeading = document.getElementById("previous-orders-heading");
var previousOrderRows = document.getElementsByClassName("previous-order-row");
var prevOrderTooltips = document.getElementsByClassName("prev-order-tooltip");
var previousOrderFooter;
var orderType;

/*--- Show Sideways Scroll Tooltip ---*/
if(currentOrderRow){
  currentOrderRow.addEventListener("mouseover", function(){
    currOrderTooltip.style.opacity = "1";
  })
  currentOrderRow.addEventListener("mouseout", function(){
    currOrderTooltip.style.opacity = "0";
  })
}

if(previousOrderRows){
  for(let i = 0; i < previousOrderRows.length; i++){
    previousOrderRows[i].addEventListener("mouseover", function(){
      prevOrderTooltips[i].style.opacity = "1";
    })

    previousOrderRows[i].addEventListener("mouseout", function(){
      prevOrderTooltips[i].style.opacity = "0";
    })
  }
}
/*--- End of Sideways Scroll Tooltip ---*/

function removeCurrentOrder(){
  $("#current-order-outer").add("#current-order-heading").animate({
    height: "0px"
  }, 1000, function(){
    setTimeout(function(){
      if(orderType == "edit"){
        editOrderSubmit.click();
      } else if (orderType == "complete") {
        completeOrderSubmit.click();
      } else if (orderType == "cancel"){
        cancelOrderSubmit.click();
      }
      $(this).remove();
    }, 50)
  })
}

var modalWindows = document.getElementsByClassName("modal-window");
var closeBtnContainer = document.getElementById("close-btn-container");

/*--- When user clicks Completed Btn ---*/
if(orderCompletedBtn) {
  orderCompletedBtn.addEventListener("click", function(){
    orderType = "complete";
    removeCurrentOrder();
  });
}
/*--- End of 'Completed' btn click ---*/

/*--- When user clicks 'Edit Order' Btn ---*/
var editOrderBtn = document.getElementById("edit-order-btn");
var editOrderSubmit = document.getElementById("edit-order-submit");
if(editOrderBtn){
  editOrderBtn.addEventListener("click", function(){
    orderType = "edit";
    removeCurrentOrder();
  });
}
/*--- End of Edit Order Function ---*/

/*--- User clicks "Cancel" Btn ---*/
var cancelOrderBtn = document.getElementById("cancel-order-btn"),
    cancelOrderSubmit = document.getElementById("cancel-order-submit");
if(cancelOrderBtn){
  cancelOrderBtn.addEventListener("click", function(){
    modalWindows[1].style.display = "block";
    $("#close-btn-container").css("display", "block");
    $(".modal-window").eq(1).append($closeContainer);
  })
}
/*--- End of "Cancel" Btn click ---*/

/*--- User clicks "Yes" or "No" on Cancel ---*/
var yesCancelBtn = document.getElementById("yes-cancel-btn"),
    noCancelBtn = document.getElementById("no-cancel-btn");
yesCancelBtn.addEventListener("click", function(){
  modalWindows[1].style.display = "none";
  orderType = "cancel";
  removeCurrentOrder();
})
noCancelBtn.addEventListener("click", function(){
  modalWindows[1].style.display = "none";
})
/*--- End of "Yes" or "No" click ---*/

/*--- When user clicks profile "Edit" btn  ---*/
var editBtn = document.getElementById("edit-btn");
editBtn.addEventListener("click", function(){
  modalWindows[0].style.display = "block";
  $(".modal-window").eq(0).append(closeBtnContainer);
  closeBtnContainer.style.display = "block";
})

window.onclick = function(e){
  if(e.target.matches(".modal-window") || e.target.matches("#close-btn-container") || e.target.matches("#modal-close-btn")){
    modalWindows[0].style.display = "none";
    modalWindows[1].style.display = "none";
    closeBtnContainer.style.display = "none";
  }
}
/*--- End of profile "Edit" btn click ---*/


/*--- When user clicks 'Order Again' Btn ---*/
var orderAgainBtns = document.getElementsByClassName("order-again-btn");
for(let i = 0; i < orderAgainBtns.length; i++){
  orderAgainBtns[i].addEventListener("click", function(e){
    var $orderAgainSubmitBtn = $(this).siblings(".order-again-form").find(".order-again-submit-btn");
    if(orderInProgressVal == "yes" || editInProgressVal == "yes"){
      e.preventDefault();
      alert("Complete current order before ordering again");
    } else {
      $orderAgainSubmitBtn.click();
    }
  })
}
/*--- End of Order Again Function ---*/

/*--- When user clicks 'Remove Order' Btn ---*/
var removeOrderBtns = document.getElementsByClassName("remove-order-btn");
for(let i = 0; i < removeOrderBtns.length; i++){
  removeOrderBtns[i].addEventListener("click", function(){
    var $rmOrderSubmitBtn = $(this).siblings(".remove-prev-form").find(".remove-order-submit-btn");
    var $wholePrevOrder = $(this).parents(".previous-order-inner");
    removeThisPrevOrder($wholePrevOrder, $rmOrderSubmitBtn);
  })
}

function removeThisPrevOrder($order, $btn){
  $order.animate({
    height: "0px"
  }, 1000, function(){
    $order.css("display", "none");
    $btn.click();
  })
}
/*--- End of Remove Order Function ---*/
