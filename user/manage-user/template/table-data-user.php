<?php 
  // Create last position for back
  $_SESSION['lastPosition'] = substr($_SERVER['REQUEST_URI'], 16);

  // Pagination config
  $show = 7; // PerPage
  $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

  $start = ($page > 1) ? ($page * $show) - $show : 0;

  // Query Data
  $qPengguna = mysqli_query($link, "SELECT * FROM pengguna WHERE level='staff' LIMIT $start, $show ");
  
  // Count total data divisi
  $countAllPengguna = mysqli_num_rows(mysqli_query($link, "SELECT * FROM pengguna WHERE level='staff'"));

  // CountAll Divisi / $show
  $pages = ceil($countAllPengguna/$show);

  // Validation for pagination
  if (isset($_GET['page'])) {
    if ($_GET['page'] > $pages) {
      include_once('../404.php');
      exit;                
    } elseif ($_GET['page'] < 1) {
      include_once('../404.php');
      exit;
    }
  } 


?>

<h5 name="title-dashboard" style="margin-bottom: 0px;"><i class="glyphicon glyphicon-user"></i> Manage Users</h5>
<h6 class="status-history">Dashboard <i class="glyphicon glyphicon-menu-right"></i> <span class="status-history">User <i class="glyphicon glyphicon-menu-right"></i></span> <span class="text-primary">Data</span></h6>
<br>

<div class="box-table" id="focus" style="min-height: 400px; border-bottom: 1px solid #E9E9E9;">
<div class="row">
  <div class="col-sm-6">
    <a href="<?php echo BASE_URL ?>user/manage-user/division/index.php" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-tower"></i> Division</a>
    <a href="?action=create-new" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i> Add a new user</a>
  </div>           
  <div class="col-sm-6 text-right">
    <form class="form-inline" action="" method="GET">
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i></div>
          <input type="text" class="form-control" maxlength="8" id="search_nim" name="search_nim" placeholder="Typing by nim ..">
        </div>
      </div>
      <button type="submit" class="btn btn-sm btn-success" style="padding: 7px;"><i class="glyphicon glyphicon-search"></i> Find user</button>
    </form>
  </div>
</div>       
    
<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th class="text-center">No.</th>
      <th class="text-center">Nim</th>
      <th>Fullname</th>
      <th class="text-center">Division</th>
      <th class="text-center">Status</th>
      <th class="text-center">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php  
      $no = 1;
      while ($staff = mysqli_fetch_assoc($qPengguna)) {

        // Format only for status
        if ($staff['status'] == "active") {
          $iconStatus = 'ok';
        } elseif ($staff['status'] == 'nonactive') {
          $iconStatus = 'remove';
        }

        echo "<tr>";
          echo "<td class='text-center'>$no</td>";
          echo "<td class='text-center'>$staff[nim]</td>";
          echo "<td>".ucwords($staff['nama'])."</td>";
          echo "<td>$staff[divisi]</td>";
          echo "<td class='text-center'><a title='Tidak untuk diklik' class='btn btn-sm btn-default' name='status-$staff[status]'> <i class='glyphicon glyphicon-$iconStatus'></a></td>";
          echo "<td class='text-center'><a title='Selengkapnya' href='?detail=$staff[nim]' class='btn btn-sm btn-default' name='detail'> <i class='glyphicon glyphicon-eye-open'></i></a></td>";
        echo "</tr>";

        $no++;
      }

    ?>
  </tbody>
</table>
</div>

<?php  
  // Set value from link pagination
  
    // Back
      if (isset($_GET['page']) && $_GET['page'] > 1) {
        $back     = $_GET['page']-1;
        $linkBack   = "'><a href='?page=$back'><span aria-hidden='true'>&larr;</span> Back</a>";
      } else {
        $linkBack   = "disabled'><a href=''><span aria-hidden='true'>&larr; Back</a>";
      }
      // Next
      if ($pages == 1) {
        $linkNext   = "disabled'><a href=''>Next <span aria-hidden='true'>&rarr;</span></a></a>";
      } elseif (isset($_GET['page']) && $_GET['page'] == $pages) {
        $linkNext   = "disabled'><a href=''>Next <span aria-hidden='true'>&rarr;</span></a></a>";
      } elseif (isset($_GET['page'])){
        if ($_GET['page'] >= 0 || $_GET['page'] > 1) {
        $next     = $_GET['page']+1;
        $linkNext   = "'><a href='?page=$next'>Next <span aria-hidden='true'>&rarr;</span></a>";
        }
      } elseif (!isset($_GET['page'])) {
        $linkNext   = "'><a href='?page=2'>Next <span aria-hidden='true'>&rarr;</span></a>";
      }
?>

<div class="row">
<nav>
  <ul class="pager">
    <div class="col-sm-4">
      <li class='previous <?php echo $linkBack; ?></li>
    </div>
    <div class="col-sm-4">
      <code class='text-muted' style="background-color: white;">Total data : <b><?php echo $countAllPengguna ?></b></code>
    </div>
    <div class="col-sm-4">
      <li class='next <?php echo $linkNext; ?></li>
    </div>
  </ul>
</nav>
</div>


