<?php  

	// Connection
	require_once '../connection.php';

	// Helper
	require_once '../helper.php';


	// My Nim
	$me = $_SESSION['user'];

	// My Password
	$queryMyPassword = mysqli_query($link, "SELECT kataSandi FROM pengguna WHERE nim='$me'");
	$data = mysqli_fetch_assoc($queryMyPassword);

	$myPassword = $data['kataSandi'];


	// Value from form and Encrypt
	$current = sha1($_POST['current']);
	$new 	 = sha1($_POST['new']);
	$renew   = sha1($_POST['renew']);

	// Validation
	if ($current === $myPassword) {
		if ($new === $renew) {
			// UPDATE Password
			$runQuery = mysqli_query($link, "UPDATE pengguna SET kataSandi='$new' WHERE nim='$me'");
			if ($runQuery) {
				$today 	   = date('Y/m/d H:i:s');
				// Add activity
				$runQueryActivity = mysqli_query($link, "INSERT INTO aktivitas VALUES (NULL, 'password', '', '$me', '$today')");
				$_SESSION['msg-success'] = "Successfully, your password has been updated!";
				// echo var_dump($runQueryActivity);
			}

		} else {
			$_SESSION['msg-error'] = "Password baru dan re-type baru tidak cocok!";
		}
	} else {
		$_SESSION['msg-error'] = "Password lama salah";
	}
	// Direct to pages change password
	header('Location: '.BASE_URL.'user/password/');



