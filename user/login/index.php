<?php  

	// Connection
	require_once '../../config/connection.php';

	// Helper
	require_once '../../config/helper.php';



  // Get data room
  $resultRuangan = queryRead('ruangan');
 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Login for access - <?php echo np; ?></title>

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
  <body name="login">
      <div class="container">
        <div class="row">

          <div class="col-md-8 col-md-offset-2 box-login">
            <h2 name="login">Sign In</h2>
            <p name="login">Sign in to update schedule everytime!</p>
             
            <?php  
              if (isset($_SESSION['msg-error'])) {


            ?>
                <p class="text-danger" style="margin-left: 20px; margin-top: 20px;"><i class="glyphicon glyphicon-remove-circle"></i> <?php echo $_SESSION['msg-error'];; ?></p>
  
            <?php  
                unset($_SESSION['msg-error']);
                } elseif (isset($_SESSION['ilegal-access'])) {

            ?>
                <p class="text-danger" style="margin-left: 20px; margin-top: 20px;"><i class="glyphicon glyphicon-ban-circle"></i> <?php echo $_SESSION['ilegal-access'];; ?></p>

            <?php  
                unset($_SESSION['ilegal-access']);
              }
            ?>




            <form name="login" action="<?php echo BASE_URL ?>config/function/login.php" method="POST">
              <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="glyphicon glyphicon-user"></i></div>
                    <input type="text" name="nim" class="form-control" id="nim" placeholder="Access ID" required>
                  </div>
              </div>
              <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></div>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                  </div>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Room</label>
                <select name="lab-default" class="form-control">
                  <option value="">--[ Choose Room ]---</option>
                  <?php  

                    while ($row = mysqli_fetch_assoc($resultRuangan)) {
                      echo "<option value='$row[id]'>$row[nama] - $row[namaLainnya]</option>";
                    }

                  ?>
                </select>
              </div>
              <button type="submit" class="btn btn-default">Sign In</button>
            </form>
            <p class="footer" name="login">made with <code><span style="font-size: 13px;"><i class="glyphicon glyphicon-heart"></i></span></code> - created byruddy</span> <i class="glyphicon glyphicon-copyright-mark"></i> 2017 - V1.0 </p>
          </div> <!-- End box-login -->

        </div>
      </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo BASE_URL ?>assets/js/bootstrap.min.js"></script>
  </body>
</html>