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

  if ($checking > 0) {
    $_SESSION['msga'] = true; 
    header('Location: '.BASE_URL.'user/schedule/update.php#focus');
  }


  // Get data room empty
  $ruanganKosong = mysqli_query($link, "SELECT * FROM ruangan WHERE id NOT IN (SELECT DISTINCT ruanganId FROM jadwalPratikum WHERE status = 'Berlangsung' or status = 'Menunggu')");



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Create a Schedule - <?php echo np; ?></title>

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
            <div class="col-lg-3 sidebar">
             
              <?php include_once('../template/sidebar.php'); ?>

            </div> <!-- End Sidebar -->
            <div class="col-lg-9 main-content">

              <?php  
                // Message for wrong access to update schedule
                if (isset($_SESSION['msg-warning']) && $_SESSION['msg-warning'] == true){
              ?>
                <div class="alert alert-warning" style="margin-top: 20px;">
                 <i class="glyphicon glyphicon-exclamation-sign"></i> Silahkan membuat jadwal terlebih dahulu
                </div>

              <?php  
                  unset($_SESSION['msg-warning']);
                }

              ?>

              <?php  
                // Message for wrong create schedule
                if (isset($_SESSION['msg-error']) && $_SESSION['msg-error'] == true){
              ?>
                <div id="focus" class="alert alert-danger" style="margin-top: 20px;">
                 <i class="glyphicon glyphicon-remove"></i> Maaf, <?php echo $_SESSION['msg-error']; ?>
                </div>

              <?php  
                  unset($_SESSION['msg-error']);
                }

              ?>

                <h5 name="title-dashboard" style="margin-bottom: 0px;"><i class="glyphicon glyphicon-pencil"></i> Create a new </h5>
                 <h6 class="status-history">Dashboard <i class="glyphicon glyphicon-menu-right"></i> <span class="status-history">Schedule <i class="glyphicon glyphicon-menu-right"></i></span> <span class="text-primary">Create a new</span></h6>

                <?php  
                  // Message for wrong access to update schedule
                  if (isset($_SESSION['update-success'])){
                ?>
                <div class="alert alert-success" style="margin-top: 20px;">
                 <i class="glyphicon glyphicon-ok"></i> <?php echo $_SESSION['update-success']; ?>
                </div>


                <?php  
                    unset($_SESSION['update-success']);
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



                <form name="create-schedule" action="<?php echo BASE_URL ?>user/direct.php" method="GET">
                  <div class="form-group" style="margin-bottom: 5px;" style="margin-bottom: 5px;">
                    <label>Room</label>
                    <select class="form-control" name="ruangan">
                      <option value="">--[Choose Room]--</option>
                      <?php  
                        // Set default if user choose room at sign in page
                        while ($row = mysqli_fetch_assoc($ruanganKosong)) {
                          echo "<option value='$row[id]'";

                                if ($_SESSION['lab-default'] != "" && $_SESSION['lab-default'] == $row['id']) {
                                  echo "selected";
                                } elseif (isset($_GET['ruangan']) && $_GET['ruangan'] == $row['id']) {
                                  echo "selected";
                                }


                          echo ">$row[nama] - $row[namaLainnya]";

                          echo "</option>";
                        }

                       ?>
                    </select>
                  </div>
                  <div class="form-group" style="margin-bottom: 5px;">
                    <label for="exampleInputEmail1">Major</label>
                    <select class="form-control" name="jurusan">
                      <option value="">---[Choose Majors]---</option>
                      <?php  
                        // Algorithm for choose major
                        $tblFakultas = mysqli_query($link, "SELECT id,nama FROM fakultas ORDER BY id ASC");


                        while ($fak = mysqli_fetch_assoc($tblFakultas)) {
                          echo "<optgroup label='$fak[nama]'>";
                            $tes = chooseMajor($fak['id']);
                            
                            while ($data = mysqli_fetch_assoc($tes)) {
                              echo "<option value='$data[id]' ";

                                if (isset($_GET['jurusan']) && $_GET['jurusan'] == $data['id']) {
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
                      <option value="">--[Choose Classes]--</option>
                      <option value="A1" <?php if (isset($_GET['kelas']) && $_GET['kelas'] == "A1"){ echo 'selected'; } ?>>A1</option>
                      <option value="A2" <?php if (isset($_GET['kelas']) && $_GET['kelas'] == "A2"){ echo 'selected'; } ?>>A2</option>
                      <option value="A3" <?php if (isset($_GET['kelas']) && $_GET['kelas'] == "A3"){ echo 'selected'; } ?>>A3</option>
                      <option value="A4" <?php if (isset($_GET['kelas']) && $_GET['kelas'] == "A4"){ echo 'selected'; } ?>>A4</option>
                      <option value="A5" <?php if (isset($_GET['kelas']) && $_GET['kelas'] == "A5"){ echo 'selected'; } ?>>A5</option>
                      <option value="B1" <?php if (isset($_GET['kelas']) && $_GET['kelas'] == "B1"){ echo 'selected'; } ?>>B1</option>
                      <option value="B2" <?php if (isset($_GET['kelas']) && $_GET['kelas'] == "B2"){ echo 'selected'; } ?>>B2</option>
                      <option value="B3" <?php if (isset($_GET['kelas']) && $_GET['kelas'] == "B3"){ echo 'selected'; } ?>>B3</option>
                      <option value="B4" <?php if (isset($_GET['kelas']) && $_GET['kelas'] == "B4"){ echo 'selected'; } ?>>B4</option>
                      <option value="B5" <?php if (isset($_GET['kelas']) && $_GET['kelas'] == "B5"){ echo 'selected'; } ?>>B5</option>
                    </select>
                  </div>  
                  <div class="form-group" style="margin-bottom: 5px;">
                    <label for="mataKuliah">Mata Kuliah</label>
                    <input type="text" class="form-control" id="mataKuliah" name="mataKuliah" placeholder="Write in here for Mata Kuliah ..." required value="<?php if (isset($_GET['mataKuliah'])){ echo $_GET['mataKuliah']; } ?>">
                  </div>
                  <div class="form-group" style="margin-bottom: 5px;">
                    <label for="lecturer">Dosen</label>
                    <input type="text" class="form-control" id="lecturer" name="dosen" placeholder="Write in here for name of Lecturer ..." required value="<?php if (isset($_GET['mataKuliah'])){ echo $_GET['dosen']; } ?>" autocomplete="off">
                  </div>
                  <div class="form-group" style="margin-bottom: 30px;">
                    <label>Status</label>
                    <br>
                    <label class="radio-inline">
                      <input type="radio" name="status" id="inlineRadio2" value="Menunggu" <?php if (isset($_GET['status']) && $_GET['status'] == "Menunggu"){ echo "checked"; } elseif(!isset($_GET['status'])){ echo "checked"; } ?>> Menunggu
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="status" id="inlineRadio3" value="Berlangsung" <?php if (isset($_GET['status']) && $_GET['status'] == "Berlangsung"){ echo "checked"; } ?>> Berlangsung
                    </label>
                  </div>
                  <button type="submit" class="btn btn-block btn-success" style="margin-top: 10px;">Update <i class="glyphicon glyphicon-refresh"></i></button>
                </form>


                <!-- View Schedule -->
                <?php include_once('../template/schedule-view.php'); ?>

                <br>
                <br>
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

<?php  
  
  // Close connection
  mysqli_close($link);

?>