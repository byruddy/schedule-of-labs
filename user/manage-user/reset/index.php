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


    if ($data) {
      $token = true;
    } else {
      $token = false;
    }

	

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
                
            <?php  

              if (!$token) {
                include_once('../../404.php');
              }  else {


            ?>
                
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
									<div class="alert alert-warning" style="padding: 10px; margin: 0px; margin-bottom: 10px; font-style: italic; font-size: 12px;">Silahkan masukkan password Anda untuk melanjutkan proses ini.</div>
								<form action="<?php echo BASE_URL ?>config/function/reset-password.php?token=<?php echo $_GET['token']; ?>" method='POST'>
								  <div class="form-group">
								    <label for="exampleInputPassword1">Your Password</label>
								    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
								    <?php  
									  	//  Alert Msg-error 
										if (isset($_SESSION['msg-error'])) {
									?>
								    <p class="help-block" style="font-size: 11px;"><em><span class="text-danger"> <strong>Terjadi kesalahan, </strong> Kata sandi Anda salah. Silahkan coba lagi</span></em></p>
									<?php  
										unset($_SESSION['msg-error']);
										}
									?>
								  </div>
								</div>		
							</div>
							<hr>
							<div class="row">
								<div class="col-sm-3" style="padding-right: 0px; ">
									<a href="<?php echo BASE_URL.'user/manage-user/?detail='.$nim; ?>" class="btn btn-block btn-sm btn-default"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
								</div>
								<div class="col-sm-9">
									<button type="submit" class="btn btn-sm btn-primary btn-block"><i class="glyphicon glyphicon-retweet"></i> Get a new password</button>
								</div>
							</div>
								</form>
						</div>
					</div>

          <?php  
            }
          ?>
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