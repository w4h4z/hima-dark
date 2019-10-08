<!DOCTYPE html>
<html lang="eng">

<head>
  <title>HIMA STSN | Login</title>
  <!-- Meta-Tags -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <meta name="keywords" content="">

      <!-- Bootstrap 3.3.7 -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">

      <!-- //Custom-Stylesheet-Links -->
      <!--fonts -->
      <!-- <link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext" rel="stylesheet"> -->
      <!-- //fonts -->
      <!-- Font-Awesome-File -->

      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fontawesome-all.css" type="text/css" media="all">
    </head>

    <body style="overflow-x: hidden">
      <h1 class="title-agile text-center">Sistem Informasi HIMA</h1>
      <div class="row">
        <div class="col-md-6 col-xs-12" style="padding-right:20px; border-right: 2px solid #ccc;">
          <img src="<?php echo base_url('assets/images/hima.svg'); ?>" class="img-responsive center-block" style="width: 35%"><br>
          <p style="margin-left: 50px;margin-right: 50px;font-weight: 600; letter-spacing: 1px; font-size: 1em;line-height: 1.4">
            Ini merupakan halaman website Himpunan Mahasiswa STSN 2019. Kami hadir untuk membantu mahasiswa dalam pelayanan Sistem Informasi HIMA STSN.<br>
            Semoga dengan adanya sarana ini dapat mempermudah mahasiswa dalam mengakses informasi mengenai Himpunan mahasiswa.
          </p>
        </div>
        <div class="col-md-6 col-xs-12">
          <div class="agileits-grid center-block">
            <div class="content-top-agile">
              <h2>Silahkan Login</h2>
            </div>
            <?php if ($this->session->flashdata('notif') != null): ?>
              <div class="alert alert-danger col-md-12" style="margin-top: 20px; margin-bottom: -20px">
                <p><?php echo $this->session->flashdata('notif'); ?></p>
              </div>
            <?php endif ?>
            <div class="content-bottom">
              <form action="<?php echo base_url(); ?>index.php/auth/do_login" method="post" id="login-form">
                <div class="field_w3ls">
                  <div class="field-group">
                    <input name="npm" id="npm" autocomplete="off" type="number" placeholder="NPM" required/>
                  </div>
                  <div class="field-group">
                    <input id="password-field" autocomplete="off" type="password" name="password" placeholder="Password" required/>
                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                  </div> 
                </div>
                <div class="wthree-field">
                  <button id="sbmt" name="saveForm" class="ladda-button" type="submit"><span class="ladda-label"> Login</span></button>
                </div>
              </form>
            </div>
            <!-- //content bottom -->
          </div>
        </div>
      </div>
      <div class="copyright text-center">
        <p>© 2019 Himpunan Mahasiswa STSN. All rights reserved.</p>
      </div>

  <!--//copyright-->
  <script src="<?php echo base_url(); ?>assets/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- script for show password -->
  <script type="text/javascript">
      $( document ).ready(function() {

        $(".toggle-password").click(function () {
          $(this).toggleClass("fa-eye fa-eye-slash");
          var input = $($(this).attr("toggle"));
          if (input.attr("type") == "password") {
            input.attr("type", "text");
          } else {
            input.attr("type", "password");
          }
        });

      })
    </script>
    <!-- /script for show password -->
  </body>
  <!-- //Body -->

  </html>