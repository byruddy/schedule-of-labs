<?php  

  // Connection
  require_once '../../../config/connection.php';

  // Helper
  require_once '../../../config/helper.php';

  // User Access 
  userAccess('admin');


    // Depcrytion for token 
    $nim = base64_decode($_GET['token']);

    // Get data all by token / nim
    $runQuery = mysqli_query($link, "SELECT * FROM pengguna WHERE nim=$nim");
    $data = mysqli_fetch_assoc($runQuery);

    // Validation if not exist session newPassword
    if (!isset($_SESSION['newPassword'])) {
      header('Location: '.BASE_URL.'user/manage-user/?detail='.$nim);
      exit;
    }
	
    $newPassword = $_SESSION['newPassword'];

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
              
              <?php include_once('../../template/header.php'); ?>

            </div> <!-- End dashboard-header -->
          </div>
          <!-- Sidebar and Main content -->
          <div class="row">
            <div class="col-lg-3 sidebar">
              
              <?php 
                if ($_SESSION['level'] == "staff") {
                  include_once('../../template/sidebar.php');
                } elseif ($_SESSION['level'] == "administrator") {
                  include_once('../../template/sidebarAdmin.php');
                }
              ?>

            </div> <!-- End Sidebar -->
            <div class="col-lg-9 main-content">
              <div class="container-information">
                
                <div class="box-manage-user">

                	<h5 name="title-dashboard" style="margin-bottom: 0px;"><i class="glyphicon glyphicon-retweet"></i> Reset password : <span class="text-primary"><?php echo $nim; ?></span></h5>
					<h6 class="status-history">Dashboard <i class="glyphicon glyphicon-menu-right"></i> <span class="status-history">User <i class="glyphicon glyphicon-menu-right"></i></span> <span class="status-history">Reset Password <i class="glyphicon glyphicon-menu-right"></i></span> <span class="text-primary"><?php echo $data['nama']; ?></span></h6>

					<div class="row detail-user">

						<div class="col-sm-3">
							<a href="#" class="thumbnail" style="padding: 35px;">
						      <img src="<?php echo BASE_URL ?>assets/img/key.png" alt="Photo profile">
						    </a>
						</div>
						<div class="col-sm-9">
							<div class="row">
								<div class="col-sm-12">
									<h4><?php echo ucwords($data['nama']); ?></h4>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">

                <?php  
                    //  Alert Msg-success 
                  if (isset($_SESSION['newPassword'])) {
                ?>
									<div class="alert alert-success" style="padding: 10px; margin: 0px; margin-bottom: 10px; font-size: 12px;"><strong><i class="glyphicon glyphicon-ok"></i> Berhasil, </strong>Anda telah mengatur ulang kata sandi pengguna ini.</div>

                <?php  
                  unset($_SESSION['newPassword']);
                  }
                ?>

								<form >
								  <div class="form-group">
								    <label for="exampleInputPassword1">New Password</label>
								    <input style="background-color: #d9edf7; border: 1px dotted #31708f; color: #31708f; font-weight: bold;" type="text" name="password" class="form-control" id="exampleInputPassword1" value="<?php echo $newPassword; ?>" readonly>
								   <p class="help-block" style="font-size: 11px;"><em><span class="text-danger">*</span> Silahkan dicatat untuk login kembali!</em></p></div>
								</div>		
							</div>
							<hr>
              <a href="<?php echo BASE_URL ?>user/manage-user/?detail=<?php echo $nim ?>" class="btn btn-sm btn-default btn-block">Close</a>
								</form>
						</div>
					</div>
					<br><br>
                </div>

              </div>
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