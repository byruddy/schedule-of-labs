<?php  

	// Connection
	require_once '../config/connection.php';

	// Helper
	require_once '../config/helper.php';

  // User Access 
  userAccess('staff');

  // Data Form
  $dataForm = http_build_query($_GET);

  // Validation Form
  $isValid = true;

  $msg = "";
  if ($_GET['ruangan'] == "") {
    $isValid = false;
    $msg    .= "Silahkan pilih <b>Ruangan</b> terlebih dahulu!";
  } elseif ($_GET['jurusan'] == "") {
    $isValid = false;
    $msg    .= "Silahkan pilih <b>Jurusan</b> terlebih dahulu!";
  } elseif ($_GET['kelas'] == "") {
    $isValid = false;
    $msg    .= "Silahkan pilih <b>Kelas</b> terlebih dahulu!";
  } elseif ($_GET['mataKuliah'] == "") {
    $isValid = false;
    $msg    .= "Harap mengisi <b>Mata Kuliah</b> terlebih dahulu!";
  } elseif ($_GET['dosen'] == "") {
    $isValid = false;
    $msg    .= "Harap mengisi nama <b>Dosen</b> terlebih dahulu!";
  } elseif (strlen($_GET['mataKuliah']) < 3) {
    $isValid = false;
    $msg    .= "<b>Mata Kuliah</b> tidak boleh kurang dari 3 huruf!";
  } elseif (strlen($_GET['dosen']) < 3) {
    $isValid = false;
    $msg    .= "<b>Nama Dosen</b> tidak boleh kurang dari 3 huruf!";
  }

   if ($isValid == false) {
    $_SESSION['msg-error'] = $msg;
    header('Location: '.BASE_URL.'user/schedule/create.php?'.$dataForm.'#focus');
  }


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Create a Schedule (Review) - <?php echo np; ?></title>

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
        
        <!-- Main Content -->
        <div class="col-lg-8 col-lg-offset-2 box-direct" style="padding: 0px;">

            <div class="top">
              <img src="<?php echo BASE_URL ?>assets/img/logoupt3.png">
            </div>
            <p class="text-center lead" name="top">Langkah terakhir : klik simpan jika data jadwal benar.</p>

            <div class="progress" style="margin: 0px 30px; margin-bottom: 35px;">
              <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 99%;">
                99%
              </div>
            </div>

            <div class="box-table"> 
              <table class="table table-bordered table-striped">
              
                <tr>
                  <th>Ruangan</th>
                  <th>Jurusan / Kelas / Matakuliah / Dosen</th>
                  <th><center>Status</center></th>
                </tr>
                <tr>
                  <td><?php echo nameRoom($_GET['ruangan']); ?></td>
                  <td><?php echo nameMajor($_GET['jurusan']); ?> / <?php echo $_GET['kelas']; ?>  / <?php echo $_GET['mataKuliah']; ?> / <?php echo $_GET['dosen'] ?></td>
                  <td><center><a href="#" class="btn btn-<?php if($_GET['status'] == "Menunggu"){ echo "info"; } else { echo "success"; } ?> btn-sm"><?php echo $_GET['status']; ?></a></center></td>
                </tr>
              </table>
            </div>

            <div class="row bottom">
              <div class="col-sm-7">
                <p><i class="glyphicon glyphicon-eye-open"></i> Please check back the schedule you have made</p>
              </div>
              <div class="col-sm-5" style="text-align: right;">
                <a href="<?php echo BASE_URL ?>user/" class="btn btn-default">Batal</a>
                <a href="<?php echo BASE_URL ?>user/schedule/create.php?<?php echo $dataForm ?>" class="btn btn-warning">Ubah</a>
                <a href="<?php echo BASE_URL ?>config/function/create-schedule.php?<?php echo $dataForm ?>" class="btn btn-success">Simpan</a>
              </div>
            </div>
        
        </div>


      </div>
    </div>
    

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo BASE_URL ?>assets/js/bootstrap.min.js"></script>
  </body>
</html>