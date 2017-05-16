<?php

session_start();
session_destroy();

//$_SESSION['loggedIn'] = false;

header("location: http://{$_SERVER['HTTP_HOST']}/cab230project/login.php");

?>