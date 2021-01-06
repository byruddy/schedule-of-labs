<?php 

	// Connection
	require_once '../connection.php';

	// Helper
	require_once '../helper.php';

	// Value from user
	$nama 			= $_POST['nama'];
	$information 	= $_POST['information'];

	// Validation
	$isValid = true;
	$msg = "";

	  if ($nama == "") {
	    $isValid = false;
	    $msg    .= "Silahkan masukkan <b>Nama</b> terlebih dahulu!";
	  }  elseif (strlen($nama) < 3) {
	    $isValid = false;
	    $msg    .= "<b>Nama Divisi</b> hanya boleh menggunakan minimal 3 huruf!";
	  }  elseif (str_word_count($nama) > 3) {
	    $isValid = false;
	    $msg    .= "<b>Nama Divisi</b> hanya boleh menggunakan maksimal 3 kata!";
	  }  elseif ($information == "") {
	    $isValid = false;
	    $msg    .= "Silahkan masukkan <b>Alamat</b> terlebih dahulu!";
	  } elseif (strlen($information) < 6) {
	    $isValid = false;
	    $msg    .= "<b>Informasi</b> minimal 6 huruf!";
	  }

	 // Insert
	if ($isValid) {
		// Query
		mysqli_query($link, "INSERT INTO divisi VALUES (null,'$nama','$information', 'active')");
		// Session
		$_SESSION['msg-success'] = $nama;
		// Direct
			// Get last table data
			$countAllDivisi = mysqli_num_rows(mysqli_query($link, "SELECT * FROM divisi"));
			$pages = ceil($countAllDivisi/7);
		header('Location: '.BASE_URL.'user/manage-user/division/index.php?page='.$pages);
	} else {
		$_SESSION['msg-error'] = $msg;
		$dataForm = http_build_query($_POST);
		header('Location: '.BASE_URL."user/manage-user/division/index.php?action=create-new&$dataForm#focus");
	}


