<?php 

	// Connection
	require_once '../connection.php';

	// Helper
	require_once '../helper.php';

	// Save in variable 
	$userNim   = $_SESSION['user'];
	
	// Value from to user
	$ruanganId 	= $_GET['ruangan'];
	$jurusanId 	= $_GET['jurusan'];
	$kelas 	   	= $_GET['kelas'];
	$mk 	   	= $_GET['mataKuliah'];
	$nmDosen   	= $_GET['dosen'];
	$status    	= $_GET['status'];
	
	// Automatic today
	$today 	   = date('Y/m/d H:i:s');

	// Validation
	$isValid = true;
	$msg 	 = "";

	// Room only one activity
	$oneActivity = mysqli_query($link, "SELECT ruanganId,status FROM `jadwalPratikum` WHERE (ruanganId = $ruanganId) AND (status = 'Menunggu' OR status = 'Berlangsung') AND (NOT penggunaNim = '$userNim')");

	if (mysqli_num_rows($oneActivity) > 0) {
		$_SESSION['room-duplicate'] = true;
	    header('Location: '.BASE_URL.'user/schedule/create.php#focus');
	    $isValid = false;
	}



	if ($isValid) {

		$query = "INSERT INTO jadwalPratikum VALUES (NULL, '$ruanganId', '$jurusanId', '$kelas', '$mk', '$nmDosen', '$userNim', '$today', '', '$status')";
		$runQuery = mysqli_query($link, $query);

		// Validation for query SQL
		if ($runQuery) {
			// Create a activity
			$activity = "add";

			// Get last id for activity
			$jadwalPratikum = mysqli_query($link, "SELECT id FROM jadwalPratikum WHERE penggunaNim='$userNim' ORDER BY tglJadwal DESC LIMIT 1");
			$getJp 			= mysqli_fetch_assoc($jadwalPratikum);
			$jpActivity 	= $getJp['id'];


			$runQueryActivity = mysqli_query($link, "INSERT INTO aktivitas VALUES (NULL, '$activity', '$jpActivity', '','$userNim', '$today')");

			if ($runQueryActivity) {
				$_SESSION['msg-success'] = true;
				header('Location: '.BASE_URL.'user/schedule/update.php');
			}

		} else {
			echo "Periksa kembali pada query!";
		}




	}





