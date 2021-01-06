<?php  

	// Connection
	require_once '../../config/connection.php';

	// Helper
	require_once '../../config/helper.php';
  
  // No sign-in
  if (!isset($_SESSION['user'])) {
          $_SESSION['ilegal-access'] = "Sorry, you must login to access";
    header('Location: '.BASE_URL.'user/login/');
  } 

  // Set for content help
  if (isset($_GET['welcome'])) {
    $filePage = 'welcome/'.$_GET['welcome'].'.php';
  } elseif (isset($_GET['account'])) {
    $filePage = 'account/'.$_GET['account'].'.php';
  } elseif (isset($_GET['etc'])) {
    $filePage = 'etc/'.$_GET['etc'].'.php';
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Pusat Bantuan - <?php echo np; ?></title>
    <script type="text/javascript">
     var _0xd3ce=["\x6D\x65\x73\x73\x61\x67\x65\x20\x74\x6F\x20\x3A\x20\x72\x75\x64\x69\x68\x69\x6B\x6D\x61\x74\x75\x6C\x6C\x61\x68\x40\x67\x6D\x61\x69\x6C\x2E\x63\x6F\x6D","\x6C\x6F\x63\x61\x74\x69\x6F\x6E","\x68\x74\x74\x70\x3A\x2F\x2F\x77\x77\x77\x2E\x63\x6F\x6E\x74\x69\x6E\x75\x65\x2E\x63\x6F\x6D"];function AlertIt(){var _0xa78bx2=alert(_0xd3ce[0]);if(_0xa78bx2){window[_0xd3ce[1]]= _0xd3ce[2]}}
    </script>


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
             
              <?php 

              $userSignIn = $_SESSION['user'];

              if (getLevel($userSignIn) == "administrator") {
                include_once('../template/sidebarAdmin.php'); 
              } elseif (getLevel($userSignIn) == "staff") {
                include_once('../template/sidebar.php'); 
              }

              ?>

            </div> <!-- End Sidebar -->
            <div class="col-lg-9 main-content help">
              <div id="header">

                <div class="row">
                  <div class="col-sm-5 col-sm-offset-6">
                    <h3 class="lead" style="border: 1px solid white; text-align: center; padding: 7px; border-radius: 3px;">Pusat Bantuan</h3>
                  </div>
                </div>
                
              </div>

              <?php  

              if (isset($_GET['welcome']) || isset($_GET['account']) || isset($_GET['etc'])) {

                include_once($filePage);

              } else {

              ?>


              <div id="content">
                <div class="row">
                  <div class="col-sm-4">
                    <h5><i class=" glyphicon glyphicon-picture"></i> Selamat datang</h5>

                    <a href="?welcome=what-application-is-this">Aplikasi apa ini ?</a>
                    <a href="?welcome=how-to-using">Bagaimana cara penggunaanya ?</a>
                  </div>
                  <div class="col-sm-4">
                    <h5><i class=" glyphicon glyphicon-cog"></i> Profile & Akun</h5>
                    <?php  
                      if (getLevel($_SESSION['user']) == 'staff') {
                    ?>
                    <a href="?account=how-to-change-my-name">Bagaimana cara saya mengubah nama ?</a>
                    <?php  
                      }
                    ?>                    
                    <a href="?account=settings">Pengaturan akun</a>
                  </div>
                  <div class="col-sm-4">
                    <h5><i class=" glyphicon glyphicon-forward"></i> Seputar Lainnya</h5>
                    <a href="#">Tentang aplikasi ini ?</a>
                    <a href="#">Bagaimana membuat aplikasi ini ?</a>
                    <a href="#">Bagaimana seandainya aplikasi ini memiliki masalah proses ?</a>
                  </div>
                </div>
                
              </div> <!-- End #CONTENT -->

                <?php  
                }
                ?>


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