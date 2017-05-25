<?php
global $errors;
	if (isset($_GET['submit'])) {
		global $database;
		try {
			$name = $_GET['name'];
			
			$results = getParkName($name);

			if ($results == $name) {
				// TO DO:
				header("location: http://fastapps04.qut.edu.au:8080/n9716751/cab230project-master/index.php");
			} else {
				print_r($errors);
			}
		} catch (PDOException $e) {
			die($e->getMessage());
		}
		
	}
?>

<?php

?>