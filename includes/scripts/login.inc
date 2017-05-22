<?php
    global $errors;
    global $database;
    if (isset($_POST['submit'])) {
        try {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $results = get_salt($email);
            $password = sha1($password . $results['salt']);

            $query = "SELECT id FROM members WHERE email = :email";
            $stmt = $database->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $userId = $stmt->fetch();
            }

            if (login($email, $password)) {
                $_SESSION['loggedIn'] = true;
                $_SESSION['isAdmin'] = is_admin($userId['id']);
                header("location: http://localhost/cab230project/index.php");
            } else {
                print_r($errors);
            }

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
?>