<?php 

	// Connection
	require_once '../connection.php';

	// Helper
	require_once '../helper.php';

	// Value from user
	$nimUser = $_POST['nim'];
	$status = $_POST['status'];
	$nama 	= $_POST['nama'];
	$divisi = $_POST['divisi'];
	$alamat = $_POST['address'];
	$jk 	= $_POST['gender'];

	// Validation
	$isValid = true;
	$msg = "";

	 if ($nama == "") {
	    $isValid = false;
	    $msg    .= "Silahkan masukkan <b>Nama</b> terlebih dahulu!";
	  } elseif (is_numeric($nama)) {
	    $isValid = false;
	    $msg    .= "<b>Nama</b> hanya bisa menggunakan huruf!";
	  } elseif (strlen($nama) < 3) {
	    $isValid = false;
	    $msg    .= "<b>Nama</b> harus memiliki minimal 3 huruf";
	  } elseif (strlen($nama) > 25) {
	    $isValid = false;
	    $msg    .= "<b>Nama</b> hanya bisa memiliki maksimal 25 huruf";
	  } elseif ($divisi == "") {
	    $isValid = false;
	    $msg    .= "Silahkan divisi <b>Pilih</b> terlebih dahulu!";
	  } elseif ($alamat == "") {
	    $isValid = false;
	    $msg    .= "Silahkan masukkan <b>Alamat</b> terlebih dahulu!";
	  } elseif (strlen($alamat) < 6) {
	    $isValid = false;
	    $msg    .= "<b>Alamat</b> minimal 6 huruf!";
	  } elseif ($jk == "") {
	    $isValid = false;
	    $msg    .= "Silahkan pilih <b>Jenis Kelamin</b> terlebih dahulu!";
	  }



	// Insert
	if ($isValid) {
		// Query
		mysqli_query($link, "UPDATE pengguna SET nama='$nama', divisi='$divisi', alamat='$alamat', jk='$jk', status='$status' WHERE nim='$nimUser'");
		// Session
		$_SESSION['msg-success'] = true;
		// Direct
		header('Location: '.BASE_URL.'user/manage-user/index.php?detail='.$nimUser);
	} else {
		$_SESSION['msg-error'] = $msg;
		$dataForm = http_build_query($_POST);
		header('Location: '.BASE_URL."user/manage-user/index.php?action=edit&nim=$nimUser&$dataForm&process=failed#focus");
	}


	// Delete $_SESSION NIM
	unset($_SESSION['update-nim']);
