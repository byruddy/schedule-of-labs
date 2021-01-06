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

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Change Password - <?php echo np; ?></title>

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
                if ($_SESSION['level'] == "staff") {
                  include_once('../template/sidebar.php');
                } elseif ($_SESSION['level'] == "administrator") {
                  include_once('../template/sidebarAdmin.php');
                }
              ?>

            </div> <!-- End Sidebar -->
            <div class="col-lg-9 main-content">

              <div class="box-password">
                
                <h5 name="title-dashboard" style="margin-bottom: 0px;"><i class="glyphicon glyphicon-lock"></i> Change Password</h5>
                <h6 class="status-history">Dashboard <i class="glyphicon glyphicon-menu-right"></i> <span class="text-primary">Change Password</span></h6>

                <div class="alert alert-warning alert-sm">
                  <i class="glyphicon glyphicon-info-sign"></i> Please protect your password, just as you protect your future :)
                </div>

                <?php  

                  if (isset($_SESSION['msg-success'])) {

                ?>
                  <div class="alert alert-success alert-sm">
                    <i class="glyphicon glyphicon-ok"></i> <?php echo $_SESSION['msg-success']; ?>
                  </div>

                <?php  
                  unset($_SESSION['msg-success']);
                  } elseif (isset($_SESSION['msg-error'])) {

                ?>
                  <div class="alert alert-danger alert-sm">
                    <i class="glyphicon glyphicon-remove"></i> <?php echo $_SESSION['msg-error']; ?>
                  </div>

                <?php
                  unset($_SESSION['msg-error']);  
                  }
                ?>



                <form name="password" action="<?php echo BASE_URL ?>config/function/change-password.php" method="POST">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Current</label>
                    <input type="password" name="current" class="form-control" id="exampleInputEmail1" placeholder="Current" maxlength="20">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">New</label>
                    <input type="password" class="form-control" name="new" id="exampleInputPassword1" placeholder="New Password" maxlength="20">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Re-type new</label>
                    <input type="password" name="renew" class="form-control" id="exampleInputPassword1" placeholder="Re-type New Password" maxlength="20">
                  </div>
                  <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                </form>

                <br>
              </div>

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