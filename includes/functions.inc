<?php
//connect to db
$connection = mysqli_connect("localhost", "root", "", "cab230_db");

// check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }
 
 

function get_park_name($name) {
	global $connection;
	$query = "SELECT name FROM items WHERE name = :name";
	
}

?>