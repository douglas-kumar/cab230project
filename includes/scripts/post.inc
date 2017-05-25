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
			
			if (validatePost($text, $rating) == true) {
				// Get newly created account ID
             //  $reviewId = $database->lastInsertId();
                // Redirect to index.php
				header("location: http://<?= {$_SERVER['HTTP_HOST']} ?>/cab230project-master/index.php");
			} else {
				print_r($errors);
			}
		} catch (PDOException $e) {
			die($e->getMessage());
		}
			
	}
	
?>