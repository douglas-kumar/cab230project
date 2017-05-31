
// hides any errors that show when registering an account
function hideError(element) {
	document.getElementById(element).innerHTML = "";
}

function checkNames(form) {
	var expr = /[A-z]+/;

	if (expr.test(form.firstname.value) && expr.test(form.lastname.value)) {
		return true;
	} else {
		document.getElementById("nameerror").innerHTML = "Name(s) entered not valid";
		return false;
	}
}

function checkDob(form) {
	var expr1 = /^([0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4})$/;

	var expr = /^(0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])[\/\-]\d{4}$/;

	if (expr.test(form.dob.value)) {
		return true;
	} else {
		document.getElementById("doberror").innerHTML = "Invalid date of birth";
		return false;
	}
}

function checkAddress(form) {
	var expr = /[0-9]+\s[A-z]+/;

	if (expr.test(form.address.value)) {
		return true;
	} else {
		document.getElementById("addresserror").innerHTML = "Invalid address";
		return false;
	}
}

function checkState(form) {
	if (form.state.value == "") {
		document.getElementById("stateerror").innerHTML = "Please select the state you live in";
		return false;
	} else {
		return true;
	}
}

function checkPostcode(form) {
	var expr = /^([0-9]{4})$/;

	if (expr.test(form.postcode.value)) {
		return true;
	} else {
		document.getElementById("postcodeerror").innerHTML = "Invalid postcode";
		return false;
	}
}

function checkPassword(form) {
	if (form.pwd.value == form.cpwd.value) {
		return true;
	} else {
		document.getElementById("passworderror").innerHTML = "Passwords do not match";
		return false;
	}
}

function ValidateRegistration(form) {
	if (checkNames(form) && checkAddress(form) && checkState(form) && checkPostcode(form) && checkPassword(form)) {
		window.alert("You have successfully signed up!");
		return true;
	} else {
		document.getElementById("signupfail").innerHTML = "Registration failed, please check entered data";
		return false;
	}
}

function ValidLogin(form) {
	if (checkAddress(form) && checkPassword(form)) {
		window.alert("Logging in...");
		return true;
	} else {
		document.getElementById("loginfail").innerHTML = "Log in failed, make sure your email address and password is correct";
		return false;
	}
}

function openReview() {
	document.getElementById("reviewwrite").innerHTML = '<textarea name="text" minlength="20" maxlength="200" rows="5" placeholder="Your review..."></textarea><br /><label id="ratingLbl">Rating:</label><div id="ratingVal"><input type="range" name="rating" min="1" max="5"><div id="r1">1*</div><div id="r2">2*</div><div id="r3">3*</div><div id="r4">4*</div><div id="r5">5*</div></div><br /><input type="submit" name="submit" value="Post"/>';
	document.getElementById("writebutton").remove();
}

//   Geo Location
function getLocation() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition, showError);
		document.getElementById("status").innerHTML = "Locating, please wait...";
	} else {
		document.getElementById("status").innerHTML = "Geolocation is not supported by this browser.";
	}
}

function showPosition(position) {
	var lat = position.coords.latitude.toPrecision(9);
	var long = position.coords.longitude.toPrecision(9);
		
	document.getElementById('lat').value = lat;
	document.getElementById('long').value = long;
	
    document.getElementById('searchBtn').click();
}

// Function to throw an error if locational services are unavailable
function showError(error) {
	var msg = "";
	switch (error.code) {
		case error.PERMISSION_DENIED:
			msg = "User denied the request for Geolocation."
			break;
		case error.POSITION_UNAVAILABLE:
			msg = "Location information is unavailable."
			break;
		case error.TIMEOUT:
			msg = "The request to get user location timed out."
			break;
		case error.UNKNOWN_ERROR:
			msg = "An unknown error occurred."
			break;
	}
	document.getElementById("status").innerHTML = msg;
}