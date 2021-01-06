<?php  

	// Connection
	require_once '../connection.php';

	// Helper
	require_once '../helper.php';


	// Session Destroy

	if (isset($_SESSION['user'])) {
		session_destroy();
		header('Location: '.BASE_URL.'user/login/');
	}
