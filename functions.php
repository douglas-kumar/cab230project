<?php
	
	include 'init.php';
	
	function user_exists($emailAccount){
		$emailAccount = sanitize($emailAccount);
		$query = mysql_query("SELECT COUNT('id') FROM 'members' WHERE 'emailAccount' = '$emailAccount'");
		
		if (mysql_result($query, 0) == 1) {
			return true;
		} else {
			return false;
		}	
	}
	
	function sanitize($data) {
		return mysql_real_escape_string($data);
	}


?>