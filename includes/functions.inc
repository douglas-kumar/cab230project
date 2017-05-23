<?php

$errors = [];

function error_messages(&$errors, $message) {
    array_push($errors, $message);
}

function charOnly($str) {
    global $errors;
    if (!preg_match('/^[a-zA-Z ]*$/', $str)) {
        return false;
    } else {
		return true;
	}
}

function validateNames($fname, $lname) {
	global $errors;
	$flen = strlen($fname);
	$llen = strlen($lname);
	if (($flen < 2 || $flen > 30) || ($llen < 2 || $llen > 30)) {
		error_messages($errors, "Names must have at least 2, but no more than 30 characters");
	}
	
	if ((!charOnly($fname)) || (!charOnly($lname))) {
		error_messages($errors, "Names must only contain letters");
	} 
}

function validateDob($dob) {
	global $errors;
	$regex = '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/';
	if (!preg_match($regex, $dob)) {
		error_messages($errors, "Invalid date of birth, required format: YYYY-MM-DD");
	}
}

function validateEmail($email) {
	global $errors;
	global $database;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        error_messages($errors, "Invalid email format");
    }

	$query = "SELECT * FROM members WHERE email = :email";
	$stmt = $database->prepare($query);
	$stmt->bindParam(":email", $email);
	$stmt->execute();

	if ($stmt->rowCount() > 0) {
		error_messages($errors, "That email address has already been used by another member, choose another");
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
			return $error_messages($errors, "Invalid park name");
	}
	
}

function validatePost($text) {
	global $database;
	global $errors;
	date_default_timezone_set("Australia/Brisbane");

	
	$memberId = 6;
	$itemId = 0;
	$rating = 3;
	$dateTime = date("Y-m-d H:i:s");
	
	//Change to INSERT INTO
	$query = "REPLACE reviews (memberId, itemId, rating, text, dateTime) VALUES (:memberId, :itemId, :rating, :text, :dateTime)";
	
	$stmt = $database->prepare($query);
				
	$stmt->bindParam(':memberId', $memberId);
	$stmt->bindParam(':itemId', $itemId);
	$stmt->bindParam(':rating', $rating);
	$stmt->bindParam(':text', $text);
	$stmt->bindParam(':dateTime', $dateTime);
	
	$stmt->execute();
				
	if ($stmt->rowCount() > 0) {
		return true;
    } else {
		error_messages($errors, "Cannot validate review, please make sure it's under 100 characters and not empty");
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

function getReviews() {
	global $database;
	global $errors;
	
	$query = "SELECT * FROM reviews; //M.firstName, R.* FROM reviews AS R INNER JOIN members AS M ON M.id = R.memberId";
	$stmt = $database->prepare($query);
	$stmt->execute();
	
	if ($stmt->rowCount() > 0) {
		return $stmt->fetchAll();
	} else {
		error_messages($errors, "Cannot find park reviews");
		return false;
	}
	
}

function getMembersName($memberId) {
	global $database;
	global $errors;
	
	$query = "SELECT * FROM members WHERE id = :id";
	$stmt = $database->prepare($query);
	$stmt->bindParam('id', $memberId);
	$stmt->execute();
	$memberName = $stmt->fetchAll();
	
	if ($stmt->rowCount() > 0) {
		return $memberName['firstName'];
	} else {
		error_messages($errors, "Cannot find park reviews");
		return false;
	}
}

function getFirstName() {
	global $database;
	global $errors;
	
	$query = "SELECT firstName FROM members";
	$stmt = $database->prepare($query);
	$stmt->execute();
	
	if ($stmt->rowCount() > 0) {
		return $stmt->fetch();
	} else {
		error_messages($errors, "Cannot find park reviews");
		return false;
	}
}

function getMemberId() {
	global $database;
	global $errors;
	
	$query = "SELECT id FROM members";
	$stmt = $database->prepare($query);
	$stmt->execute();
	
	if ($stmt->rowCount() > 0) {
		return $stmt->fetch();
	} else {
		error_messages($errors, "Cannot find member id");
		return false;
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