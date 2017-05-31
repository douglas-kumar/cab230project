<?php
    global $errors;
    global $database;
    if (isset($_POST['submit'])) {
        try {
            $email = $_POST['email'];
            $password = $_POST['pwd'];
            $results = get_salt($email);
            $password = sha1($password . $results['salt']);

            // Search the db for the user by the email provided
            $query = "SELECT id, firstName FROM members WHERE email = :email";
            $stmt = $database->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $userId = $stmt->fetch();
            }
    
    
            // Attempt to log the user in
            if (login($email, $password)) {
                $_SESSION['loggedIn'] = true;
                $_SESSION['user'] = $userId['id'];
				$_SESSION['userName'] = $userId['firstName'];
                header("location: http://fastapps04.qut.edu.au:8080/n9716751/cab230project-master/index.php");
            } else {
                foreach($errors as $error) {
                    print_r($error);
                    echo "<br />";
                }
                
                echo "<br />";
            }

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
?>