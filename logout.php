<?php
session_start();
session_destroy();

$_SESSION = array();

header("location: http://fastapps04.qut.edu.au:8080/n9716751/cab230project-master/login.php");

?>