<?php 
	require './includes/functions.inc';
    session_start();
    // Include the database configuration parameters
    require_once "./config/DBconfig.inc";
    // Inclue the database connection
    require_once "./lib/Database.inc";
    require_once "./includes/functions.inc";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <?php include 'references.inc' ?>
</head>
<body>
    <header>
        <?php include 'navigation.inc' ?>
    </header>
    <main>