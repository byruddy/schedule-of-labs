<?php  
	// Validation
	if (!isset($_GET['nim'])) {
		include_once('../404.php');
		exit;
	} else {
		$nim = $_GET['nim'];

		$checking = mysqli_query($link, "SELECT nim FROM pengguna WHERE nim='$nim'");
		if (mysqli_num_rows($checking) == 0) {
			include_once('../404.php');
			exit;
		}
	}


	// Extract ValueForm
	if (isset($_SESSION['valueForm'])) {
		extract($_SESSION['valueForm']);
	}

	// Get data Division
	$query = "SELECT nama FROM divisi";
	$resQuery = mysqli_query($link, $query);
	
	// Get detail user for edit
	$nim= $_GET['nim'];
	$query = mysqli_query($link, "SELECT * FROM pengguna WHERE nim='$nim'");
	$user  = mysqli_fetch_assoc($query);

?>

<h5 name="title-dashboard" style="margin-bottom: 0px;"><i class="glyphicon glyphicon-pencil"></i> Edit User</h5>
<h6 class="status-history">Dashboard <i class="glyphicon glyphicon-menu-right"></i> <span class="status-history">Edit User <i class="glyphicon glyphicon-menu-right"></i></span> <span class="text-primary"><?php echo $_GET['nim']; ?></span></h6>


<form name="create-schedule" action="http://localhost/jadwalPratikum/config/function/update-user.php" method="POST" id="focus">
  	

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

  <div class="form-group" style="margin-bottom: 10px;">
    <label>Status</label>
    <br>
    <label class="radio-inline">
      <input type="radio" name="status" id="inlineRadio2" value="active" <?php if(isset($_GET['status']) && $_GET['status'] == 'active'){ echo "checked"; } else if($user['status'] == 'active'){ echo "checked"; } ?>> Active
    </label>
    <label class="radio-inline">
      <input type="radio" name="status" id="inlineRadio3" value="nonactive" <?php if(isset($_GET['status']) && $_GET['status'] == 'nonactive'){ echo "checked"; } else if($user['status'] == 'nonactive' && !isset($_GET['status'])){ echo "checked"; } ?>> Nonactive
    </label>
  </div>

  <hr>

  <div class="form-group" style="margin-bottom: 5px;">
    <label for="nim">Nim</label>
    <input type="text" class="form-control" id="nim" name="nim" placeholder="Nim" maxlength="8" <?php if(isset($_GET['nim'])){ echo "value='$_GET[nim]'"; } ?> readonly>
  </div>
  <div class="form-group" style="margin-bottom: 5px;">
    <label for="name">Fullname</label>
    <input type="text" class="form-control" id="name" name="nama" maxlength="25" placeholder="Fullname" value='<?php if(isset($_GET['process']) && $_GET['process'] == 'failed'){ echo $_GET['nama']; } else { echo $user['nama']; } ?>' required>
  </div>
  <div class="form-group" style="margin-bottom: 5px;" style="margin-bottom: 5px;">
    <label>Division</label>
    <select class="form-control" name="divisi">
      <?php  
      	while ($divisi = mysqli_fetch_assoc($resQuery)) {
      		echo "<option value'$divisi[nama]' ";
      			if (isset($_GET['divisi']) && isset($_GET['process']) && $_GET['process'] == 'failed') {
      				if ($_GET['divisi'] == $divisi['nama']) {
      					echo "selected";
      				}
      			} elseif ($user['divisi'] == $divisi['nama']) {
      				echo "selected";
      			}
      		echo ">$divisi[nama]</option>";
      	}

      ?>
  	</select>
  </div>
  <div class="form-group" style="margin-bottom: 5px;" style="margin-bottom: 5px;">
    <label for="address">Address</label>
    <textarea class="form-control" rows="3" id="address" placeholder="Address" name="address" required><?php if(isset($_GET['process']) && $_GET['process'] == 'failed'){ echo $_GET['address']; } else { echo $user['alamat']; } ?></textarea>
  </div>
  <div class="form-group" style="margin-bottom: 30px;">
    <label>Gender</label>
    <br>
    <label class="radio-inline">
      <input type="radio" name="gender" id="inlineRadio2" value="L" <?php if(isset($_GET['gender']) && $_GET['gender'] =='L'){ echo "checked"; } elseif($user['jk'] == 'L'){ echo "checked"; } ?>> Male
    </label>
    <label class="radio-inline">
      <input type="radio" name="gender" id="inlineRadio3" value="P" <?php if(isset($_GET['gender']) && $_GET['gender'] =='P'){ echo "checked"; } elseif($user['jk'] == 'P'){ echo "checked"; } ?>> Female
    </label>
  </div>
 
  <button type="submit" class="btn btn-block btn-success" style="margin-top: 10px;">Create</button>
  <a href="<?php echo BASE_URL.'user/manage-user/index.php?detail='.$_GET['nim']; ?>" class="btn btn-block btn-default">Cancel</a>
</form>

<br><br>