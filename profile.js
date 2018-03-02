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

/*--- When user clicks edit btn ---*/
var editBtn = document.getElementById("edit-btn"),
    editModalWindow = document.getElementById("modal-window"),
    closeBtnContainer = document.getElementById("close-btn-container");
editBtn.addEventListener("click", function(){
  editModalWindow.style.display = "block";
  closeBtnContainer.style.display = "block";
})
/*--- end of user clicks edit btn ---*/

window.onclick = function(e){
  if(e.target.matches("#modal-window") || e.target.matches("#close-btn-container") || e.target.matches("#modal-close-btn")){
    editModalWindow.style.display = "none";
    closeBtnContainer.style.display = "none";
  }
}

/*--- Set the Width of itemListInner based on number of items in the order row ---*/

var ordersContainer = document.getElementById("all-orders-container");

/*--- End of Setting width of itemListInner ---*/
