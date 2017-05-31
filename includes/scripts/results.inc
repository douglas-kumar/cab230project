<?php

    if (isset($_POST['btnSubmit'])) {
        global $errors;
        global $database;

        try {
            //Collect search criteria
            if (!empty($_POST['suburb'])) {
                $suburb = $_POST['suburb'];
            }
            if (!empty($_POST['name'])) {
                $name = str_replace("'", "''", (htmlspecialchars(strtoupper($_POST['name']))));
            }
            if (!empty($_POST['rating'])) {
                $rating = $_POST['rating'];
            }
            if (!empty($_POST['lat'])) {
                $lat = $_POST['lat'];
            }
            if (!empty($_POST['long'])) {
                $long = $_POST['long'];
            }

            // Construct a query based on search parameters provided

            if ((!empty($_POST['lat'])) && (!empty($_POST['long']))) {
            
              $minLat = $lat - 0.01;
              $maxLat = $lat + 0.01;
              $minLong = $long - 0.01;
              $maxLong = $long + 0.01;
              $query = "SELECT * FROM items WHERE latitude > " . $minLat . " AND latitude < " . $maxLat . " AND longitude > " . $minLong . " AND longitude < " . $maxLong . ";";
              
            } else if (!empty($_POST['name']) && !empty($_POST['suburb']) && !empty($_POST['rating'])) {

                $query = "SELECT I.*, AVG(R.rating) AS rat FROM items AS I INNER JOIN reviews AS R ON R.itemId = I.id GROUP BY R.itemId, I.name, I.parkCode, I.street, I.suburb, I.easting, I.northing, I.latitude, I.longitude HAVING rat >= " . $rating . " AND I.suburb = '" . $suburb . "' AND I.name LIKE '%" . $name . "%' ORDER BY rat DESC;";

            } else if (!empty($_POST['name']) && !empty($_POST['suburb'])) {

                $query = "SELECT * FROM items WHERE suburb = '" . $suburb . "' AND name LIKE '%" . $name . "%';";

            } else if (!empty($_POST['name']) && !empty($_POST['rating'])) {

                $query = "SELECT I.*, AVG(R.rating) AS rat FROM items AS I INNER JOIN reviews AS R ON R.itemId = I.id GROUP BY R.itemId, I.name, I.parkCode, I.street, I.suburb, I.easting, I.northing, I.latitude, I.longitude HAVING rat >= " . $rating . " AND I.name LIKE '%" . $name . "%' ORDER BY rat DESC;";

            } else if (!empty($_POST['suburb']) && !empty($_POST['rating'])) {

                $query = "SELECT I.*, AVG(R.rating) AS rat FROM items AS I INNER JOIN reviews AS R ON R.itemId = I.id GROUP BY R.itemId, I.name, I.parkCode, I.street, I.suburb, I.easting, I.northing, I.latitude, I.longitude HAVING rat >= " . $rating . " AND I.suburb = '" . $suburb . "' ORDER BY rat DESC;";
                
            } else if (!empty($_POST['name'])) {

                $query = "SELECT * FROM items WHERE name LIKE '%" . $name . "%';";

            } else if (!empty($_POST['suburb'])) {

                $query = "SELECT * FROM items WHERE suburb = '" . $suburb . "';";

            } else if (!empty($_POST['rating'])) {

                $query = "SELECT I.*, AVG(R.rating) AS rat FROM items AS I INNER JOIN reviews AS R ON R.itemId = I.id GROUP BY R.itemId, I.name, I.parkCode, I.street, I.suburb, I.easting, I.northing, I.latitude, I.longitude HAVING rat >= " . $rating . " ORDER BY rat DESC;";

            } else {

                $query = "SELECT * FROM items ORDER BY RAND() LIMIT 25;";
                
            }

            $stmt = $database->prepare($query);
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