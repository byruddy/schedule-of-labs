<?php       

    // Get Last sign in for user
      function lastSignin($myNim) {
        global $link;
        $runQuery = mysqli_query($link, "SELECT lastSignIn FROM pengguna WHERE nim='$myNim' ORDER BY id DESC");
        $lastSignin = mysqli_fetch_assoc($runQuery);
        // Get only value
        $lastSignin = $lastSignin['lastSignIn'];
          // Get day only from db
          $dayOnlyDB = date('l', strtotime($lastSignin));
          $today     = date('l');
          // Format change
          if ($dayOnlyDB == $today) {
            $lastSignin = "Today, ".date('d/m/Y H:i:s', strtotime($lastSignin));
          } else {
            $lastSignin = date('l, d/m/Y H:i:s', strtotime($lastSignin));
          }

        return $lastSignin;

      }
    // Get name from nim
      function getMyName($myNim) {
        global $link;
        $runQuery = mysqli_query($link, "SELECT nama FROM pengguna WHERE nim='$myNim'");
        $myName = mysqli_fetch_assoc($runQuery);
        $myName = strtoupper($myName['nama']);

        // Subs if max lenght
        $check = strlen($myName);

        if ($check > 22) {
          $myName = substr($myName, 0,20);
          $myName = $myName."..";
        }

        return $myName;
      }

      // Checking create or update schedule 
      function createUpdate($myNim){
        global $link;
        $me = $myNim;

      $runQuery = mysqli_query($link, "SELECT * FROM jadwalPratikum WHERE (status='Berlangsung' OR status='Menunggu') AND (penggunaNim='$me')");

      // Checking ...
      if (mysqli_num_rows($runQuery) > 0) {
          $haveSchedule = true;
          } else {
            $haveSchedule = false;
          }
      return $haveSchedule;
      }

?>


<div class="my-account">
    <i class="glyphicon glyphicon-user"></i><h5><?php echo getMyName($_SESSION['user']); ?></h5><img src="<?php echo BASE_URL ?>assets/img/verification-symbol.png" title="Verified Account">
    <p class="text-muted"><em>[Last Sign In : <?php echo lastSignin($_SESSION['user']); ?>]</em></p>
</div> <!-- End my-account -->



  <?php  

    if (createUpdate($_SESSION['user']) == true) {


  ?>

   <a href="<?php echo BASE_URL ?>user/schedule/update.php" class="sidebar" name="menu"><div class="menu">
    <div class="row <?php if (urlActive('schedule')){ echo "text-primary"; } ?>">
      <div class="col-lg-2 text-right">
        <i class="glyphicon glyphicon-refresh"></i> 
      </div>
      <div class="col-lg-10 text-left">
         UPDATE SCHEDULE
      </div>
    </div>
  </div></a>

  <?php  

    } else {

  ?>

   <a href="<?php echo BASE_URL ?>user/schedule/create.php" class="sidebar" name="menu"><div class="menu">
    <div class="row <?php if (urlActive('schedule')){ echo "text-primary"; } ?>">
      <div class="col-lg-2 text-right">
        <i class="glyphicon glyphicon-list-alt"></i> 
      </div>
      <div class="col-lg-10 text-left">
         CREATE A SCHEDULE
      </div>
    </div>
  </div></a>

  <?php 

    }

  ?>

   <a href="<?php echo BASE_URL ?>user/my-activity/" class="sidebar" name="menu"><div class="menu">
    <div class="row <?php if (urlActive('my-activity')){ echo "text-primary"; } ?>">
      <div class="col-lg-2 text-right">
        <i class="glyphicon glyphicon-time"></i> 
      </div>
      <div class="col-lg-10 text-left">
         MY ACTIVITY
      </div>
    </div>
  </div></a>

   <a href="<?php echo BASE_URL ?>user/password/" class="sidebar" name="menu"><div class="menu">
    <div class="row <?php if (urlActive('password')){ echo "text-primary"; } ?>">
      <div class="col-lg-2 text-right">
        <i class="glyphicon glyphicon-lock"></i> 
      </div>
      <div class="col-lg-10 text-left">
        CHANGE PASSWORD
      </div>
    </div>
  </div></a>

   <a href="<?php echo BASE_URL ?>user/help/" class="sidebar" name="menu"><div class="menu">
    <div class="row <?php if (urlActive('help')){ echo 'text-primary'; } ?>">
      <div class="col-lg-2 text-right">
        <i class="glyphicon glyphicon-question-sign"></i> 
      </div>
      <div class="col-lg-10 text-left">
        HAVE A QUESTION ?
      </div>
    </div>
  </div></a>

   <a href="<?php echo BASE_URL ?>config/function/logout.php" onclick="return confirm('Are you sure, want to logout ?')" class="sidebar" name="menu"><div class="menu">
    <div class="row">
      <div class="col-lg-2 text-right">
        <i class="glyphicon glyphicon-off"></i> 
      </div>
      <div class="col-lg-10 text-left">
        LOGOUT
      </div>
    </div>
  </div></a>


