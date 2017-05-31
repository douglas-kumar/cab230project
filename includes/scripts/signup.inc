<?php

    if (isset($_POST['submit'])) {
        global $database;
        global $errors;
        try {

            // Collect input values
            $firstname = trim($_POST['firstname']);
            $lastname = trim($_POST['lastname']);
			$dob = $_POST['dob'];
            $email = trim($_POST['email']);
			$address = trim($_POST['address']);
			$state = $_POST['state'];
			$postcode = trim($_POST['postcode']);
            if (isset($_POST['cor']) && $_POST['cor'] == 'on') {
			    $cor = 1;
            } else {
                $cor = 0;
            }
            $password = $_POST['pwd'];
			$confPassword = $_POST['cpwd'];

            // Validate user input
            validateNames($firstname, $lastname);
			validateDob($dob);
            validateEmail($email);
			validateAddress($address);
			validateState($state);
			validatePostcode($postcode);
			passwordsValid($password, $confPassword);

            // Count if there are any errors found
            if (count($errors) === 0) {
                // Create salt
                $saltHash = md5(uniqid());
                $salt = substr($saltHash, 0, 20);

                // Concat salt to password and hash
                $password =  sha1($password . $salt);

                // Create and prepare query to add member to db
                $query = "INSERT INTO members (firstName, lastName, DOB, email, address, state, postcode, correspondence, password, salt)
                VALUES (:firstname, :lastname, :dob, :email, :address, :state, :postcode, :correspondence, :password, :salt)";

                $stmt = $database->prepare($query);

                // Bind parameters
                $stmt->bindParam(':firstname', $firstname);
                $stmt->bindParam(':lastname', $lastname);
				$stmt->bindParam(':dob', $dob);
                $stmt->bindParam(':email', $email);
				$stmt->bindParam(':address', $address);
				$stmt->bindParam(':state', $state);
				$stmt->bindParam(':postcode', $postcode);
				$stmt->bindParam(':correspondence', $cor);
                $stmt->bindParam(':password', ($password));
                $stmt->bindParam(':salt', $salt);

                // Execute the query
                $stmt->execute();

                // Log the user in immediately
                if ($stmt->rowCount() > 0) {
                    require 'login.inc';
                }
            } else {
                foreach($errors as $error) {
                    print_r($error);
                    echo "<br/>";
                }
                echo "<br />";
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
