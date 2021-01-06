<?php  

	// Connection
	require_once '../../config/connection.php';

	// Helper
	require_once '../../config/helper.php';

  // User Access 
  userAccess('staff');

  // Get all activity only id Sign In
  $userNim       = $_SESSION['user'];
  $tblActivity   = mysqli_query($link, "SELECT * FROM aktivitas WHERE penggunaNim='$userNim'");

  // Validation
  if (mysqli_num_rows($tblActivity) == 0) {
    $checking = false;
  } else {
    $checking = true;
    $totalActivity = mysqli_num_rows($tblActivity);
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>My Activity - <?php echo np; ?></title>

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

                <h5 name="title-dashboard" style="margin-bottom: 0px;"><i class="glyphicon glyphicon-time"></i> Activity Log</h5>
                 <h6 class="status-history">Dashboard <i class="glyphicon glyphicon-menu-right"></i> <span class="text-primary">My Activity</span></h6>

                <div class="box-myactivity">


                <?php  

                  if (!$checking) {

                ?>

                  <div class="no-activity text-muted">
                    <i class="glyphicon glyphicon-minus-sign"></i>
                    <h4>Anda belum memiliki aktivitas</h4>
                  </div>

                <?php
                  }

                  $me = $_SESSION['user'];
                  $read = mysqli_query($link, "SELECT * FROM aktivitas WHERE penggunaNim='$me' ORDER BY waktu DESC LIMIT 5");

                  while ($aktivitas = mysqli_fetch_assoc($read)) {
                    // Format aktivitas
                    switch ($aktivitas['aktivitas']) {
                      case 'add':
                        $msgAktivitas = "You has been create a schedule";
                        break;
                      case 'edit':
                        $msgAktivitas = "You has been update a schedule";
                        break;
                      case 'password':
                        $msgAktivitas = "You has been changes password.";
                        break;
                      
                      default:
                        $aktivitas = NULL;
                        break;
                    }

                    // Get date and time
                    $aktivitasDate = date('d-m-Y', strtotime($aktivitas['waktu']));
                      // Change format for only today
                      if ($aktivitasDate == date('d-m-Y')) {
                        $aktivitasDate = "Today";
                      }

                    $aktivitasTime = date('H:i:s', strtotime($aktivitas['waktu']));

                    // Show
                    echo "<div class='activity'>
                           <div class='left'>
                            <b>$aktivitasDate</b> <span class'text-muted'>$aktivitasTime</span>
                           </div>
                           <div class='right'>
                            $msgAktivitas
                           </div>
                           <div class='clear'></div>
                          </div>";

                  }


                ?>


                  
                </div> <!-- End box-myactivity -->
                <p style="margin-bottom: 0px; padding-bottom: 0px; text-align: left; opacity: 0.7; font-size: 11px; text-align: center; padding-top: 10px;"><em>[Show only 5 of <?php if($checking){ echo $totalActivity; } else { echo 0; } ?>]</em></p>

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