<?php  

  // Validation 1
  if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    // Get detail divisi for edit
    $id = $_GET['id'];
    $query = mysqli_query($link, "SELECT * FROM divisi WHERE id='$id'");

    // Validation 2
    if (mysqli_num_rows($query) == 0) {
      include_once('../../404.php');
      exit;
    } else {
       // Read by name colm in db
       $divisi  = mysqli_fetch_assoc($query);
    }

  }


  

?>

<h5 name="title-dashboard" style="margin-bottom: 0px;"><i class="glyphicon glyphicon-pencil"></i> Edit Division</h5>
<h6 class="status-history">Dashboard <i class="glyphicon glyphicon-menu-right"></i> <span class="status-history">Edit Division <i class="glyphicon glyphicon-menu-right"></i></span> <span class="text-primary"><?php echo $_GET['id']; ?></span></h6>


<form name="create-schedule" action="http://localhost/jadwalPratikum/config/function/update-division.php" method="POST" id="focus">
    

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
      <input type="radio" name="status" id="inlineRadio2" value="active" <?php if(isset($_GET['status']) && $_GET['status'] == 'active'){ echo "checked"; } else if($divisi['status'] == 'active'){ echo "checked"; } ?>> Active
    </label>
    <label class="radio-inline">
      <input type="radio" name="status" id="inlineRadio3" value="nonactive" <?php if(isset($_GET['status']) && $_GET['status'] == 'nonactive'){ echo "checked"; } else if($divisi['status'] == 'nonactive' && !isset($_GET['status'])){ echo "checked"; } ?>> Nonactive
    </label>
  </div>

  <hr>

  <div class="form-group" style="margin-bottom: 5px;">
    <label for="id">ID <span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="id" name="id" title="This column not for change" value="<?php echo $_GET['id'] ?>" readonly>
  </div>
  <div class="form-group" style="margin-bottom: 5px;">
    <label for="name">Name of Division <span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="name" name="nama" maxlength="25" placeholder="Fullname" value='<?php if(isset($_GET['nama'])){ echo $_GET['nama']; } else {  echo $divisi['nama']; } ?>' required>
  </div>
  <div class="form-group" style="margin-bottom: 5px;" style="margin-bottom: 5px;">
    <label for="information">Information <span class="text-danger">*</span></label>
    <textarea class="form-control" rows="3" id="information" placeholder="Information" name="information" required><?php if(isset($_GET['nama'])){ echo $_GET['information']; } else { echo $divisi['ket']; } ?></textarea>
  </div>

  <button type="submit" class="btn btn-block btn-success" style="margin-top: 10px;">Create</button>
  <a href="<?php echo BASE_URL.'user/manage-user/division/index.php?detail='.$_GET['id']; ?>" class="btn btn-block btn-default">Cancel</a>
</form>

<br><br>