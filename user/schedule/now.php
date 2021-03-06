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
               
             <h5 name="title-dashboard" style="margin-bottom: 0px;"><i class="glyphicon glyphicon-list-alt"></i> Schedule now </h5>
             <h6 class="status-history">Dashboard <i class="glyphicon glyphicon-menu-right"></i> <span class="status-history">Schedule <i class="glyphicon glyphicon-menu-right"></i></span> <span class="text-primary">Up to date</span></h6>

              <table name="view-dashboard-admin" class="table">
                <thead>
                  <tr>
                    <th class="text-center">Ruangan</th>
                    <th>Mata kuliah / Dosen / Smt</th>
                    <th class="text-center">Aslab</th>
                    <th class="text-center">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr style="background-color: #3498DB;">
                    <td class="text-center">LG.001</td>
                    <td>T. Industri / A3 / Pem. Komputer / Darpi Supriyanto</td>
                    <td class="text-center">Ruddy</td>
                    <td class="text-center">Menunggu</td>
                  </tr>
                  <tr style="background-color: #01C26E;">
                    <td class="text-center">LG.002</td>
                    <td>SI / B1 / Visual Basic.Net / Agus Setyawan</td>
                    <td class="text-center">Angga</td>
                    <td class="text-center">Berlangsung</td>
                  </tr>
                  <tr style="background-color: #E24C3F;">
                    <td class="text-center">LG.003</td>
                    <td>Tidak ada aktivitas</td>
                    <td class="text-center">-</td>
                    <td class="text-center">-</td>
                  </tr>
                  <tr style="background-color: #3498DB;">
                    <td class="text-center">LG.004</td>
                    <td>T. Sipil / B1 / AutoCAD / Ovy Wahyuni</td>
                    <td class="text-center">Rizky</td>
                    <td class="text-center">Menunggu</td>
                  </tr>
                  <tr style="background-color: #01C26E;">
                    <td class="text-center">LG.005</td>
                    <td>SK / B2 / Mikrotik / Rudianto</td>
                    <td class="text-center">Illa</td>
                    <td class="text-center">Berlangsung</td>
                  </tr>
                  <tr style="background-color: #3498DB;">
                    <td class="text-center">LG.HD</td>
                    <td>T. Industri / A3 / Pem. Komputer / Darpi Supriyanto</td>
                    <td class="text-center">Alfian</td>
                    <td class="text-center">Menunggu</td>
                  </tr>
                </tbody>
              </table>

                <br><br><br><br><br><br><br><br><br>
                <br><br><br><br><br><br><br><br><br>

              </div> <!-- End #MyDIV -->

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