<?php

$errors = [];

function error_messages(&$errors, $message) {
    array_push($errors, $message);
}

function charOnly($str) {
    global $errors;
    if (!preg_match('/^[a-zA-Z ]+$/', $str)) {
        return false;
    } else {
		return true;
	}
}

function validateSearch($string) {
   return preg_replace('/[^A-z0-9\-\']/', '', $string);
}

function validateNames($firstname, $lastname) {
	global $errors;
	$fname = trim($firstname);
	$lname = trim($lastname);
	$flen = strlen($fname);
	$llen = strlen($lname);
	if (($flen < 2 || $flen > 30) || ($llen < 2 || $llen > 30)) {
		error_messages($errors, "* Names must have at least 2, but no more than 30 characters");
	}
	
	if ((!charOnly($fname)) || (!charOnly($lname))) {
		error_messages($errors, "* Names must only contain letters");
	} 
}

function validateDob($dob) {
	global $errors;
	$regex = '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/';
	if (!preg_match($regex, $dob)) {
		error_messages($errors, "* Invalid date of birth, required format: YYYY-MM-DD");
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
		error_messages($errors, "* That email address has already been used by another member, choose another");
	}
}

function validateAddress($address) {
	global $errors;
	$regex = '/[0-9]+\s[A-z]+/';
	if (!preg_match($regex, $address)) {
		error_messages($errors, "* Invalid address entered");
	}
}

function validateState($state) {
	global $errors;
	if ($state == "") {
		error_messages($errors, "* No state selected");
	}
}

function validatePostcode($postcode) {
	global $errors;
	$regex = '/^([0-9]{4})$/';
	if (!preg_match($regex, $postcode)) {
		error_messages($errors, "* Invalid postcode entered");
	}
}

function passwordsValid($pwd1, $pwd2) {
	global $errors;
	$len = strlen($pwd1);
	if ($len < 8) {
		error_messages($errors, "* Password must be at least 8 characters long");
	}
	if ($pwd1 != $pwd2) {
		error_messages($errors, "* Passwords do not match");
	}
}

function getUserFirstName($id) {
    global $database;
    global $errors;
    
    $query = "SELECT firstName FROM members WHERE id = :id";
    $stmt = $database->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        return $stmt->fetch();
    }
}

function getPark($itemId) {
	global $errors;
	global $database;
	$query = "SELECT * FROM items WHERE id = :id";
	
	$stmt = $database->prepare($query);
	
	$stmt->bindParam(':id', $itemId);
	$stmt->execute();
	
	if ($stmt->rowCount() > 0) {
		return $stmt->fetch();
	} else {
		error_messages($errors, "* That park doesn't exist");
	}	
}

function getStarRating($parkId) {
    global $database;
    global $errors;
    
    try {
        $query = "SELECT AVG(rating) AS rat FROM reviews GROUP BY itemId HAVING itemId = :itemId";
        $stmt = $database->prepare($query);
        $stmt->bindParam(":itemId", $parkId);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $avgRat = $stmt->fetch();
            $numStars = floor($avgRat['rat']);
            return $numStars;
        } else {
            $numStars = 0;
            return $numStars;
        }
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function submitPost($text, $rating) {
	global $database;
	global $errors;
	date_default_timezone_set("Australia/Brisbane");
	
	if ((strlen($text) >= 20) && (strlen($text) <= 200)) {

	
		$memberId = $_SESSION['user'];
		$itemId = $_SESSION['itemId'];
		$dateTime = date("Y-m-d H:i:s");
		
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
		}
		
	} else {
		error_messages($errors, "* Please make sure your review is between 20 and 200 characters");
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
	
	$itemId = $_SESSION['itemId'];
						
	$query = "SELECT  M.firstName, R.rating, R.text, R.dateTime FROM reviews AS R INNER JOIN members AS M ON R.memberId = M.id WHERE itemId = :itemId";
	$stmt = $database->prepare($query);
	$stmt->bindParam(':itemId', $itemId);
	$stmt->execute();
						
	if ($stmt->rowCount() > 0) {
		return $stmt->fetchAll();
	} else {
		error_messages($errors, "* No reviews against that criteria");
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
        error_messages($errors, "* That email and password combination could not be found, please try again");
        return false;
    }
}

