<?php 

	// Connection
	require_once '../connection.php';

	// Helper
	require_once '../helper.php';

	// Generate new password
	$txt = str_shuffle("abcdfg");
	$no  = str_shuffle("123456");
	// New Password
	$randomPassword = substr($txt,3).substr($no, 3);

	// Value from user
	$nim 	= $_POST['nim'];
	$nama 	= $_POST['nama'];
	$divisi = $_POST['divisi'];
	$alamat = $_POST['address'];
	$jk 	= $_POST['gender'];

	// Set value - default
	$password = sha1($randomPassword);
	$level  = 'staff';
	$status = 'active';

	// Validation
	$isValid = true;
	$msg = "";

	  if ($nim == "") {
	    $isValid = false;
	    $msg    .= "Silahkan masukkan <b>Nim</b> terlebih dahulu!";
	  } elseif (!is_numeric($nim)) {
	    $isValid = false;
	    $msg    .= "<b>Nim</b> hanya bisa menggunakan angka!";
	  } elseif ($nama == "") {
	    $isValid = false;
	    $msg    .= "Silahkan masukkan <b>Nama</b> terlebih dahulu!";
	  } elseif (is_numeric($nama)) {
	    $isValid = false;
	    $msg    .= "<b>Nama</b> hanya bisa menggunakan huruf!";
	  } elseif (strlen($nama) < 3) {
	    $isValid = false;
	    $msg    .= "<b>Nama</b> harus memiliki minimal 3 huruf";
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
		mysqli_query($link, "INSERT INTO pengguna VALUES (null,'$nim','$nama','$jk','$password','$level','$divisi','$alamat','$status','')");
		// Session
		$_SESSION['valueForm'] = $_POST;
		$_SESSION['new-password'] = $randomPassword;
		// Direct
		header('Location: '.BASE_URL.'user/manage-user/index.php?action=create-new&last-step=2');
	} else {
		$_SESSION['msg-error'] = $msg;
		$dataForm = http_build_query($_POST);
		header('Location: '.BASE_URL."user/manage-user/index.php?action=create-new&$dataForm#focus");
	}



