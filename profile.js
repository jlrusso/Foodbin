var imageContainer = document.getElementById("image-container");
var uploadTooltip = document.getElementById("upload-tooltip");
var imageInputElement = document.createElement("input");
var inputFileElement = document.getElementById("file-input");
var addImageBtn = document.getElementById("add-image-btn");
addImageBtn.addEventListener("click", function(){
	inputFileElement.click();
	uploadTooltip.style.display = "block";
})

imageContainer.addEventListener("click", function(){
	if(uploadTooltip.style.display === "block"){
		var imagePath = inputFileElement.value;
		var imageExt = imagePath.substring(imagePath.lastIndexOf("h") + 2, imagePath.length);
		imageInputElement.setAttribute("type", "image");
		imageInputElement.setAttribute("src", "../img/" + imageExt + " ");
		imageInputElement.classList.add("input-style");
		imageContainer.appendChild(imageInputElement);
		uploadTooltip.style.display = "none";
	}
})

/*--- Start of User Icon JS --*/
    var userIcon = document.getElementsByClassName("fa-user")[0],
        userList = document.getElementsByClassName("user-list")[0];
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


/*--- Start of User Info JS ---*/


/*--- End of User Info JS ---*/