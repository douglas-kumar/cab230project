<?php

$errors = [];

function error_messages(&$errors, $message) {
    array_push($errors, $message);
}

function charOnly($str, $message) {
    global $errors;
    if (!preg_match('/^[a-zA-Z ]*$/', $str)) {
        error_messages($errors, $message);
    }
}

function validateName($name) {
	global $errors;
	$len = strlen($name);
	if ($len < 2 || $len > 30) {
		error_messages($errors, "Names must have at least 2, but no more than 30 characters");
	}
	charOnly($name, "Names must only contain letters");
}

function validateDob($dob) {
	global $errors;
	$regex = '/^(19|20)\d\d[-/](0[1-9]|1[012])[-/](0[1-9]|[12][0-9]|3[01])$/';
	if (!preg_match($regex, $dob)) {
		error_messages($errors, "Invalid date of birth");
	}
}

function validateEmail($email) {
	global $errors;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        error_messages($errors, "Invalid email format");
    }
}

function validateAddress($address) {
	global $errors;
	$regex = '/[0-9]+\s[A-z]+/';
	if (!preg_match($regex, $address)) {
		error_messages($errors, "Invalid address entered");
	}
}

function validateState($state) {
	global $errors;
	if ($state == "") {
		error_messages($errors, "No state selected");
	}
}

function validatePostcode($postcode) {
	global $errors;
	$regex = '/^([0-9]{4})$/';
	if (!preg_match($regex, $postcode)) {
		error_messages($errors, "Invalid postcode entered");
	}
}

function passwordsValid($pwd1, $pwd2) {
	global $errors;
	$len = strlen($pwd1);
	if ($len < 8) {
		error_messages($errors, "Password must be at least 8 characters long");
	}
	if ($pwd1 != $pwd2) {
		error_messages($errors, "Passwords do not match");
	}
}

function getParkName($park_name) {
	global $errors;
	global $database;
	$query = "SELECT name FROM items WHERE name = :name";
	
	$stmt = $database->prepare($query);
	
	$stmt->bindParam(":name", $park_name);
	$stmt->execute();
	
	if ($stmt->rowCount() > 0) {
			return $stmt->fetch();
	} else {
			return $errorMessages($errors, "Invalid park name");
	}
	
}

function validatePost($text) {
	global $database;
	global $errors;
	date_default_timezone_set("Australia/Brisbane");

	
	$userId = 0;
	$itemId = 0;
	$rating = 1;
	$dateTime = date("Y-m-d H:i:s");
	
	$query = "INSERT INTO reviews (userId, itemId, rating, text, dateTime) VALUES (:userId, :itemId, :rating, :text, :dateTime)";
	
	$stmt = $database->prepare($query);
				
	$stmt->bindParam(':userId', $userId);
	$stmt->bindParam(':itemId', $itemId);
	$stmt->bindParam(':rating', $rating);
	$stmt->bindParam(':text', $text);
	$stmt->bindParam(':dateTime', $dateTime);
	
	$stmt->execute();
				
	if ($stmt->rowCount() > 0) {
		return true;
    } else {
		errorMessages($errors, "Cannot validate review, please make sure it's under 100 characters and not empty");
		return false;
	}
	
}

function get_salt($email) {
    global $database;
    $query = "SELECT salt FROM members WHERE email = :email";
    $stmt = $database->prepare($query);

    $stmt->bindParam(":email", $email);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        return $stmt->fetch();
    }
}

function login($email, $password) {
    global $errors;
    global $database;
    $query = "SELECT 1 FROM members WHERE email = :email AND password = :password";
    $stmt = $database->prepare($query);

    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $password);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        return true;
    } else {
        error_messages($errors, "Username and password combination is incorrect");
        return false;
    }
}

function enforceLogin() {
	if (!$_SESSION['loggedIn']) {
		header("location: http://{$_SERVER['HTTP_HOST']}/cab230project/login.php");
		}
}

?>