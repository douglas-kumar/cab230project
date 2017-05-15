/*document.getElementById('regform').addEventListener("submit", function (e) {
	e.preventDefault(); // Prevents form from submitting
	// TODO: Validate input then submit form if all is good
	// document.getElementById("regform").submit();
});*/

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

// Function needs to be properly implemented
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
	document.getElementById("reviewwrite").innerHTML = '<form><textarea rows="3" placeholder="Your review..."></textarea><br /><input type="submit" value="Post"></form>';
	document.getElementById("writebutton").remove();
}

function myMap() {
  var mapOptions1 = {
    center: new google.maps.LatLng(51.508742,-0.120850),
    zoom: 9 ,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  var mapOptions2 = {
    center: new google.maps.LatLng(-27.36,153.0387),
    zoom: 12,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  var mapOptions3 = {
    center: new google.maps.LatLng(-27.3791,153.0387),
    zoom: 15,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  var map1 = new google.maps.Map(document.getElementById("googleMap1"),mapOptions1);
  var map2 = new google.maps.Map(document.getElementById("googleMap2"),mapOptions2);
  var map3 = new google.maps.Map(document.getElementById("googleMap3"),mapOptions3);
}

//   Geo Location

function getLocation() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition, showError);
	} else {
		document.getElementById("status").innerHTML = "Geolocation is not supported by this browser.";
	}
	/*var showMap = document.getElementById("googleMap1");
	showMap.style.visibility = "visible";
	showMap.style.width = "100%";
	showMap.style.height = "400px";*/
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