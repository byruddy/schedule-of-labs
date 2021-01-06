<?php 
	// Get all data only id $_GET
	$idUser = $_GET['detail'];

	// Checking and Validation
	$isValid = mysqli_query($link, "SELECT * FROM divisi WHERE id='$idUser'");
	if (mysqli_num_rows($isValid) == 0) {
		include_once('../../404.php');
		exit;
	} else {
		$divisi = mysqli_fetch_assoc($isValid);
		// Get total activity only id $_GET
		$nmDivisi = $divisi['nama'];
		$relatedDivision   = mysqli_query($link, "SELECT COUNT(*) FROM pengguna WHERE divisi='$nmDivisi'");
		$rDivision = mysqli_fetch_assoc($relatedDivision);
	}
?>

<h5 name="title-dashboard" style="margin-bottom: 0px;"><i class="glyphicon glyphicon-tower"></i> Manage Division</h5>
<h6 class="status-history">Dashboard <i class="glyphicon glyphicon-menu-right"></i> <span class="status-history">Division <i class="glyphicon glyphicon-menu-right"></i></span> <span class="text-primary">Data</span></h6>
<br>


<?php  
  	//  Alert Msg-success 
	if (isset($_SESSION['msg-success'])) {
?>
	<div id="focus" class="alert alert-success">
		<i class="glyphicon glyphicon-ok"></i> Berhasil, Anda telah mengubah data divisi ini!
	</div>
	
<?php  
	unset($_SESSION['msg-success']);
	}
?>

<div class="row detail-user">
	<div class="col-sm-3">
		<a href="#" class="thumbnail" style="padding: 7px;">
	      <img src="<?php echo BASE_URL ?>assets/img/skills.png" alt="Photo profile" style="opacity: 0.8;">
	    </a>
	</div>
	<div class="col-sm-9">
		<h4><?php echo $divisi['nama']; ?><span class='status-<?php echo $divisi['status'] ?>'><?php echo ucwords($divisi['status']); ?></span></h4>
		<h6><i class="glyphicon glyphicon-user"></i> <strong><?php echo $rDivision['COUNT(*)']; ?></strong> Related users</h6>
		<h6 style="text-align: justify; opacity: 0.9;"><i class="glyphicon glyphicon-comment"></i><em>Comment below..</em></h6>
		<p style="padding-bottom: 0px; text-align: justify;"><?php echo $divisi['ket']; ?></p>
		<hr>
		<a href="<?php echo BASE_URL.$_SESSION['lastPosition']; ?>" class="btn btn-sm btn-default">Back</a>
		<a href="<?php echo BASE_URL ?>user/manage-user/division/index.php?action=edit&id=<?php echo $_GET['detail'] ?>" class="btn btn-sm btn-warning">Edit Data</a>
	</div>
</div>