
<?php 
	// Get all data only id $_GET
	$idUser = $_GET['detail'];

	// Checking and Validation
	$isValid = mysqli_query($link, "SELECT * FROM pengguna WHERE nim='$idUser'");
	if (mysqli_num_rows($isValid) == 0) {
		include_once('../404.php');
		exit;
	} else {
		$user = mysqli_fetch_assoc($isValid);
		// Change format jk
		if ($user['jk'] == 'L') {
			$user['jk'] = 'Laki-laki';
		} elseif ($user['jk'] == 'P') {
			$user['jk'] = 'Perempuan';
		}

		// Get total activity only id $_GET
		$tblActivity   = mysqli_query($link, "SELECT * FROM aktivitas WHERE penggunaNim='$idUser'");
		$totalActivity = mysqli_num_rows($tblActivity);
	}
?>

<h5 name="title-dashboard" style="margin-bottom: 0px;"><i class="glyphicon glyphicon-list-alt"></i> Detail User : <span class="text-primary"><?php echo $_GET['detail']; ?></span></h5>
<h6 class="status-history">Dashboard <i class="glyphicon glyphicon-menu-right"></i> <span class="status-history">User <i class="glyphicon glyphicon-menu-right"></i></span> <span class="status-history">Detail <i class="glyphicon glyphicon-menu-right"></i></span> <span class="text-primary"><?php echo $_GET['detail']; ?></span></h6>


<?php  
  	//  Alert Msg-success 
	if (isset($_SESSION['msg-success'])) {
?>
	<div id="focus" class="alert alert-success" style="margin-top: 20px;">
		<i class="glyphicon glyphicon-ok"></i> Berhasil, Anda telah mengubah data pengguna ini!
	</div>
	
<?php  
	unset($_SESSION['msg-success']);
	}
?>

<div class="row detail-user">

	<div class="col-sm-3">
		<a href="#" class="thumbnail" style="padding: 7px;">
	      <img src="<?php echo BASE_URL ?>assets/img/no-profile.png" alt="Photo profile">
	    </a>
	</div>
	<div class="col-sm-9">
		<div class="row">
			<div class="col-sm-12">
				<h4><?php echo ucwords($user['nama']); ?><span class='status-<?php echo $user['status'] ?>'><?php echo ucwords($user['status']); ?></span></h4>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<h6><i class="glyphicon glyphicon-tower"></i> <?php echo $user['divisi']; ?> Division</h6>
				<h6><i class="glyphicon glyphicon-map-marker"></i> <?php echo substr($user['alamat'], 0, 70); ?></h6>
				<h6><i class="glyphicon glyphicon-heart"></i> <?php echo $user['jk']; ?></h6>
			</div>
			<div class="col-sm-6">
				<h6><i class="glyphicon glyphicon-pencil"></i> <?php echo $totalActivity; ?> Activity</h6>
				<h6><i class="glyphicon glyphicon-time"></i>Last Sign In <?php echo date('d-m-Y H:i:s', strtotime($user['lastSignIn'])); ?></h6>
			</div>		
		</div>
		<hr>
		<a href="<?php echo BASE_URL.$_SESSION['lastPosition']; ?>" class="btn btn-sm btn-default">Back</a>
		<a href="<?php echo BASE_URL ?>user/manage-user/index.php?action=edit&nim=<?php echo $_GET['detail'] ?>" class="btn btn-sm btn-warning">Edit Data</a>
		<a href="reset/?token=<?php echo base64_encode($_GET['detail']); ?>" class="btn btn-sm btn-info">Reset Password</a>
	</div>
</div>
<br><br>