<?php  

	// Connection
	require_once 'config/connection.php';

	// Helper
	require_once 'config/helper.php';

  // Get Information
  $query = "SELECT * FROM informasi";
  $resQuery = mysqli_query($link, $query);
  $info = mysqli_fetch_assoc($resQuery);

  // Direct for user sign-ed

  if (isset($_SESSION['user'])) {
    header('Location: '.BASE_URL.'user');
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="10" >
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Informasi Pratikum Lab | Universitas Serang Raya</title>

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- My Style -->
    <link href="assets/css/mystyle.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <!-- Header -->
    <header>
      <div class="logo">
        <img src="<?php echo BASE_URL ?>assets/img/logoupt3.png">
      </div>
      <div class="text">
        <h1><em>INFORMASI PRATIKUM LAB</em><span style="font-size: 14px; padding-left: 10px;">V 1.0</span></h1>
      </div> 
      <div class="clear"></div> 
    </header>
    <div id="information-date">
      <em><h2 style="margin-top: 10px;"><?php echo hariIni().date(', d ').bulanIni().date(' Y'); ?></h2></em>
    </div> <!-- End information-date -->
    
    <div id="box-schedule">
      <div class="schedule">
        <div class="room">
          LG.001 / LAB-1 <i class="glyphicon glyphicon-play"></i>
        </div>
        <div class="content">
         <?php 
         // Run Query at helper.php
        $schedule = mysqli_fetch_assoc(getSchedule(1));
        $status = $schedule['status'];


        if ($status == 'Berlangsung' || $status == 'Menunggu') {
          $showStatus = true;

          echo $schedule['nama'].' / '.$schedule['kelas'].' / '.$schedule['mataKuliah'].' / '.$schedule['namaDosen'];

          // for style
          if ($schedule['status'] == 'Menunggu') {
            $styleS = 'm';
          } elseif ($schedule['status'] == 'Berlangsung') {
            $styleS = 'b';
          } else {
            $styleS = '';
          }

        } else {
          $showStatus = false;
          echo  "<span class='text-danger'>Tidak ada aktivitas</span>";
        
        }

         ?>
        </div>
        <div class="status">
        
          <?php  

            if ($showStatus == true) {
             echo  '<a href="#" class="'.$styleS.'">'.$schedule['status'].'</a>';
            } 

          ?>

        </div>
        <div class="clear"></div>
      </div> 
      <div class="schedule" style="background-color: white;">
        <div class="room">
          LG.002 / LAB-2 <i class="glyphicon glyphicon-play"></i>
        </div>
        <div class="content">
         <?php 
           // Run Query at helper.php
          $schedule = mysqli_fetch_assoc(getSchedule(2));
          $status = $schedule['status'];

          if ($status == 'Berlangsung' || $status == 'Menunggu') {
          $showStatus = true;

          echo $schedule['nama'].' / '.$schedule['kelas'].' / '.$schedule['mataKuliah'].' / '.$schedule['namaDosen'];

          // for style
          if ($schedule['status'] == 'Menunggu') {
            $styleS = 'm';
          } elseif ($schedule['status'] == 'Berlangsung') {
            $styleS = 'b';
          } else {
            $styleS = '';
          }

        } else {
          $showStatus = false;
          echo  "<span class='text-danger'>Tidak ada aktivitas</span>";
        }

        ?>
        </div>
        <div class="status">

          <?php  

            if ($showStatus == true) {
             echo  '<a href="#" class="'.$styleS.'">'.$schedule['status'].'</a>';
            } 

          ?>
        
        </div>
        <div class="clear"></div>
      </div> 
      <div class="schedule">
        <div class="room">
          LG.003 / LAB-3 <i class="glyphicon glyphicon-play"></i>
        </div>
        <div class="content">
          <?php 
           // Run Query at helper.php
          $schedule = mysqli_fetch_assoc(getSchedule(3));
          $status = $schedule['status'];

          if ($status == 'Berlangsung' || $status == 'Menunggu') {
          $showStatus = true;

          echo $schedule['nama'].' / '.$schedule['kelas'].' / '.$schedule['mataKuliah'].' / '.$schedule['namaDosen'];

          // for style
          if ($schedule['status'] == 'Menunggu') {
            $styleS = 'm';
          } elseif ($schedule['status'] == 'Berlangsung') {
            $styleS = 'b';
          } else {
            $styleS = '';
          }

        } else {
          $showStatus = false;
          echo  "<span class='text-danger'>Tidak ada aktivitas</span>";
        }

        ?>
        </div>
        <div class="status">

          <?php  

            if ($showStatus == true) {
             echo  '<a href="#" class="'.$styleS.'">'.$schedule['status'].'</a>';
            } 

          ?>

        </div>
        <div class="clear"></div>
      </div> 
      <div class="schedule"  style="background-color: white;">
        <div class="room">
          LG.004 / LAB-4 <i class="glyphicon glyphicon-play"></i>
        </div>
        <div class="content">
          <?php 
           // Run Query at helper.php
          $schedule = mysqli_fetch_assoc(getSchedule(4));
          $status = $schedule['status'];

          if ($status == 'Berlangsung' || $status == 'Menunggu') {
          $showStatus = true;

          echo $schedule['nama'].' / '.$schedule['kelas'].' / '.$schedule['mataKuliah'].' / '.$schedule['namaDosen'];

          // for style
          if ($schedule['status'] == 'Menunggu') {
            $styleS = 'm';
          } elseif ($schedule['status'] == 'Berlangsung') {
            $styleS = 'b';
          } else {
            $styleS = '';
          }

        } else {
          $showStatus = false;
          echo  "<span class='text-danger'>Tidak ada aktivitas</span>";
        }

        ?>
        </div>
        <div class="status">
           <?php  

            if ($showStatus == true) {
             echo  '<a href="#" class="'.$styleS.'">'.$schedule['status'].'</a>';
            } 

          ?>
        </div>
        <div class="clear"></div>
      </div> 
      <div class="schedule">
        <div class="room">
          LG.005 / LAB-5 <i class="glyphicon glyphicon-play"></i>
        </div>
        <div class="content">
          <?php 
           // Run Query at helper.php
          $schedule = mysqli_fetch_assoc(getSchedule(5));
          $status = $schedule['status'];

          if ($status == 'Berlangsung' || $status == 'Menunggu') {
          $showStatus = true;

          echo $schedule['nama'].' / '.$schedule['kelas'].' / '.$schedule['mataKuliah'].' / '.$schedule['namaDosen'];

          // for style
          if ($schedule['status'] == 'Menunggu') {
            $styleS = 'm';
          } elseif ($schedule['status'] == 'Berlangsung') {
            $styleS = 'b';
          } else {
            $styleS = '';
          }

        } else {
          $showStatus = false;
          echo  "<span class='text-danger'>Tidak ada aktivitas</span>";
        }

        ?>
        </div>
        <div class="status">
           <?php  

            if ($showStatus == true) {
             echo  '<a href="#" class="'.$styleS.'">'.$schedule['status'].'</a>';
            } 

          ?>
        </div>
        <div class="clear"></div>
      </div> 
      <div class="schedule"  style="background-color: white;">
        <div class="room">
          LG.HARDSOFT <i class="glyphicon glyphicon-play"></i>
        </div>
        <div class="content">
          <?php 
           // Run Query at helper.php
          $schedule = mysqli_fetch_assoc(getSchedule(6));
          $status = $schedule['status'];

          if ($status == 'Berlangsung' || $status == 'Menunggu') {
          $showStatus = true;

          echo $schedule['nama'].' / '.$schedule['kelas'].' / '.$schedule['mataKuliah'].' / '.$schedule['namaDosen'];

          // for style
          if ($schedule['status'] == 'Menunggu') {
            $styleS = 'm';
          } elseif ($schedule['status'] == 'Berlangsung') {
            $styleS = 'b';
          } else {
            $styleS = '';
          }

        } else {
          $showStatus = false;
          echo  "<span class='text-danger'>Tidak ada aktivitas</span>";
        }

        ?>
        </div>
        <div class="status">
           <?php  

            if ($showStatus == true) {
             echo  '<a href="#" class="'.$styleS.'">'.$schedule['status'].'</a>';
            } 

          ?>
        </div>
        <div class="clear"></div>
      </div> 


    </div>  <!-- End box-schedule -->

    <footer>
      <div class="left">
        Seputar Info
      </div>
      <div class="right">
        <marquee><?php echo $info['textIndex']; ?></marquee>
      </div>
    <div class="clear"></div>
    </footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>