<?php

    if (isset($_POST['submit'])) {
        global $errors;
        global $database;

        try {
            //Collect search criteria
            if (!empty($_POST['suburb'])) {
                $suburb = $_POST['suburb'];
            }
            if (!empty($_POST['name'])) {
                $name = strtoupper($_POST['name']);
            }
            if (!empty($_POST['rating'])) {
                $rating = $_POST['rating'];
            }

            // Construct a query based on search parameters provided

            if (!empty($_POST['name']) && !empty($_POST['suburb']) && !empty($_POST['rating'])) {

                $query = "SELECT I.*, AVG(R.rating) AS rat FROM items AS I INNER JOIN reviews AS R ON R.itemId = I.id GROUP BY R.itemId, I.name, I.parkCode, I.street, I.suburb, I.easting, I.northing, I.latitude, I.longitude HAVING rat >" . $rating . "AND suburb = ''" . $suburb . "'' AND name LIKE ''%" . $name . "%''";

            } else if (!empty($_POST['name']) && !empty($_POST['suburb'])) {

                $query = "SELECT * FROM items WHERE suburb = ''" . $suburb . "'' AND name LIKE ''%" . $name . "%''";

            } else if (!empty($_POST['name']) && !empty($_POST['rating'])) {

                $query = "SELECT I.*, AVG(R.rating) AS rat FROM items AS I INNER JOIN reviews AS R ON R.itemId = I.id GROUP BY R.itemId, I.name, I.parkCode, I.street, I.suburb, I.easting, I.northing, I.latitude, I.longitude HAVING rat >" . $rating . "AND name LIKE ''%" . $name . "%''";

            } else if (!empty($_POST['suburb']) && !empty($_POST['rating'])) {

                $query = "SELECT I.*, AVG(R.rating) AS rat FROM items AS I INNER JOIN reviews AS R ON R.itemId = I.id GROUP BY R.itemId, I.name, I.parkCode, I.street, I.suburb, I.easting, I.northing, I.latitude, I.longitude HAVING rat >" . $rating . "AND suburb = ''" . $suburb . "''";
                
            } else if (!empty($_POST['name'])) {

                $query = "SELECT * FROM items WHERE name LIKE ''%" . $name . "%''";

            } else if (!empty($_POST['suburb'])) {

                $query = "SELECT * FROM items WHERE suburb = ''" . $suburb . "''";

            } else if (!empty($_POST['rating'])) {

                $query = "SELECT I.*, AVG(R.rating) AS rat FROM items AS I INNER JOIN reviews AS R ON R.itemId = I.id GROUP BY R.itemId, I.name, I.parkCode, I.street, I.suburb, I.easting, I.northing, I.latitude, I.longitude HAVING rat >" . $rating;

            } else {

                $query = "SELECT * FROM items LIMIT 50";
                
            }

            $stmt = $database->prepare($query);
            //$stmt->bindParam(":suburb", $suburb);
            //$stmt->bindParam(":rating", $rating);
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