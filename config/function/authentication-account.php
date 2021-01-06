<?php  

	// Connection
	require_once '../connection.php';

	// Helper
	require_once '../helper.php';


	// Get username from nim
	$user = $_SESSION['nim'];

	// Get level and status
	$checking = mysqli_fetch_assoc(mysqli_query($link, "SELECT nama,level,status FROM pengguna WHERE nim='$user'"));

	// Validation
	if ($checking['status'] == "nonactive") {
		$_SESSION['msg-error'] = "Sorry, your account has been suspended!";
		header('Location: '.BASE_URL.'user/login');



	// Delete session nim
	unset($_SESSION['username']);

	} elseif ($checking['status'] == "active") {
		$_SESSION['user']  = $user;
		$_SESSION['level'] = $checking['level'];
		// UPDATE last sign in
 		$now = date('Y/m/d H:i:s');

		mysqli_query($link, "UPDATE pengguna SET lastSignIn='$now' WHERE nim='$user'");
		header('Location: '.BASE_URL.'user');
		
	}


