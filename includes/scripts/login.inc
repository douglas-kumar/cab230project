<?php
    global $errors;
    global $database;
    if (isset($_POST['submit'])) {
        try {
            $email = $_POST['email'];
            $password = $_POST['pwd'];
            $results = get_salt($email);
            $password = sha1($password . $results['salt']);

            $query = "SELECT id, firstName FROM members WHERE email = :email";
            $stmt = $database->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $userId = $stmt->fetch();
            }

            if (login($email, $password)) {
                $_SESSION['loggedIn'] = true;
                $_SESSION['user'] = $userId['id'];
				$_SESSION['userName'] = $userId['firstName'];
                header("location: http://fastapps04.qut.edu.au:8080/n9716751/cab230project-master/index.php");
            } else {
                print_r($errors);
            }

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
?>