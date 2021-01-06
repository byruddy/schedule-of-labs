<?php  
	// Extract ValueForm
	if (isset($_SESSION['valueForm'])) {
		extract($_SESSION['valueForm']);
	}


	// Get data Division
	$query = "SELECT * FROM divisi WHERE status='active'";
	$resQuery = mysqli_query($link, $query);

?>

<h5 name="title-dashboard" style="margin-bottom: 0px;"><i class="glyphicon glyphicon-pencil"></i> Create a User</h5>
<h6 class="status-history">Dashboard <i class="glyphicon glyphicon-menu-right"></i> <span class="status-history">User <i class="glyphicon glyphicon-menu-right"></i></span> <span class="text-primary">Create a New</span></h6>

<?php  

	if (isset($_SESSION['valueForm'])) {
	
?>

	<div class="create-laststep">
		<div class="row">
			<div class="col-sm-3">
				<h4>New user</h4>
				<a href="#" class="thumbnail" style="padding: 7px;">
			      <img src="<?php echo BASE_URL ?>assets/img/no-profile.png" alt="Photo profile">
			    </a>
			</div>
			<div class="col-sm-9">
				<div class="alert alert-success" style="padding: 8px 15px; font-size: 12px;">
					<i class="glyphicon glyphicon-ok"></i> Selamat, Anda berhasil membuat pengguna baru dengan data berikut
				</div>
				<table  style="margin-bottom: 0px; padding: 0px;">
					<tr>
						<td><label>Nama Lengkap</label></td>
						<td>:</td>
						<td><h5><?php echo ucwords($nama); ?></h5></td>
					</tr>
					<tr>
						<td><label>Nim</label></td>
						<td>:</td>
						<td><h5><?php echo $nim; ?></h5></td>
					</tr>
					<tr>
						<td><label>Kata Sandi</label></td>
						<td>:</td>
						<td><h5 class="text-primary"><strong><?php echo $_SESSION['new-password']; ?></strong></h5></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-9">
				<h6 style="font-weight: normal;" class="text-muted"><em><i class="glyphicon glyphicon-eye-open"></i> Please remember nim and password for sign in later.</em></h6>
			</div>
			<div class="col-sm-3">
				<?php  
				// Direct
				// Get last table data
					$countAllPengguna = mysqli_num_rows(mysqli_query($link, "SELECT * FROM pengguna"));
					$pages = ceil($countAllPengguna/7);

				?>
				<a href="<?php echo BASE_URL ?>user/manage-user/index.php?page=<?php echo $pages; ?>" class="btn btn-default btn-sm btn-block">Close</a>
			</div>
		</div>
	</div>

<?php 
	unset($_SESSION['valueForm']);
	} else {

?>


<form name="create-schedule" action="http://localhost/jadwalPratikum/config/function/create-user.php" method="POST" id="focus">
  	

	<?php  
	  	//  Alert Msg-error 
		if (isset($_SESSION['msg-error'])) {
	?>
		<div id="focus" class="alert alert-danger" style="margin-top: 20px;">
			<i class="glyphicon glyphicon-remove"></i> Maaf, <?php echo $_SESSION['msg-error']; ?>
		</div>

	<?php
		unset($_SESSION['msg-error']);
		}
	?>


  <div class="form-group" style="margin-bottom: 5px;">
    <label for="mataKuliah">Nim</label>
    <input type="text" class="form-control" id="mataKuliah" name="nim" placeholder="Nim" maxlength="8" <?php if(isset($_GET['nim'])){ echo "value='$_GET[nim]'"; } ?> required>
    <h6 class="text-warning" style="opacity: 0.9;"><em><i class="glyphicon glyphicon-info-sign"></i> Mohon diperhatikan, nim tidak bisa diubah ketika akun sudah dibuat</em></h6>
  </div>
  <div class="form-group" style="margin-bottom: 5px;">
    <label for="name">Fullname</label>
    <input type="text" class="form-control" id="name" name="nama" placeholder="Fullname" <?php if(isset($_GET['nama'])){ echo "value='$_GET[nama]'"; } ?> required>
  </div>
  <div class="form-group" style="margin-bottom: 5px;" style="margin-bottom: 5px;">
    <label>Division</label>
    <select class="form-control" name="divisi">
      <option value="">--[Choose Division]--</option>
      <?php  
      	while ($divisi = mysqli_fetch_assoc($resQuery)) {
      		echo "<option value='".$divisi['nama']."' ";

      			if (isset($_GET['divisi'])) {
	      			if ($divisi['nama'] == $_GET['divisi']) {
	      				echo "selected";
	      			}
      			}

      		echo ">".$divisi['nama']."</option>";
      	}

      ?>
  	</select>
  </div>
  <div class="form-group" style="margin-bottom: 5px;" style="margin-bottom: 5px;">
    <label for="address">Address</label>
    <textarea class="form-control" rows="3" id="address" placeholder="Address" name="address" required><?php if(isset($_GET['address'])){ echo $_GET['address']; } ?></textarea>
  </div>
  <div class="form-group" style="margin-bottom: 30px;">
    <label>Gender</label>
    <br>
    <label class="radio-inline">
      <input type="radio" name="gender" id="inlineRadio2" value="L" <?php if(isset($_GET['gender']) && $_GET['gender'] == "L"){ echo "checked"; } ?>> Male
    </label>
    <label class="radio-inline">
      <input type="radio" name="gender" id="inlineRadio3" value="P" <?php if(isset($_GET['gender']) && $_GET['gender'] == "P"){ echo "checked"; } ?> > Female
    </label>
  </div>
 
  <button type="submit" class="btn btn-block btn-success" style="margin-top: 10px;">Create</button>
  <a href="<?php echo BASE_URL.$_SESSION['lastPosition']; ?>" class="btn btn-block btn-default">Cancel</a>
</form>

<?php  

	}

?>

<br><br><br><br>