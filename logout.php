<?php

session_start();
session_destroy();

//$_SESSION['loggedIn'] = false;
$_SESSION = array();

header("location: http://{$_SERVER['HTTP_HOST']}/cab230project-master/login.php");

?>