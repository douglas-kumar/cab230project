<?php
	global $errors;
	if (isset($_POST['submit'])) {
		global $database;
		date_default_timezone_set("Australia/Brisbane");

		try {
			$memberId = $_SESSION['user'];
			$itemId = $_SESSION['itemId'];
			$dateTime = date("Y-m-d H:i:s");
			$rating = $_POST['rating'];
			$text = $_POST['text'];
			
<<<<<<< HEAD
			if (submitPost($text, $rating) == true) {
                // Redirect to same page
				header("location: http://fastapps04.qut.edu.au:8080/n9716751/cab230project-master/park.php?itemId=$itemId");
			} else {
				print_r($errors);
			}
		} catch (PDOException $e) {
			die($e->getMessage());
		}
			
	}
	
?>