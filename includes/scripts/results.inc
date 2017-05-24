<?php

    if (isset($_POST['submit'])) {
        global $errors;
        global $database;

        try {

            //Collect search criteria
            if (isset($_POST['name'])) {
                $name = $_POST['name'];
            }
            if (isset($_POST['suburb'])) {
                $suburb = $_POST['suburb'];
            }
            if (isset($_POST['rating'])) {
                $rating = $_POST['rating'];
            }

            $query1 = "SELECT * FROM items WHERE suburb = :suburb";
            $stmt = $database->prepare($query1);
            $stmt->bindParams(":suburb", $suburb);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $results = $stmt->fetchAll();
            } else {
                $results = 0;
            }

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
?>