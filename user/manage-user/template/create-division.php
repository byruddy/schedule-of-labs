<?php  
	// Get last ID from division
	$query =  "SELECT COUNT(id) FROM divisi";
	$resQuery = mysqli_query($link, $query);
	$divisi = mysqli_fetch_assoc($resQuery);

?>

<h5 name="title-dashboard" style="margin-bottom: 0px;"><i class="glyphicon glyphicon-pencil"></i> Create a Division</h5>
<h6 class="status-history">Dashboard <i class="glyphicon glyphicon-menu-right"></i> <span class="status-history">Manage Division <i class="glyphicon glyphicon-menu-right"></i></span> <span class="text-primary">Create a New</span></h6>

<form name="create-schedule" action="http://localhost/jadwalPratikum/config/function/create-division.php" method="POST" id="focus">
  	

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
    <label for="id">ID</label>
    <input type="text" class="form-control" id="id" name="nim" value="<?php echo $divisi['COUNT(id)']+1; ?>" disabled>
  </div>
  <div class="form-group" style="margin-bottom: 5px;">
    <label for="name">Name of division</label>
    <input type="text" class="form-control" id="name" name="nama" maxlength="30" placeholder="Fullname" <?php if(isset($_GET['nama'])){ echo "value='$_GET[nama]'"; } ?> required>
  </div>
  <div class="form-group" style="margin-bottom: 5px;" style="margin-bottom: 5px;">
    <label for="information`">Information</label>
    <textarea class="form-control" rows="3" id="information`" placeholder="Information" name="information" required><?php if(isset($_GET['nama'])){ echo $_GET['information']; } ?></textarea>
  </div>
 
  <button type="submit" class="btn btn-block btn-success" style="margin-top: 10px;">Create</button>
  <a href="<?php echo BASE_URL ?>user/manage-user/division/" class="btn btn-block btn-default">Cancel</a>
</form>


<br><br>
