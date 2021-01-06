<?php  

	// Connection
	require_once '../config/connection.php';

	// Helper
	require_once '../config/helper.php';

 // No sign-in
  if (!isset($_SESSION['user'])) {
    $_SESSION['ilegal-access'] = "Sorry, you must login to access";
    header('Location: '.BASE_URL.'user/login/');
  }   

  // Get only first name
    $nim = $_SESSION['user'];
    $resQuery = mysqli_query($link, "SELECT * FROM pengguna WHERE nim='$nim'");
    $firstName = mysqli_fetch_assoc($resQuery);

    $firstName = $firstName['nama'];

    // Trim
    $arr = explode(' ', trim($firstName));

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
              
              <?php include_once('template/header.php'); ?>

            </div> <!-- End dashboard-header -->
          </div>
          <!-- Sidebar and Main content -->
          <div class="row">
            <div class="col-lg-3 sidebar">
              
              <?php 
                if ($_SESSION['level'] == "staff") {
                  include_once('template/sidebar.php');
                } elseif ($_SESSION['level'] == "administrator") {
                  include_once('template/sidebarAdmin.php');
                }
              ?>

            </div> <!-- End Sidebar -->
            <div class="col-lg-9 main-content">
              <div class="say-user">
                <h1>Hi <span class="text-primary"><?php echo ucwords($arr[0]); ?>!</span> Welcome.</h1>
                <p class="text-muted lead" style="padding-bottom: 180px; text-align: center;"><em>What do you can't do it ?!</em></p>
             
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