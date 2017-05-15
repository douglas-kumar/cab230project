<?php
	
	include 'init.php';
	require 'functions.php';
	//echo "hello world!";
	if (empty($_POST) === false) {
		$email = $_POST['email'];
		$password = $_POST['pwd'];
	}
	echo $email, " ", $password;
	
	if (user_exists($email) === false) {
		echo "email account is not registered, please sign up or use exisitng email";
	}
	
	if (user_exists('Gary')){
		echo "logged in";
	}
	
?>