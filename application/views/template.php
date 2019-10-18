<!--
=========================================================
* * Black Dashboard - v1.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/black-dashboard
* Copyright 2019 Creative Tim (https://www.creative-tim.com)


* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?php echo base_url(); ?>/assets/images/hima.png">
  <title>
    <?php echo htmlentities($title); ?> | Sistem Informasi HIMA
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="<?php echo base_url(); ?>/assets/css/nucleo-icons.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="<?php echo base_url(); ?>/assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
  <?php if ($main_view == 'v_ib' || $main_view == 'v_puasa' || $main_view == 'v_jdih' || $main_view == 'v_wajar' || $main_view == 'v_belum_wajar'): ?>
  <!-- Datatabele -->
  <link href="<?php echo base_url(); ?>/assets/datatable/datatables.min.css" rel="stylesheet">
  <?php if (($main_view == 'v_ib' && $this->session->userdata('departemen') == 'Departemen Kesejahteraan Mahasiswa') || ($main_view == 'v_puasa' &&  $this->session->userdata('departemen') == 'Departemen Rohani') || $this->session->userdata('akses') == 'ADMIN'): ?> 
  <!-- Export Button -->
  <link href="<?php echo base_url(); ?>/assets/datatable/export/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>/assets/datatable/export/buttons.bootstrap4.min.css" rel="stylesheet">
  <?php endif ?>
  <?php endif ?>
   <!-- Switch Button -->
  <link href="<?php echo base_url(); ?>/assets/css/switch-button.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>/assets/switchButton/bootstrap-toggle.min.css" rel="stylesheet"> 

</head>

<body class="">
  <div class="wrapper">
    <div class="sidebar">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"
    -->
      <div class="sidebar-wrapper">
        <div class="logo">
          <a href="javascript:void(0)" class="simple-text logo-mini">
            <i class="tim-icons icon-satisfied"></i>
          </a>
          <a href="javascript:void(0)" class="simple-text logo-normal">
            <?php echo htmlentities($this->session->userdata('nama')); ?>
          </a>
        </div>
        <ul class="nav">
          <li>
            <a href="<?php echo base_url(); ?>index.php/senat">
              <i class="tim-icons icon-chart-pie-36"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li>
            <a href="<?php echo base_url(); ?>index.php/senat/jdih">
              <i class="tim-icons icon-chart-pie-36"></i>
              <p>JDIH</p>
            </a>
          </li>
          <li>
            <a href="<?php echo base_url(); ?>index.php/senat/ib">
              <i class="tim-icons icon-atom"></i>
              <p>Izin Bermalam</p>
            </a>
          </li>
          <li>
            <a href="<?php echo base_url(); ?>index.php/senat/puasa">
              <i class="tim-icons icon-pin"></i>
              <p>Puasa</p>
            </a>
          </li>
          <li>
            <a href="<?php echo base_url(); ?>index.php/senat/wajar">
              <i class="tim-icons icon-pin"></i>
              <p>Wajib Belajar</p>
            </a>
          </li>
          <?php if ($this->session->userdata('departemen') == 'Departemen Riset dan Teknologi' || $this->session->userdata('akses') == 'ADMIN'): ?>
          <li>
            <a href="<?php echo base_url(); ?>index.php/senat/admin">
              <i class="tim-icons icon-pin"></i>
              <p>Admin</p>
            </a>
          </li>
          <?php endif ?>
          
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle d-inline">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="javascript:void(0)">Sistem Informasi HIMA</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav ml-auto">
              <li class="dropdown nav-item">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                  <div class="photo">
                    <img src="<?php echo base_url(); ?>/assets/img/default-avatar.png" alt="Profile Photo">
                  </div>
                  <b class="caret d-none d-lg-block d-xl-block"></b>
                  <p class="d-lg-none">
                    Log out
                  </p>
                </a>
                <ul class="dropdown-menu dropdown-navbar">
                  <li class="nav-link"><a href="<?php echo base_url(); ?>index.php/auth/logout" class="nav-item dropdown-item">Log out</a></li>
                </ul>
              </li>
              <li class="separator d-lg-none"></li>
            </ul>
          </div>
        </div>
      </nav>
      
      <?php $this->load->view($main_view); ?>
      
      <footer class="footer">
        <div class="container-fluid">
          <ul class="nav">
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                HIMA STSN
              </a>
            </li>
          </ul>
          <div class="copyright">
            ©
            <script>
              document.write(new Date().getFullYear())
            </script> made with <i class="tim-icons icon-heart-2"></i> by
            <a href="javascript:void(0)">Departemen Riset dan Teknologi</a> for a better web.
          </div>
        </div>
      </footer>
    </div>
  </div>
  <div class="fixed-plugin">
    <div class="dropdown show-dropdown">
      <a href="#" data-toggle="dropdown">
        <i class="fa fa-cog fa-2x"> </i>
      </a>
      <ul class="dropdown-menu">
        <li class="header-title"> Sidebar Background</li>
        <li class="adjustments-line">
          <a href="javascript:void(0)" class="switch-trigger background-color">
            <div class="badge-colors text-center">
              <span class="badge filter badge-primary active" data-color="primary"></span>
              <span class="badge filter badge-info" data-color="blue"></span>
              <span class="badge filter badge-success" data-color="green"></span>
            </div>
            <div class="clearfix"></div>
          </a>
        </li>
        <li class="adjustments-line text-center color-change">
          <span class="color-label">LIGHT MODE</span>
          <span class="badge light-badge mr-2"></span>
          <span class="badge dark-badge ml-2"></span>
          <span class="color-label">DARK MODE</span>
        </li>
      </ul>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="<?php echo base_url(); ?>/assets/js/core/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>/assets/js/core/popper.min.js"></script>
  <script src="<?php echo base_url(); ?>/assets/js/core/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>/assets/js/black-dashboard.min.js?v=1.0.0"></script>
  <?php if ($main_view == 'v_ib' || $main_view == 'v_puasa' || $main_view == 'v_jdih' || $main_view == 'v_wajar' || $main_view == 'v_belum_wajar'): ?>
     <!-- Datatable -->
     <script src="<?php echo base_url(); ?>/assets/datatable/datatables.min.js"></script>

    <?php if (($main_view == 'v_ib' && $this->session->userdata('departemen') == 'Departemen Kesejahteraan Mahasiswa') || ($main_view == 'v_puasa' &&  $this->session->userdata('departemen') == 'Departemen Rohani') || $this->session->userdata('akses') == 'ADMIN'): ?>  
      <!-- Export Button -->
      <script src="<?php echo base_url(); ?>/assets/datatable/export/dataTables.bootstrap4.min.js"></script>
      <script src="<?php echo base_url(); ?>/assets/datatable/export/dataTables.buttons.min.js"></script>
      <script src="<?php echo base_url(); ?>/assets/datatable/export/buttons.bootstrap4.min.js"></script>
      <script src="<?php echo base_url(); ?>/assets/datatable/export/jszip.min.js"></script>
      <script src="<?php echo base_url(); ?>/assets/datatable/export/pdfmake.min.js"></script>
      <script src="<?php echo base_url(); ?>/assets/datatable/export/vfs_fonts.js"></script>
      <script src="<?php echo base_url(); ?>/assets/datatable/export/buttons.html5.min.js"></script>
      <script src="<?php echo base_url(); ?>/assets/datatable/export/buttons.print.min.js"></script>
      <script src="<?php echo base_url(); ?>/assets/datatable/export/buttons.colVis.min.js"></script>
      <script src="<?php echo base_url(); ?>/assets/switchButton/bootstrap-toggle.min.js"></script>
    <?php endif ?>
  <?php endif ?>

<script>$(document).ready(function() {
    $().ready(function() {
        $sidebar=$('.sidebar');
        $navbar=$('.navbar');
        $main_panel=$('.main-panel');
        $full_page=$('.full-page');
        $sidebar_responsive=$('body > .navbar-collapse');
        sidebar_mini_active= !0;
        white_color= !1;
        window_width=$(window).width();
        fixed_plugin_open=$('.sidebar .sidebar-wrapper .nav li.active a p').html();
        $('.fixed-plugin a').click(function(event) {
            if($(this).hasClass('switch-trigger')) {
                if(event.stopPropagation) {
                    event.stopPropagation()
                }
                else if(window.event) {
                    window.event.cancelBubble= !0
                }
            }
        }
        );
        $('.fixed-plugin .background-color span').click(function() {
            $(this).siblings().removeClass('active');
            $(this).addClass('active');
            var new_color=$(this).data('color');
            if($sidebar.length !=0) {
                $sidebar.attr('data', new_color)
            }
            if($main_panel.length !=0) {
                $main_panel.attr('data', new_color)
            }
            if($full_page.length !=0) {
                $full_page.attr('filter-color', new_color)
            }
            if($sidebar_responsive.length !=0) {
                $sidebar_responsive.attr('data', new_color)
            }
        }
        );
        $('.light-badge').click(function() {
            $('body').addClass('white-content')
        }
        );
        $('.dark-badge').click(function() {
            $('body').removeClass('white-content')
        }
        )
    }
    )
}

);
</script><script type="text/javascript">$(document).ready(function() {
    <?php if($this->session->userdata('departemen')=='Departemen Kesejahteraan Mahasiswa'||$this->session->userdata('akses')=='ADMIN'):?>$('#tableib').DataTable( {
        dom: 'Bfrtip', lengthChange: !1, buttons:['copy', 'excel', 'pdf', 'colvis']
    }
    );
    table.buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
    <?php else:?>$('#tableib').DataTable();
    <?php endif?><?php if($this->session->userdata('departemen')=='Departemen Rohani'||$this->session->userdata('akses')=='ADMIN'):?>$('#tablepuasa').DataTable( {
        dom: 'Bfrtip', lengthChange: !1, buttons:['copy', 'excel', 'pdf', 'colvis']
    }
    );
    table.buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
    <?php else:?>$('#tablepuasa').DataTable();
    <?php endif?>
}

);
$('#tablewajar').DataTable();
</script><script type="text/javascript">function checkPasswordMatch() {
    var password=$("#pass - baru ").val();
    var confirmPassword=$("#pass - baru - konf ").val();
    if(password !=confirmPassword) $("#div-konf").html("Passwords do not match!").css('color', 'red');
    else $("#div-konf").html("Passwords match.").css('color', 'green')
}

</script>
</body>
</html>