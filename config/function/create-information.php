<?php 

	// Connection
	require_once '../connection.php';

	// Helper
	require_once '../helper.php';

	// Save in variable 
	$userNim   = $_SESSION['user'];

	// Validation
	$msg = "";
	if (isset($_POST['index'])) {
		$text = $_POST['index'];
		mysqli_query($link, "UPDATE informasi SET textIndex='$text'");
		$msg .= "index";
	} elseif (isset($_POST['dashboard'])) {
		$text = htmlspecialchars($_POST['dashboard'], ENT_QUOTES);
		$tes = mysqli_query($link, "UPDATE informasi SET textDashboard='$text'");
		if (!$tes){
			echo mysqli_error($link);
		}
		$msg .= "dashboard";
		// var_dump($_POST); 
	}
	exit;
	mysqli_close($con);


	// Direct
	$_SESSION['success'] = $msg;
	header('Location: '.BASE_URL.'user/information/');