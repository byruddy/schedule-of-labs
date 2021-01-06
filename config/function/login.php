<?php  

	// Connection
	require_once '../connection.php';

	// Helper
	require_once '../helper.php';


	// Get value from form
	$nim 		= $_POST['nim'];
	$password 	= $_POST['password'];


	// Encrypt password to sha1
	$password   = sha1($password);

	// Checking user
	$checking = mysqli_query($link, "SELECT * FROM pengguna WHERE nim='$nim' AND kataSandi='$password'");

	if (mysqli_num_rows($checking) == 1) {
		
		// Save nim to username
		$_SESSION['nim'] = $nim;
		// Save room default
		$_SESSION['lab-default'] = $_POST['lab-default'];

		// Checking to authentication-account
		header('Location: authentication-account.php');
	} else {
		$_SESSION['msg-error'] = "Sorry, Invalid nim or password.";
		header('Location: '.BASE_URL.'user/login');
	}
