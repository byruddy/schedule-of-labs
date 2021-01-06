<?php  

  // Connection
  require_once '../../config/connection.php';

  // Helper
  require_once '../../config/helper.php';

  // User Access 
  userAccess('admin');


  // Get only first name
    $nim = $_SESSION['user'];
    $resQuery = mysqli_query($link, "SELECT * FROM pengguna WHERE nim='$nim'");
    $firstName = mysqli_fetch_assoc($resQuery);

    $firstName = $firstName['nama'];

    // Trim
    $arr = explode(' ', trim($firstName));

    // Get an information
    $resQuery = mysqli_query($link, "SELECT * FROM informasi");
    $informasi = mysqli_fetch_assoc($resQuery);
    $index     = $informasi['textIndex'];
    $dashboard = $informasi['textDashboard'];


    // Ranking Room
    $rankingRoom = mysqli_query($link, "SELECT b.nama, COUNT(*) AS jml FROM jadwalPratikum a JOIN ruangan b ON (a.ruanganId = b.id) GROUP BY  b.id ORDER BY jml DESC LIMIT 3");

    // Ranking User
    $rankingUser = mysqli_query($link, "SELECT b.nama, COUNT(*) AS jml FROM jadwalPratikum a JOIN pengguna b ON (a.penggunaNim = b.nim) GROUP BY b.nim ORDER BY jml DESC LIMIT 3");



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Dashboard- <?php echo np; ?></title>

    <!-- Bootstrap -->
    <link href="<?php echo BASE_URL ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- My Style -->
    <link href="<?php echo BASE_URL ?>assets/css/mystyle.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body name="dashboard">

    <div class="container">
      <div class="row">
        
        <div class="col-lg-10 col-lg-offset-1 box-dashboard">
          <!-- Header -->
          <div class="row">
            <div class="col-lg-12 dashboard-header">
              
              <?php include_once('../template/header.php'); ?>

            </div> <!-- End dashboard-header -->
          </div>
          <!-- Sidebar and Main content -->
          <div class="row">
            <div class="col-lg-3 sidebar">
              
              <?php 
                if ($_SESSION['level'] == "staff") {
                  include_once('../template/sidebar.php');
                } elseif ($_SESSION['level'] == "administrator") {
                  include_once('../template/sidebarAdmin.php');
                }
              ?>

            </div> <!-- End Sidebar -->
            <div class="col-lg-9 main-content">
               
             <h5 name="title-dashboard" style="margin-bottom: 0px;"><i class="glyphicon glyphicon-signal"></i> Dashboard Management </h5>
             <h6 class="status-history"></span> <span class="text-primary">Dashboard</span></h6>

             <!-- Dashboard -->
             <div id="box-dashboard">
             	 <!-- Header -->
             	 <h5 class="text-center" style="margin-top: 15px;">System has</h5>
	             <div class="row">
	             	<div class="col-sm-4 text-center">
             			<i class="glyphicon glyphicon-signal"></i><strong><?php echo countData('aktivitas'); ?></strong> <span class="lead">Activity</span>
	             	</div>
	             	
	             	<div class="col-sm-4 text-center">
             			<i class="glyphicon glyphicon-user"></i><strong><?php echo countData('pengguna')-1; ?></strong> <span class="lead"">Registered Users</span>
	             	</div>
	             	
	             	<div class="col-sm-4 text-center">
             			<i class="glyphicon glyphicon-tower"></i><strong><?php echo countData('divisi'); ?></strong> <span class="lead">Division</span>
	             	</div>
	             </div>
	             <!-- Schedule up to date -->
	             <h6><i class="glyphicon glyphicon-time"></i> Schedule up to date</h6>
	             <table name="view-dashboard" style="border-collapse: collapse; width: 100%;">
	             	<thead>
	             		<tr>
	             			<th class="text-center">Ruang</th>
	             			<th>Jurusan/Kelas/MK/Dosen</th>
	             			<th class="text-center">Status</th>
	             			<th class="text-center">Aslab ID</th>
	             		</tr>
	             	</thead>
	             	<tbody>
	             		<tr>
	             			<td class="text-center">LG.001</td>
	             			 <?php 
					         // Run Query at helper.php
					        $schedule = mysqli_fetch_assoc(getSchedule(1));
					        $status = $schedule['status'];


					        if ($status == 'Berlangsung' || $status == 'Menunggu') {
					          $showStatus = true;

					          // function only get name
					          echo '<td>'.$schedule['nama'].' / '.$schedule['kelas'].' / '.$schedule['mataKuliah'].' / '.$schedule['namaDosen'].'</td>';

					          // for style
					          if ($schedule['status'] == 'Menunggu') {
					            $bg 	=  'info';
					            $icon 	=  'hourglass';
					          } elseif ($schedule['status'] == 'Berlangsung') {
					            $bg 	= 'success';
					            $icon 	= 'play-circle';
					          } else {
					            $bg 	= 'danger';
					            $icon 	= 'remove';
					          }

					          echo "<td class='text-center'><a class='btn btn-sm btn-$bg' style='padding: 3px 6px; font-size: 10px;'> <i class='glyphicon glyphicon-$icon'></i></a></td>";

					          echo "<td class='text-center'><a href='".BASE_URL."user/manage-user/?detail=".$schedule['penggunaNim']."' title='".nameOnly($schedule['penggunaNim'])."'>".nimDashboard($schedule['penggunaNim'])."</a></td>";

					        } else {
					          $showStatus = false;
					          $bg 		= 'danger';
					          $icon 	= 'remove';

					          echo  "<td><span class='text-danger'>Tidak ada aktivitas</span></td>";

					          echo "<td class='text-center'><a class='btn btn-sm btn-$bg' style='padding: 3px 6px; font-size: 10px;'> <i class='glyphicon glyphicon-$icon'></i></a></td>";

					          echo "<td class='text-center text-danger'>-</td>";
					        
					        }

					         ?>
	             		</tr>
	             		<tr>
	             			<td class="text-center">LG.002</td>

	             			 <?php 
					         // Run Query at helper.php
					        $schedule = mysqli_fetch_assoc(getSchedule(2));
					        $status = $schedule['status'];


					        if ($status == 'Berlangsung' || $status == 'Menunggu') {
					          $showStatus = true;

					          // function only get name
					          echo '<td>'.$schedule['nama'].' / '.$schedule['kelas'].' / '.$schedule['mataKuliah'].' / '.$schedule['namaDosen'].'</td>';

					          // for style
					          if ($status == 'Menunggu') {
					            $bg 	=  'info';
					            $icon 	=  'hourglass';
					          } elseif ($status == 'Berlangsung') {
					            $bg 	= 'success';
					            $icon 	= 'play-circle';
					          } 

					          echo "<td class='text-center'><a class='btn btn-sm btn-$bg' style='padding: 3px 6px; font-size: 10px;'> <i class='glyphicon glyphicon-$icon'></i></a></td>";

					          echo "<td class='text-center'><a href='".BASE_URL."user/manage-user/?detail=".$schedule['penggunaNim']."' title='".nameOnly($schedule['penggunaNim'])."'>".nimDashboard($schedule['penggunaNim'])."</a></td>";

					        } else {
					          $showStatus = false;
					          $bg 		= 'danger';
					          $icon 	= 'remove';

					          echo  "<td><span class='text-danger'>Tidak ada aktivitas</span></td>";

					          echo "<td class='text-center'><a class='btn btn-sm btn-$bg' style='padding: 3px 6px; font-size: 10px;'> <i class='glyphicon glyphicon-$icon'></i></a></td>";

					          echo "<td class='text-center text-danger'>-</td>";

					        }

					         ?>
	             			<!-- <td>SI / B1 / Visual Basic.Net / Agus Setyawan</td> -->
	             			<!-- <td class="text-center"><a class="btn btn-sm btn-success" style="padding: 3px 6px; font-size: 10px;"> <i class="glyphicon glyphicon-play-circle"></i></a></td> -->
	             			<!-- <td class="text-center"><a href="#" title="Angga Firmansyah">112-15-072</a></td> -->
	             		</tr>
	             		<tr>
	             			<td class="text-center">LG.003</td>
	             			 <?php 
					         // Run Query at helper.php
					        $schedule = mysqli_fetch_assoc(getSchedule(3));
					        $status = $schedule['status'];


					        if ($status == 'Berlangsung' || $status == 'Menunggu') {
					          $showStatus = true;

					          // function only get name
					          echo '<td>'.$schedule['nama'].' / '.$schedule['kelas'].' / '.$schedule['mataKuliah'].' / '.$schedule['namaDosen'].'</td>';

					          // for style
					          if ($status == 'Menunggu') {
					            $bg 	=  'info';
					            $icon 	=  'hourglass';
					          } elseif ($status == 'Berlangsung') {
					            $bg 	= 'success';
					            $icon 	= 'play-circle';
					          } 

					          echo "<td class='text-center'><a class='btn btn-sm btn-$bg' style='padding: 3px 6px; font-size: 10px;'> <i class='glyphicon glyphicon-$icon'></i></a></td>";

					          echo "<td class='text-center'><a href='".BASE_URL."user/manage-user/?detail=".$schedule['penggunaNim']."' title='".nameOnly($schedule['penggunaNim'])."'>".nimDashboard($schedule['penggunaNim'])."</a></td>";

					        } else {
					          $showStatus = false;
					          $bg 		= 'danger';
					          $icon 	= 'remove';

					          echo  "<td><span class='text-danger'>Tidak ada aktivitas</span></td>";

					          echo "<td class='text-center'><a class='btn btn-sm btn-$bg' style='padding: 3px 6px; font-size: 10px;'> <i class='glyphicon glyphicon-$icon'></i></a></td>";

					          echo "<td class='text-center text-danger'>-</td>";

					        }

					         ?>
	             		</tr>
	             		<tr>
	             			<td class="text-center">LG.004</td>
	             			 <?php 
					         // Run Query at helper.php
					        $schedule = mysqli_fetch_assoc(getSchedule(4));
					        $status = $schedule['status'];


					        if ($status == 'Berlangsung' || $status == 'Menunggu') {
					          $showStatus = true;

					          // function only get name
					          echo '<td>'.$schedule['nama'].' / '.$schedule['kelas'].' / '.$schedule['mataKuliah'].' / '.$schedule['namaDosen'].'</td>';

					          // for style
					          if ($status == 'Menunggu') {
					            $bg 	=  'info';
					            $icon 	=  'hourglass';
					          } elseif ($status == 'Berlangsung') {
					            $bg 	= 'success';
					            $icon 	= 'play-circle';
					          } 

					          echo "<td class='text-center'><a class='btn btn-sm btn-$bg' style='padding: 3px 6px; font-size: 10px;'> <i class='glyphicon glyphicon-$icon'></i></a></td>";

					          echo "<td class='text-center'><a href='".BASE_URL."user/manage-user/?detail=".$schedule['penggunaNim']."' title='".nameOnly($schedule['penggunaNim'])."'>".nimDashboard($schedule['penggunaNim'])."</a></td>";

					        } else {
					          $showStatus = false;
					          $bg 		= 'danger';
					          $icon 	= 'remove';

					          echo  "<td><span class='text-danger'>Tidak ada aktivitas</span></td>";

					          echo "<td class='text-center'><a class='btn btn-sm btn-$bg' style='padding: 3px 6px; font-size: 10px;'> <i class='glyphicon glyphicon-$icon'></i></a></td>";

					          echo "<td class='text-center text-danger'>-</td>";

					        }

					         ?>

	             		</tr>
	             		<tr>
	             			<td class="text-center">LG.005</td>
	             			 <?php 
					         // Run Query at helper.php
					        $schedule = mysqli_fetch_assoc(getSchedule(5));
					        $status = $schedule['status'];


					        if ($status == 'Berlangsung' || $status == 'Menunggu') {
					          $showStatus = true;

					          // function only get name
					          echo '<td>'.$schedule['nama'].' / '.$schedule['kelas'].' / '.$schedule['mataKuliah'].' / '.$schedule['namaDosen'].'</td>';

					          // for style
					          if ($status == 'Menunggu') {
					            $bg 	=  'info';
					            $icon 	=  'hourglass';
					          } elseif ($status == 'Berlangsung') {
					            $bg 	= 'success';
					            $icon 	= 'play-circle';
					          } 

					          echo "<td class='text-center'><a class='btn btn-sm btn-$bg' style='padding: 3px 6px; font-size: 10px;'> <i class='glyphicon glyphicon-$icon'></i></a></td>";

					          echo "<td class='text-center'><a href='".BASE_URL."user/manage-user/?detail=".$schedule['penggunaNim']."' title='".nameOnly($schedule['penggunaNim'])."'>".nimDashboard($schedule['penggunaNim'])."</a></td>";

					        } else {
					          $showStatus = false;
					          $bg 		= 'danger';
					          $icon 	= 'remove';

					          echo  "<td><span class='text-danger'>Tidak ada aktivitas</span></td>";

					          echo "<td class='text-center'><a class='btn btn-sm btn-$bg' style='padding: 3px 6px; font-size: 10px;'> <i class='glyphicon glyphicon-$icon'></i></a></td>";

					          echo "<td class='text-center text-danger'>-</td>";

					        }

					         ?>
	             		</tr>
	             		<tr>
	             			<td class="text-center">LG.HDD</td>
	             			 <?php 
					         // Run Query at helper.php
					        $schedule = mysqli_fetch_assoc(getSchedule(6));
					        $status = $schedule['status'];


					        if ($status == 'Berlangsung' || $status == 'Menunggu') {
					          $showStatus = true;

					          // function only get name
					          echo '<td>'.$schedule['nama'].' / '.$schedule['kelas'].' / '.$schedule['mataKuliah'].' / '.$schedule['namaDosen'].'</td>';

					          // for style
					          if ($status == 'Menunggu') {
					            $bg 	=  'info';
					            $icon 	=  'hourglass';
					          } elseif ($status == 'Berlangsung') {
					            $bg 	= 'success';
					            $icon 	= 'play-circle';
					          } 

					          echo "<td class='text-center'><a class='btn btn-sm btn-$bg' style='padding: 3px 6px; font-size: 10px;'> <i class='glyphicon glyphicon-$icon'></i></a></td>";

					          echo "<td class='text-center'><a href='".BASE_URL."user/manage-user/?detail=".$schedule['penggunaNim']."' title='".nameOnly($schedule['penggunaNim'])."'>".nimDashboard($schedule['penggunaNim'])."</a></td>";

					        } else {
					          $showStatus = false;
					          $bg 		= 'danger';
					          $icon 	= 'remove';

					          echo  "<td><span class='text-danger'>Tidak ada aktivitas</span></td>";

					          echo "<td class='text-center'><a class='btn btn-sm btn-$bg' style='padding: 3px 6px; font-size: 10px;'> <i class='glyphicon glyphicon-$icon'></i></a></td>";

					          echo "<td class='text-center text-danger'>-</td>";

					        }

					         ?>
	             		</tr>
	             	</tbody>
	             </table>
	             <br>
	             <div class="row">
	             	<div class="col-sm-9 ranking">
	             		

	             		<h6 style="margin-bottom: 10px;">Ranking <span style="font-weight: normal; font-size: 9px;" class="text-muted">Room and User</span></h6>
	             		<div class="row">
	             			<div class="col-sm-6">
	             				<table>
	             					<tr>
	             						<th colspan="3" class="text-center">Room lots of activity</th>
	             					</tr>
	             					<?php  
	             						$no = 1;
	             						while ($ranking = mysqli_fetch_assoc($rankingRoom)) {
	             							if ($ranking['nama'] == "LG.006") {
	             								$ranking['nama'] = "LG.HDS";
	             							}

	             							echo "<tr>";
	             							echo "<td class='text-center'><span class='badge'>$no</span></td>";
	             							echo "<td class='text-left'>$ranking[nama]</td>";
	             							echo "<td class='text-right'>".number_format($ranking['jml'])." Activity</td>";
	             							echo "</tr>";

	             						$no++;
	             						}

	             					?>
	             				</table>
	             			</div>
	             			<div class="col-sm-6">
	             				<table>
	             					<tr>
	             						<th colspan="2" style="background-color: #47C9AF" class="text-center">Famous users</th>
	             					</tr>

	             					<?php  
	             						$no = 1;
	             						while ($ranking = mysqli_fetch_assoc($rankingUser)) {

	             							echo "<tr>";
	             							echo "<td class='text-center'><span class='badge'>$no</span></td>";
	             							echo "<td class='text-left'>".strtoupper($ranking['nama'])."</td>";
	             							echo "</tr>";
	             						$no++;
	             						}

	             					?>
	             				</table>
	             			</div>
	             		</div>
	             	</div>
	             	<div class="col-sm-3">
	             		<h6 style="margin-bottom: 20px;">Keterangan</h6>
			             <h6 style="font-weight: normal; font-size: 11px;"><a class="btn btn-sm btn-info" style="padding: 3px 6px; font-size: 10px;"><i class="glyphicon glyphicon-hourglass"></i></a> <i class="glyphicon glyphicon-play"></i> Menunggu</h6>
			             <h6 style="font-weight: normal; font-size: 11px;"><a class="btn btn-sm btn-success" style="padding: 3px 6px; font-size: 10px;"><i class="glyphicon glyphicon-play-circle"></i></a> <i class="glyphicon glyphicon-play"></i> Berlangsung</h6>
			             <h6 style="font-weight: normal; font-size: 11px;"><a class="btn btn-sm btn-danger" style="padding: 3px 6px; font-size: 10px;"><i class="glyphicon glyphicon-remove"></i></a> <i class="glyphicon glyphicon-play"></i> Tidak ada aktivitas</h6>


	             	</div>
	             </div>

	             

             </div>

            <br><br>


            </div> <!-- End Main-content -->

          </div>


        </div> <!-- End box-dashboard -->

      </div>
    </div>
    

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo BASE_URL ?>assets/js/bootstrap.min.js"></script>
  </body>
</html>
