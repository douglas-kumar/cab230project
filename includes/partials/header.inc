<?php 
	require './includes/functions.inc';
    session_start();
    // Include db configuration parameters
    require_once "./config/DBconfig.inc";
    // Inclue database connection
    require_once "./lib/Database.inc";
    require_once "./includes/functions.inc";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Brisbane Parks</title>
    <meta charset="utf-8" />
    <?php include 'references.inc' ?>
</head>
<body>
	<div id ="wrapper">
    <header>
        <?php include 'navigation.inc' ?>
    </header>
    <main>