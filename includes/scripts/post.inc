<?php
	global $errors;
	if (isset($_POST['submit'])) {
		global $database;
		try {
			$userId = 0;
			$itemId = 0;
			$rating = 1;
			$text = $_POST['text'];
			$dateTime = '2017-4-12 14:17:57';
			
			if (validatePost($text)) {
				// Get newly created account ID
                $reviewId = $database->lastInsertId();
                // Redirect to index.php
				header("location: http://localhost/cab230project/index.php");
			} else {
				print_r($errors);
			}
		} catch (PDOException $e) {
			die($e->getMessage());
		}
			
	}
	
?>