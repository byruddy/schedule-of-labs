<div id="detail-help">
  <div class="row">
    <div class="col-sm-4 left">
      <h5><i class=" glyphicon glyphicon-question-sign"></i> Pusat Bantuan</h5>

      <a href="../help"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
    </div>
    <div class="col-sm-8">
      <h5><i class=" glyphicon glyphicon-cog"></i> Pengaturan akun</h5>
      <p class="lead">Anda dapat mengubah kata sandi, disarankan untuk mengkombinasikan sebuah kata sandi Anda. Contoh (cleopatra91) dan ganti secara berkala. 
      <br>

      <?php  
       if (getLevel($_SESSION['user']) == 'staff') {
      ?>

      <div class="sub" style="font-size: 12px;"><strong>Bagaimana kalau saya lupa kata sandi ?</strong>
      <br>
      Silahkan mengubungi ketua lab / Administrator untuk melakukkan pengaturan ulang kata sandi Anda. Persyaratan hanya membawa KTM.</div>
      <br>

      <?php  
        }
      ?>

      <div class="sub" style="font-size: 12px;"><strong>Kesulitan untuk masuk / sign in ?</strong>
      <br>
      Jika Anda pernah mengalami kesulitan dalam masuk pada aplikasi ini, mohon untuk dibaca pesan feedback pada halaman masuk. <br><br><ems>* berikut penjelasan pesan gagal masuk :</em>
      <br>
      <br>
      <div class="penjelasan-error" style="padding: 10px 20px; background-color: #F9F9F9; border: 1px solid #e9e9e9; border-left: 4px solid orange;">
        <div class="alert alert-danger" style="padding: 10px; margin-bottom: 10px; margin-top: 2px;">
        <i class="glyphicon glyphicon-remove-circle"></i> Sorry, Invalid nim or password.
        </div>
        <div class="penjelasan text-muted">
         Pesan ini muncul, ketika Anda salah memasukkan nim atau kata sandi, melainkan nim dan kata sandi tidak cocok
        </div>
      </div>

      <?php  
       if (getLevel($_SESSION['user']) == 'staff') {
      ?>

      <br>
      <br>
      <div class="penjelasan-error" style="padding: 10px 20px; background-color: #F9F9F9; border: 1px solid #e9e9e9; border-left: 4px solid orange;">
        <div class="alert alert-danger" style="padding: 10px; margin-bottom: 10px; margin-top: 2px;">
        <i class="glyphicon glyphicon-ban-circle"></i> Sorry, your account has been suspended!.
        </div>
        <div class="penjelasan text-muted">
         Pesan ini muncul, akun Anda telah dinonaktifkan sementara oleh ketua lab atau administrator. Silahkan tanyakan pada beliau untuk informasi lebih lanjut
        </div>
      </div>
      
      <?php  
        }
      ?>      

    </div>

     </p>
    <div class="row" style="margin-top: 50px;">
      <div class="col-sm-8">
        <h6 style="font-size: 9px;">Tidak menemukan jawaban ? <a href="javascript:AlertIt();"style="display: inline-block; padding: 0px; margin: 0px; background-color: transparent; color: #47B39D; font-size: 9px;"><i class="glyphicon glyphicon-edit"></i> Tanya sekarang!</a></h6>
      </div>
      <div class="col-sm-4">
        <h6 style="font-size: 9px; font-weight: normal; opacity: 0.5;" class="text-muted text-right">Last edited : 23/11/2017</h6>
      </div>
    </div>
    </div>
  </div>
</div> <!-- End #CONTENT -->
