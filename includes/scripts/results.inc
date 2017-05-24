<?php

    if (isset($_POST['submit'])) {
        global $errors;
        global $database;

        // Construct a query based on search parameters provided

        try {

            if (isset($_POST['name']) && isset($_POST['suburb']) && isset($_POST['rating'])) {

                $query = "";

            } else if (isset($_POST['name']) && isset($_POST['suburb'])) {

            } else if (isset($_POST['name']) && isset($_POST['rating'])) {

            } else if (isset($_POST['suburb']) && isset($_POST['rating'])) {
                
            } else if (isset($_POST['name])) {

            } else if (isset($_POST['suburb'])) {

            } else if (isset($_POST['rating'])) {

            } else {

            }

            //Collect search criteria
            if (isset($_POST['suburb'])) {
                $suburb = $_POST['suburb'];
                $query = "SELECT * FROM items WHERE suburb = :suburb";
                print_r($query);
            }
            if (isset($_POST['name'])) {
                $name = strtoupper($_POST['name']);
                $query = "SELECT * FROM (" . $query . ") WHERE name LIKE '%" . $name . "%'";
                print_r($query);
            }
            if (isset($_POST['rating'])) {
                $rating = $_POST['rating'];
            }

            $stmt = $database->prepare($query);
            $stmt->bindParam(":suburb", $suburb);
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