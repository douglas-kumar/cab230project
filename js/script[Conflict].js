document.getElementById('regform').addEventListener("sumbmit", function (e) {
    e.preventDefault(); // Prevents form from submitting
    // TODO: Validate input then submit form if all is good
    // document.getElementById("regform").submit();
});

function EnableSearchBtn() {
	var textField = document.getElementById("searchtext").value;
	var checkedBox = document.getElementsByName("rating").value;
	if (textField != "" || checkedBox != "") {
		document.getElementById("searchBtn").disabled = false;
	} else {
		document.getElementById("searchBtn").disabled = true;
	}
}

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
	var expr = /[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}/; // THIS DOESN'T WORK YET

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


function openReview() {
	document.getElementById("reviewwrite").innerHTML = '<form><textarea rows="3" placeholder="Your review..."></textarea><br /><input type="submit" value="Post"></form>';
	document.getElementById("writebutton").remove();
}

//   Geo Location

function getLocation() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition, showError);
	} else {
		document.getElementById("status").innerHTML = "Geolocation is not supported by this browser.";
	}
}

function showPosition(position) {
	document.getElementById("status").innerHTML = "Latitude: " + position.coords.latitude + ", Longitude: " + position.coords.longitude;

	// display on a map
	var latlon = position.coords.latitude + "," + position.coords.longitude;
	var img_url = "http://maps.googleapis.com/maps/api/staticmap?center=" + latlon + "&zoom=14&size=400x300&sensor=false";
	document.getElementById("mapholder").innerHTML = "<img src='" + img_url + "'>";

}

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