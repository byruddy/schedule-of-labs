<?php 

	// Connection
	require_once '../connection.php';

	// Helper
	require_once '../helper.php';

	// Save in variable 
	$userNim   = $_SESSION['user'];
	
	// Value from to user
	$idSchedule = $_POST['idSchedule'];
	$ruanganId 	= $_POST['ruanganId'];
	$jurusanId 	= $_POST['jurusanId'];
	$kelas 	   	= $_POST['kelas'];
	$mk 	   	= $_POST['mataKuliah'];
	$nmDosen   	= $_POST['namaDosen'];
	$status    	= $_POST['status'];
	
	// Automatic today
	$today 	   = date('Y/m/d H:i:s');

	// Validation
	$isValid = true;
	$msg 	 = "";


	// Room only one activity
	$oneActivity = mysqli_query($link, "SELECT ruanganId,status FROM `jadwalPratikum` WHERE (ruanganId = $ruanganId) AND (status = 'Menunggu' OR status = 'Berlangsung') AND (NOT penggunaNim = '$userNim')");

	if (mysqli_num_rows($oneActivity) > 0) {
		$_SESSION['room-duplicate'] = true;
	    header('Location: '.BASE_URL.'user/schedule/update.php#focus');
	    $isValid = false;
	}


	if ($isValid) {
		
		$query = "UPDATE jadwalPratikum SET ruanganId='$ruanganId', jurusanId='$jurusanId', kelas='$kelas', mataKuliah='$mk', namaDosen='$nmDosen', lastUpdate='$today', status='$status' WHERE id='$idSchedule'";
				$runQuery = mysqli_query($link, $query);

			// Validation for query SQL
			if ($runQuery) {
				// Create a activity
				$activity = "edit";

				// Get last id for activity
				$jadwalPratikum = mysqli_query($link, "SELECT id FROM jadwalPratikum WHERE penggunaNim='$userNim' ORDER BY tglJadwal DESC LIMIT 1");
				$getJp 			= mysqli_fetch_assoc($jadwalPratikum);
				$jpActivity 	= $getJp['id'];

				// Add activity
				$runQueryActivity = mysqli_query($link, "INSERT INTO aktivitas VALUES (NULL, '$activity', '$jpActivity', '', '$userNim', '$today')");

				if ($runQueryActivity) {
					if ($status == "Menunggu" || $status == "Berlangsung") {
						$_SESSION['update-success'] = "Berhasil, Data Jadwal berhasil Anda ubah!";
						header('Location: '.BASE_URL.'user/schedule/update.php#focus');
					} else {
						$_SESSION['update-success'] = "Berhasil, Terima kasih telah  menyelesaikan jadwal!";
						header('Location: '.BASE_URL.'user/schedule/create.php');
						echo "KO";
					}
				}

			} else {
			
				echo "Periksa kembali pada query!";
			
			}


	} else {
		echo "Validation is running ...";
	}
