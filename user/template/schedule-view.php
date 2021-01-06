
 <h5 name="title-dashboard"><i class="glyphicon glyphicon-list-alt"></i> Schedule now </h5>

  <script>
      
      // Function for toggle schedule
      function myFunction() {
          var x = document.getElementById("myDIV");
          if (x.style.display === "none") {
              x.style.display = "block";
          } else {
              x.style.display = "none";
          }
      }
    
  </script>


  <button onclick="myFunction()" style="font-size: 11px;">Close/View Schedule</button>
  <br><br>
  <div id="myDIV" style="display: block; margin-top: 10px;">

   <table name="view-dashboard" style="border-collapse: collapse; width: 100%;">
                <thead>
                  <tr>
                    <th class="text-center">Ruang</th>
                    <th>Jurusan/Kelas/MK/Dosen</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Aslab</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-center">LG.001</td>
                     <?php 
                   // Run Query at helper.php
                  $schedule = mysqli_fetch_assoc(getSchedule(1));
                  $status = $schedule['status'];


                  if ($status == 'Berlangsung' || $status == 'Menunggu') {
                    $showStatus = true;

                    // function only get name
                    echo '<td>'.$schedule['nama'].' / '.$schedule['kelas'].' / '.$schedule['mataKuliah'].' / '.$schedule['namaDosen'].'</td>';

                    // for style
                    if ($schedule['status'] == 'Menunggu') {
                      $bg   =  'info';
                      $icon   =  'hourglass';
                    } elseif ($schedule['status'] == 'Berlangsung') {
                      $bg   = 'success';
                      $icon   = 'play-circle';
                    } else {
                      $bg   = 'danger';
                      $icon   = 'remove';
                    }

                    echo "<td class='text-center'><a class='btn btn-sm btn-$bg' style='padding: 3px 6px; font-size: 10px;'> <i class='glyphicon glyphicon-$icon'></i></a></td>";

                    echo "<td class='text-center'>".nameOnly($schedule['penggunaNim'])."</td>";

                  } else {
                    $showStatus = false;
                    $bg     = 'danger';
                    $icon   = 'remove';

                    echo  "<td><span class='text-danger'>Tidak ada aktivitas</span></td>";

                    echo "<td class='text-center'><a class='btn btn-sm btn-$bg' style='padding: 3px 6px; font-size: 10px;'> <i class='glyphicon glyphicon-$icon'></i></a></td>";

                    echo "<td class='text-center text-danger'>-</td>";
                  
                  }

                   ?>
                  </tr>
                  <tr>
                    <td class="text-center">LG.002</td>

                     <?php 
                   // Run Query at helper.php
                  $schedule = mysqli_fetch_assoc(getSchedule(2));
                  $status = $schedule['status'];


                  if ($status == 'Berlangsung' || $status == 'Menunggu') {
                    $showStatus = true;

                    // function only get name
                    echo '<td>'.$schedule['nama'].' / '.$schedule['kelas'].' / '.$schedule['mataKuliah'].' / '.$schedule['namaDosen'].'</td>';

                    // for style
                    if ($status == 'Menunggu') {
                      $bg   =  'info';
                      $icon   =  'hourglass';
                    } elseif ($status == 'Berlangsung') {
                      $bg   = 'success';
                      $icon   = 'play-circle';
                    } 

                    echo "<td class='text-center'><a class='btn btn-sm btn-$bg' style='padding: 3px 6px; font-size: 10px;'> <i class='glyphicon glyphicon-$icon'></i></a></td>";

                    echo "<td class='text-center'>".nameOnly($schedule['penggunaNim'])."</td>";

                  } else {
                    $showStatus = false;
                    $bg     = 'danger';
                    $icon   = 'remove';

                    echo  "<td><span class='text-danger'>Tidak ada aktivitas</span></td>";

                    echo "<td class='text-center'><a class='btn btn-sm btn-$bg' style='padding: 3px 6px; font-size: 10px;'> <i class='glyphicon glyphicon-$icon'></i></a></td>";

                    echo "<td class='text-center text-danger'>-</td>";

                  }

                   ?>
                    <!-- <td>SI / B1 / Visual Basic.Net / Agus Setyawan</td> -->
                    <!-- <td class="text-center"><a class="btn btn-sm btn-success" style="padding: 3px 6px; font-size: 10px;"> <i class="glyphicon glyphicon-play-circle"></i></a></td> -->
                    <!-- <td class="text-center"><a href="#" title="Angga Firmansyah">112-15-072</a></td> -->
                  </tr>
                  <tr>
                    <td class="text-center">LG.003</td>
                     <?php 
                   // Run Query at helper.php
                  $schedule = mysqli_fetch_assoc(getSchedule(3));
                  $status = $schedule['status'];


                  if ($status == 'Berlangsung' || $status == 'Menunggu') {
                    $showStatus = true;

                    // function only get name
                    echo '<td>'.$schedule['nama'].' / '.$schedule['kelas'].' / '.$schedule['mataKuliah'].' / '.$schedule['namaDosen'].'</td>';

                    // for style
                    if ($status == 'Menunggu') {
                      $bg   =  'info';
                      $icon   =  'hourglass';
                    } elseif ($status == 'Berlangsung') {
                      $bg   = 'success';
                      $icon   = 'play-circle';
                    } 

                    echo "<td class='text-center'><a class='btn btn-sm btn-$bg' style='padding: 3px 6px; font-size: 10px;'> <i class='glyphicon glyphicon-$icon'></i></a></td>";

                    echo "<td class='text-center'>".nameOnly($schedule['penggunaNim'])."</td>";

                  } else {
                    $showStatus = false;
                    $bg     = 'danger';
                    $icon   = 'remove';

                    echo  "<td><span class='text-danger'>Tidak ada aktivitas</span></td>";

                    echo "<td class='text-center'><a class='btn btn-sm btn-$bg' style='padding: 3px 6px; font-size: 10px;'> <i class='glyphicon glyphicon-$icon'></i></a></td>";

                    echo "<td class='text-center text-danger'>-</td>";

                  }

                   ?>
                  </tr>
                  <tr>
                    <td class="text-center">LG.004</td>
                     <?php 
                   // Run Query at helper.php
                  $schedule = mysqli_fetch_assoc(getSchedule(4));
                  $status = $schedule['status'];


                  if ($status == 'Berlangsung' || $status == 'Menunggu') {
                    $showStatus = true;

                    // function only get name
                    echo '<td>'.$schedule['nama'].' / '.$schedule['kelas'].' / '.$schedule['mataKuliah'].' / '.$schedule['namaDosen'].'</td>';

                    // for style
                    if ($status == 'Menunggu') {
                      $bg   =  'info';
                      $icon   =  'hourglass';
                    } elseif ($status == 'Berlangsung') {
                      $bg   = 'success';
                      $icon   = 'play-circle';
                    } 

                    echo "<td class='text-center'><a class='btn btn-sm btn-$bg' style='padding: 3px 6px; font-size: 10px;'> <i class='glyphicon glyphicon-$icon'></i></a></td>";

                    echo "<td class='text-center'>".nameOnly($schedule['penggunaNim'])."</td>";

                  } else {
                    $showStatus = false;
                    $bg     = 'danger';
                    $icon   = 'remove';

                    echo  "<td><span class='text-danger'>Tidak ada aktivitas</span></td>";

                    echo "<td class='text-center'><a class='btn btn-sm btn-$bg' style='padding: 3px 6px; font-size: 10px;'> <i class='glyphicon glyphicon-$icon'></i></a></td>";

                    echo "<td class='text-center text-danger'>-</td>";

                  }

                   ?>

                  </tr>
                  <tr>
                    <td class="text-center">LG.005</td>
                     <?php 
                   // Run Query at helper.php
                  $schedule = mysqli_fetch_assoc(getSchedule(5));
                  $status = $schedule['status'];


                  if ($status == 'Berlangsung' || $status == 'Menunggu') {
                    $showStatus = true;

                    // function only get name
                    echo '<td>'.$schedule['nama'].' / '.$schedule['kelas'].' / '.$schedule['mataKuliah'].' / '.$schedule['namaDosen'].'</td>';

                    // for style
                    if ($status == 'Menunggu') {
                      $bg   =  'info';
                      $icon   =  'hourglass';
                    } elseif ($status == 'Berlangsung') {
                      $bg   = 'success';
                      $icon   = 'play-circle';
                    } 

                    echo "<td class='text-center'><a class='btn btn-sm btn-$bg' style='padding: 3px 6px; font-size: 10px;'> <i class='glyphicon glyphicon-$icon'></i></a></td>";

                    echo "<td class='text-center'>".nameOnly($schedule['penggunaNim'])."</td>";

                  } else {
                    $showStatus = false;
                    $bg     = 'danger';
                    $icon   = 'remove';

                    echo  "<td><span class='text-danger'>Tidak ada aktivitas</span></td>";

                    echo "<td class='text-center'><a class='btn btn-sm btn-$bg' style='padding: 3px 6px; font-size: 10px;'> <i class='glyphicon glyphicon-$icon'></i></a></td>";

                    echo "<td class='text-center text-danger'>-</td>";

                  }

                   ?>
                  </tr>
                  <tr>
                    <td class="text-center">LG.HDD</td>
                     <?php 
                   // Run Query at helper.php
                  $schedule = mysqli_fetch_assoc(getSchedule(6));
                  $status = $schedule['status'];


                  if ($status == 'Berlangsung' || $status == 'Menunggu') {
                    $showStatus = true;

                    // function only get name
                    echo '<td>'.$schedule['nama'].' / '.$schedule['kelas'].' / '.$schedule['mataKuliah'].' / '.$schedule['namaDosen'].'</td>';

                    // for style
                    if ($status == 'Menunggu') {
                      $bg   =  'info';
                      $icon   =  'hourglass';
                    } elseif ($status == 'Berlangsung') {
                      $bg   = 'success';
                      $icon   = 'play-circle';
                    } 

                    echo "<td class='text-center'><a class='btn btn-sm btn-$bg' style='padding: 3px 6px; font-size: 10px;'> <i class='glyphicon glyphicon-$icon'></i></a></td>";

                    echo "<td class='text-center'>".nameOnly($schedule['penggunaNim'])."</td>";

                  } else {
                    $showStatus = false;
                    $bg     = 'danger';
                    $icon   = 'remove';

                    echo  "<td><span class='text-danger'>Tidak ada aktivitas</span></td>";

                    echo "<td class='text-center'><a class='btn btn-sm btn-$bg' style='padding: 3px 6px; font-size: 10px;'> <i class='glyphicon glyphicon-$icon'></i></a></td>";

                    echo "<td class='text-center text-danger'>-</td>";

                  }

                   ?>
                  </tr>
                </tbody>
               </table>
               <h6 style="margin-top: 20px;">Keterangan</h6>
               <table>
                 <tr>
                   <td style="padding-right: 20px;"><h6 style="font-weight: normal; font-size: 11px;"><a class="btn btn-sm btn-info" style="padding: 3px 6px; font-size: 10px;"><i class="glyphicon glyphicon-hourglass"></i></a> <i class="glyphicon glyphicon-play"></i> Menunggu</h6></td>
                   <td style="padding-right: 20px;"><h6 style="font-weight: normal; font-size: 11px;"><a class="btn btn-sm btn-success" style="padding: 3px 6px; font-size: 10px;"><i class="glyphicon glyphicon-play-circle"></i></a> <i class="glyphicon glyphicon-play"></i> Berlangsung</h6></td>
                   <td style="padding-right: 20px;"><h6 style="font-weight: normal; font-size: 11px;"><a class="btn btn-sm btn-danger" style="padding: 3px 6px; font-size: 10px;"><i class="glyphicon glyphicon-remove"></i></a> <i class="glyphicon glyphicon-play"></i> Tidak ada aktivitas</h6></td>
                 </tr>
               </table>
                  
                   
                  

  </div> <!-- End #MyDIV -->
