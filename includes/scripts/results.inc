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

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
?>