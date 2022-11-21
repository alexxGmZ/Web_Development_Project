function showOrHidePassword() {
	var x = document.getElementById("login_password");
	if (x.type === "password") {
		x.type = "text";
	} 
	else {
		x.type = "password";
	}
}