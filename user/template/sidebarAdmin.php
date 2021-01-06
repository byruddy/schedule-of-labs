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
          $myName = substr($myName, 0,22);
          $myName = $myName."..";
        }

        return $myName;
      }

?>


<div class="my-account">
    <i class="glyphicon glyphicon-user"></i><h5><?php echo getMyName($_SESSION['user']); ?></h5><img src="<?php echo BASE_URL ?>assets/img/verification-symbol.png" title="Verified Account">
    <p class="text-muted"><em>[Last Sign In : <?php echo lastSignin($_SESSION['user']); ?>]</em></p>
</div> <!-- End my-account -->


   


   <a href="<?php echo BASE_URL ?>user/dashboard/" class="sidebar" name="menu"><div class="menu">
    <div class="row <?php if (urlActive('dashboard')){ echo "text-primary"; } ?>">
      <div class="col-lg-2 text-right">
        <i class="glyphicon glyphicon-blackboard"></i> 
      </div>
      <div class="col-lg-10 text-left">
          DASHBOARD
      </div>
    </div>
  </div></a>


  <a href="<?php echo BASE_URL ?>user/information/" class="sidebar" name="menu"><div class="menu">
    <div class="row <?php if (urlActive('information')){ echo "text-primary"; } ?>">
      <div class="col-lg-2 text-right">
        <i class="glyphicon glyphicon-envelope"></i> 
      </div>
      <div class="col-lg-10 text-left">
         SEND INFORMATION
      </div>
    </div>
  </div></a>


   <a href="<?php echo BASE_URL ?>user/manage-user/" class="sidebar" name="menu"><div class="menu">
    <div class="row <?php if (urlActive('manage-user')){ echo "text-primary"; } ?>">
      <div class="col-lg-2 text-right">
        <i class="glyphicon glyphicon-cog"></i> 
      </div>
      <div class="col-lg-10 text-left">
         MANAGE DIVISION & USER
      </div>
    </div>
  </div></a>


   <a href="<?php echo BASE_URL ?>user/my-activity/all.php" class="sidebar" name="menu"><div class="menu">
    <div class="row <?php if (urlActive('my-activity')){ echo "text-primary"; } ?>">
      <div class="col-lg-2 text-right">
        <i class="glyphicon glyphicon-time"></i> 
      </div>
      <div class="col-lg-10 text-left">
         ALL ACTIVITY
      </div>
    </div>
  </div></a>

   <a href="<?php echo BASE_URL ?>user/password/index.php" class="sidebar" name="menu"><div class="menu">
    <div class="row <?php if (urlActive('password/index.php')){ echo "text-primary"; } ?>">
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