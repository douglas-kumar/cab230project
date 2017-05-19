<?php

$errors = [];

function errorMessages(&$errors, $message) {
    array_push($errors, $message);
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

function enforceLogin() {
	if (!$_SESSION['loggedIn']) {
		header("location: http://{$_SERVER['HTTP_HOST']}/cab230project/login.php");
		}
}

?>