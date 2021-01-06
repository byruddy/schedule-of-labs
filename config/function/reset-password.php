<?php  

	// Connection
	require_once '../connection.php';

	// Helper
	require_once '../helper.php';

	// Generate new password / Reset
	$txt = str_shuffle("abcdfg");
	$no  = str_shuffle("123456");
	// New Password
	$randomPassword = substr($txt,3).substr($no, 3);

    // Decrytpion for token 
	$resetNim = base64_decode($_GET['token']);

	// Encryption for value from form
	$passwordAdmin = sha1($_POST['password']);

	// Get password admin
	$runQuery = mysqli_query($link, "SELECT kataSandi FROM pengguna WHERE nim=1");
	$passAdmin = mysqli_fetch_assoc($runQuery);
	$passAdmin = $passAdmin['kataSandi'];


	// Process to reset
	if ($passwordAdmin == $passAdmin) {
		// Run QUERY
		$newPassword = sha1($randomPassword);
		$query = "UPDATE pengguna SET kataSandi='$newPassword' WHERE nim=$resetNim";
		$runQuery = mysqli_query($link, $query);

		if ($runQuery) {
			// Save new password for admin
			$_SESSION['newPassword'] = $randomPassword;
			// Add activity
			$me 	   = $_SESSION['user'];
			$today 	   = date('Y/m/d H:i:s');
			$runQueryActivity = mysqli_query($link, "INSERT INTO aktivitas VALUES (NULL, 'reset', '', '$resetNim', '$me', '$today')");
			header('Location: '.BASE_URL.'user/manage-user/reset/new-password.php?token='.$_GET['token']);
		}

	} else {
		// Send message error password Admin
		$_SESSION['msg-error'] = true;
		header('Location: '.BASE_URL.'user/manage-user/reset/?token='.$_GET['token']);
	}






                  // 