<?php 
  
  // Create last position for back
  $_SESSION['lastPosition'] = substr($_SERVER['REQUEST_URI'], 16);

  $searchName = $_GET['search_name'];

  // Query Data
  $qDivisi = mysqli_query($link, "SELECT * FROM divisi WHERE nama LIKE '%$searchName%'");


    // Count total data divisi
  $countAllDivisi = mysqli_num_rows($qDivisi);

  // Checking data is find
  $isFind = true;
  if (mysqli_num_rows($qDivisi) == 0) {
  	 $isFind = false;
  }

?>
<h5 name="title-dashboard" style="margin-bottom: 0px;"><i class="glyphicon glyphicon-tower"></i> Manage Division</h5>
<h6 class="status-history">Dashboard <i class="glyphicon glyphicon-menu-right"></i> <span class="status-history">Division <i class="glyphicon glyphicon-menu-right"></i></span> Search <i class="glyphicon glyphicon-menu-right"></i></span> <span class="text-primary"><?php echo $_GET['search_name']; ?></span></h6>
<br>
<?php  
      //  Alert Msg-error 
    if (isset($_SESSION['msg-success'])) {
  ?>
    <div id="focus" class="alert alert-success">
      <i class="glyphicon glyphicon-ok"></i> Berhasil, Anda telah menambahkan data baru dengan nama <b><?php echo $_SESSION['msg-success']; ?></b>
    </div>

  <?php
    unset($_SESSION['msg-success']);
    }
  ?>

<div class="box-table" id="focus" style="min-height: 400px;">
  
  <div class="row">
    <div class="col-sm-6">
      <a href="<?php echo BASE_URL ?>user/manage-user/index.php" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-user"></i> Users</a>
      <a href="<?php echo BASE_URL ?>user/manage-user/division/" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-tower"></i> All Divisi</a>
      <a href="?action=create-new" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i> Add a new division</a>
    </div>           
    <div class="col-sm-6 text-right">
      <form class="form-inline" action="" method="GET">
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i></div>
            <input type="text" class="form-control" id="search" name="search_name" maxlength="20" placeholder="Typing by name" value="<?php echo $_GET['search_name']; ?>">
          </div>
        </div>
        <button type="submit" class="btn btn-sm btn-success" style="padding: 7px;"><i class="glyphicon glyphicon-search"></i> Find division</button>
      </form>
    </div>
  </div>       

  <?php  

  	if (!$isFind) {

  ?>

  <div class="nofind text-center">
  	<h2 class="text-danger"><i class="glyphicon glyphicon-minus-sign"></i></h2>
  	<h4 class="lead">Maaf, <b><?php echo $_GET['search_name']; ?></b> tidak ditemukan dalam database divisi!</h4>
  </div>

  <?php  

  	} else {

  ?>

  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th class="text-center">No.</th>
        <th>Name division</th>
        <th class="text-center">Status</th>
        <th class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php  
        $no = (isset($_GET['page']) && $_GET['page'] > 1) ? $start+1 : 1;
        while ($divisi = mysqli_fetch_assoc($qDivisi)) {
           // Format only for status
          if ($divisi['status'] == "active") {
            $iconStatus = 'ok';
          } elseif ($divisi['status'] == 'nonactive') {
            $iconStatus = 'remove';
          }

          echo "<tr>";
            echo "<td class='text-center' style='width: 50px;'>$no</td>";
            echo "<td style='width: 450px;'>".ucwords($divisi['nama'])."</td>";
            echo "<td class='text-center'><a title='Tidak untuk diklik' class='btn btn-sm btn-default' name='status-$divisi[status]'> <i class='glyphicon glyphicon-$iconStatus'></a></td>";
            echo "<td class='text-center'><a href='?detail=$divisi[id]'> <i class='glyphicon glyphicon-eye-open'></i></a></td>";
          echo "</tr>";

          $no++;
        }
      ?>
    </tbody>
  </table>
</div>

<div class="row" style="padding-bottom: 20px;">
    <div class="col-sm-4 col-sm-offset-4">
        <code class='text-muted' style="background-color: white;">Total data : <b><?php echo $countAllDivisi ?></b></code>
    </div>
</div>
	<?php  

	  }

	?>
