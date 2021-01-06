<?php  

	// Connection
	require_once '../../config/connection.php';

	// Helper
	require_once '../../config/helper.php';

  // User Access 
  userAccess('staff');


  // Direct if no have schedule
  $me = $_SESSION['user'];
  $query = "SELECT * FROM jadwalPratikum WHERE (status='Menunggu' OR status='Berlangsung') AND (penggunaNim='$me')";
  $runQuery = mysqli_query($link, $query);
  $checking = mysqli_num_rows($runQuery);

  if ($checking < 1) {
    $_SESSION['msg-warning'] = true; 
    header('Location: '.BASE_URL.'user/schedule/create.php');
  }



  // Get last schedule only from use
  $query = "SELECT * FROM jadwalPratikum WHERE (status='Berlangsung' OR status='Menunggu') AND (penggunaNim='$me') ORDER BY tglJadwal DESC LIMIT 1";
  $runQuery = mysqli_query($link, $query);

  $schedule = mysqli_fetch_assoc($runQuery);


  // Get data room empty
  $ruanganKosong = mysqli_query($link, "SELECT * FROM ruangan WHERE id NOT IN (SELECT DISTINCT ruanganId FROM jadwalPratikum WHERE status = 'Berlangsung' or status = 'Menunggu') OR id = $schedule[ruanganId]");


  // Get name room
  $idRuangan = $schedule['ruanganId'];
  $nameRuangan = mysqli_fetch_assoc(mysqli_query($link, "SELECT nama FROM ruangan WHERE id='$idRuangan'"));
  $nameRuangan = $nameRuangan['nama'];

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

    <!-- Javascript -->
    <script>
        
        // Not yet ..

    </script>
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
                
                <!-- Header -->
                <?php include_once('../template/header.php'); ?>

            </div> <!-- End dashboard-header -->
          </div>
          <!-- Sidebar and Main content -->
          <div class="row">
            <div class="col-lg-3 sidebar" id="focus">
             
              <?php include_once('../template/sidebar.php'); ?>

            </div> <!-- End Sidebar -->
            <div class="col-lg-9 main-content" style="padding-bottom: 50px;">


              <?php  
                // Message for wrong access to update schedule
                if (isset($_SESSION['msga']) && $_SESSION['msga'] == true){
              ?>
                <div id="focus" class="alert alert-warning" style="margin-top: 20px;">
                 <i class="glyphicon glyphicon-exclamation-sign"></i> Harap, Silahkan selesaikan jadwal terlebih dahulu!
                </div>

              <?php  
                  unset($_SESSION['msga']);
                }
              ?>


                <h5 name="title-dashboard" style="margin-bottom: 0px;"><i class="glyphicon glyphicon-refresh"></i> Update a schedule </h5>
                 <h6 class="status-history">Dashboard <i class="glyphicon glyphicon-menu-right"></i> <span class="status-history">Schedule <i class="glyphicon glyphicon-menu-right"></i></span> <span class="text-primary">Update</span></h6>

                <?php  
                  // Message for success updated a schedule
                  if (isset($_SESSION['update-success'])){
                ?>
                <div class="alert alert-success" style="margin-top: 20px;">
                 <i class="glyphicon glyphicon-ok"></i> <?php echo $_SESSION['update-success']; ?>
                </div>


                <?php  
                    unset($_SESSION['update-success']);
                    // Message for success created a schedule
                  } elseif (isset($_SESSION['msg-success'])) {

                ?>
                <div id="focus" class="alert alert-success" style="margin-top: 20px;">
                 <i class="glyphicon glyphicon-ok"></i> Berhasil, Anda telah membuat jadwal baru!
                </div>

                <?php
                  unset($_SESSION['msg-success']);
                  // Message error for create a schedule is duplicated
                  } elseif (isset($_SESSION['room-duplicate'])) {
                ?>

               <div id="focus" class="alert alert-danger" style="margin-top: 20px;">
                 <i class="glyphicon glyphicon-remove"></i> Maaf, Ruangan sedang ada kegiatan !
               </div>

                <?php 
                  unset($_SESSION['room-duplicate']);
                  }
                ?>



                <table name='update-view'>
                  <thead>
                    <tr>
                      <th>Ruangan</th>
                      <th>Jurusan / Kelas / Mata Kuliah / Dosen</th>
                      <th><center>Status</center></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?php echo nameRoom($schedule['ruanganId']); ?></td>
                      <td><?php echo nameMajor($schedule['jurusanId']).' / '.$schedule['kelas'].' / '.$schedule['mataKuliah'].' / '.$schedule['namaDosen']; ?></td>
                      <td><center><a href="#" class="btn btn-<?php if($schedule['status'] == "Berlangsung"){ echo "success"; }elseif($schedule['status'] == "Menunggu"){ echo "info"; } ?>"><?php echo $schedule['status']; ?></a></center></td>
                    </tr>
                  </tbody>
                </table>

                <form name="create-schedule" action="<?php echo BASE_URL ?>config/function/update-schedule.php" method="POST">
                    <input type="hidden" name="idSchedule" value="<?php echo $schedule['id'] ?>">
                  <div class="form-group" style="margin-bottom: 5px;" style="margin-bottom: 5px;">
                    <label>Room</label>
                    <select class="form-control" name="ruanganId">
                      <?php  
                        // Set default if user choose room at sign in page
                        while ($row = mysqli_fetch_assoc($ruanganKosong)) {
                          echo "<option value='$row[id]'";

                                if ($_SESSION['lab-default'] != "" && $_SESSION['lab-default'] == $row['id']) {
                                  echo "selected";
                                } elseif ($schedule['ruanganId'] == $row['id']) {
                                  echo "selected";
                                }

                          echo ">$row[nama] - $row[namaLainnya]</option>";
                        }

                       ?>
                    </select>
                  </div>
                  <div class="form-group" style="margin-bottom: 5px;">
                    <label for="exampleInputEmail1">Major</label>
                    <select class="form-control" name="jurusanId">
                      <?php  
                        // Algorithm for choose major
                        $tblFakultas = mysqli_query($link, "SELECT id,nama FROM fakultas ORDER BY id ASC");


                        while ($fak = mysqli_fetch_assoc($tblFakultas)) {
                          echo "<optgroup label='$fak[nama]'>";
                            $tes = chooseMajor($fak['id']);
                            while ($data = mysqli_fetch_assoc($tes)) {
                              echo "<option value='$data[id]' ";

                                // Selected
                                if ($schedule['jurusanId'] == $data['id']) {
                                  echo "selected";
                                }

                              echo ">$data[nama]</option>";
                            }

                        }
                      ?>

                    </select>
                  </div>
                  <div class="form-group" style="margin-bottom: 5px;">
                    <label>Class</label>
                    <select class="form-control" name="kelas">
                      <option <?php if ($schedule['kelas'] == 'A1'){ echo "selected"; } ?>>A1</option>
                      <option <?php if ($schedule['kelas'] == 'A2'){ echo "selected"; } ?>>A2</option>
                      <option <?php if ($schedule['kelas'] == 'A3'){ echo "selected"; } ?>>A3</option>
                      <option <?php if ($schedule['kelas'] == 'A4'){ echo "selected"; } ?>>A4</option>
                      <option <?php if ($schedule['kelas'] == 'B1'){ echo "selected"; } ?>>B1</option>
                      <option <?php if ($schedule['kelas'] == 'B2'){ echo "selected"; } ?>>B2</option>
                      <option <?php if ($schedule['kelas'] == 'B3'){ echo "selected"; } ?>>B3</option>
                      <option <?php if ($schedule['kelas'] == 'B4'){ echo "selected"; } ?>>B4</option>
                    </select>
                  </div>  
                  <div class="form-group" style="margin-bottom: 5px;">
                    <label for="exampleInputPassword1">Mata Kuliah</label>
                    <input type="text" name="mataKuliah" class="form-control" id="exampleInputPassword1" placeholder="Write in here for Mata Kuliah ..." <?php echo "value='".$schedule['mataKuliah']."'"; ?>>
                  </div>
                  <div class="form-group" style="margin-bottom: 5px;">
                    <label for="exampleInputPassword1">Dosen</label>
                    <input type="text" name="namaDosen" class="form-control" id="exampleInputPassword1" placeholder="Write in here for name of Lecturer ..." <?php echo "value='".$schedule['namaDosen']."'"; ?>>
                  </div>
                  <div class="form-group" style="margin-bottom: 30px;">
                    <label>Status</label>
                    <br>
                    <label class="radio-inline">
                      <input type="radio" name="status" id="inlineRadio3" value="Menunggu" <?php if($schedule['status'] == "Menunggu"){ echo "checked"; } ?>> Menunggu
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="status" id="inlineRadio3" value="Berlangsung" <?php if($schedule['status'] == "Berlangsung"){ echo "checked"; } ?>> Berlangsung
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="status" id="inlineRadio3" value="Selesai" <?php if($schedule['status'] == "Selesai"){ echo "checked"; } ?>> Selesai
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="status" id="inlineRadio3" value="Tidak Hadir" <?php if($schedule['status'] == "Tidak Hadir"){ echo "checked"; } ?>> Tidak Hadir
                    </label>
                  </div>
                  <button type="submit" onclick="return confirm('Anda yakin ingin menyimpannya ?')"  class="btn btn-block btn-warning" style="margin-top: 10px;">Update <i class="glyphicon glyphicon-refresh"></i></button>
                </form>

               <!-- View Schedule -->
                <?php include_once('../template/schedule-view.php'); ?>



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