<?php 

	// Connection
	require_once '../connection.php';

	// Helper
	require_once '../helper.php';

	// Value from user
	$id 	 = $_POST['id'];
	$nama 	 = trim($_POST['nama']);
	$ket	 = trim($_POST['information']);
	$status  = $_POST['status'];

	// Validation
	$isValid = true;
	$msg = "";

	 if ($nama == "") {
	    $isValid = false;
	    $msg    .= "Silahkan masukkan <b>nama Divisi</b> terlebih dahulu!";
	  } elseif (is_numeric($nama)) {
	    $isValid = false;
	    $msg    .= "<b>Nama Divisi</b> hanya bisa menggunakan huruf!";
	  } elseif (strlen($nama) < 3) {
	    $isValid = false;
	    $msg    .= "<b>Nama Divisi</b> harus memiliki minimal 3 huruf";
	  } elseif (strlen($nama) > 25) {
	    $isValid = false;
	    $msg    .= "<b>Nama</b> hanya bisa memiliki maksimal 25 huruf";
	  } else if ($ket == "") {
	    $isValid = false;
	    $msg    .= "Silahkan masukkan <b>Informasi</b> terlebih dahulu!";
	  }


	// Insert
	if ($isValid) {
		// Query
		mysqli_query($link, "UPDATE divisi SET nama='$nama', ket='$ket', status='$status' WHERE id='$id'");
		// Session
		$_SESSION['msg-success'] = true;
		// Direct
		header('Location: '.BASE_URL.'user/manage-user/division/index.php?detail='.$id);
	} else {
		$_SESSION['msg-error'] = $msg;
		$dataForm = http_build_query($_POST);
		header('Location: '.BASE_URL."user/manage-user/division/index.php?action=edit&id=$id&$dataForm&process=failed#focus");
	}
