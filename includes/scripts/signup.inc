<?php

    if (isset($_POST['submit'])) {
        global $database;
        global $errors;
        try {

            // Collect input values
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
			$dob = $_POST['dob'];
            $email = $_POST['email'];
			$address = $_POST['address'];
			$state = $_POST['state'];
			$postcode = $_POST['postcode'];
			$cor = $_POST['cor'];
            $password = $_POST['pwd'];
			$confPassword = $_POST['cpwd'];

            // Validate user input
            validateName($firstname);
			validateName($lastname);
			//validateDob($dob);
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

                // Concat salt to password and hash using sha1
                $password =  sha1($password . $salt);

                // Create and prepare query
                $query = "INSERT INTO members (firstName, lastName, DOB, email, address, state, postcode, correspondence, password, salt)
                VALUES (:firstname, :lastname, :dob, :email, :address, :state, :postcode, :correspondence, :password, :salt)";

                // Prepare the statement to prevent SQL injections
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

                if ($stmt->rowCount() > 0) {

                    $_SESSION['loggedIn'] = true;

                    // Redirect to index.php
                    header("location: http://localhost/cab230project/index.php");
                }
            } else {
                print_r($errors);
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
