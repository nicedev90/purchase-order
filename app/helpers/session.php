<?php 
	session_start();

	function userLoggedIn() {
		if (isset($_SESSION['user_rol'])) {
			return true;
		} else {
			return false;
		}
	}
?>