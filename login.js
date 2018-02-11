window.onload = function(){
	var usernameField = document.getElementById("username-field");
	usernameField.focus();
}
var loginForm = document.getElementById("login-form");
var pwdField = document.getElementById("password-field");
var loginBtn = document.getElementById("login-btn");
pwdField.addEventListener("keypress", function(e){
	if(e.keyCode == 13){
		e.preventDefault();
		loginBtn.click();
	}
})