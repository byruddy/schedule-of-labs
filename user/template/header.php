<?php  
	// Get Information
	$query = "SELECT * FROM informasi";
	$resQuery = mysqli_query($link, $query);
	$info = mysqli_fetch_assoc($resQuery);
?>

<div class="row">
    <a href="<?php echo BASE_URL ?>user"><div class="col-lg-3 logo">
      <img src="<?php echo BASE_URL ?>assets/img/logoupt3.png">
    </div></a>
    <div class="col-lg-9 info">
      <marquee><p><?php echo $info['textDashboard']; ?></p></marquee>
    </div>
</div>
