<!-- End Navbar -->
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card card-user">
        <div class="card-body">
          <p class="card-text">
          </p><div class="author">
            <div class="block block-one"></div>
            <div class="block block-two"></div>
            <div class="block block-three"></div>
            <div class="block block-four"></div>
            <a href="javascript:void(0)">
              <img class="avatar" src="<?php echo base_url(); ?>/assets/img/default-avatar.png" alt="...">
              <h5 class="title"><?php echo $this->session->userdata('nama'); ?></h5>
            </a>
            <p class="description">
              <?php echo $this->session->userdata('npm'); ?> <br> <?php echo $this->session->userdata('kelas'); ?>
            </p>
            <a href="#" class="btn btn-sm btn-warning">Ganti Password</a>
          </div>
          <p></p>
          <div class="card-description">
           <div class="col-md-12">
            <div class="card  card-plain">
              <div class="card-header">
                <h4 class="card-title"> Informasi Mahasiswa</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive ps">
                  <table class="table tablesorter " id="">
                    <tbody>
                      <tr>
                        <td>
                          JABATAN
                        </td>
                        <td>
                          <?php echo $this->session->userdata('jabatan'); ?>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          DEPARTEMEN
                        </td>
                        <td>
                          <?php echo $this->session->userdata('departemen'); ?>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          PUASA
                        </td>
                        <td>
                          <?php echo $this->session->userdata('puasa'); ?>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          IZIN BERMALAM
                        </td>
                        <td>
                          <?php echo $this->session->userdata('ib'); ?>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
                  <div class="row">
                    <div class="col-md-6">
                      <a href="#" class="btn-block btn btn-success btn-md">Download Aplikasi Karya</a>
                    </div>
                    <div class="col-md-6">
                      <a href="#" class="btn-block btn btn-success btn-md">Download Sertifikat Digital</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
