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
              <h5 class="title"><?php echo htmlentities($this->session->userdata('nama')); ?></h5>
            </a>
            <p class="description">
              <?php echo htmlentities($this->session->userdata('npm')); ?> <br> <?php echo htmlentities($this->session->userdata('kelas')); ?>
            </p>
            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalPass">Ganti password</button>
            <a href="<?php echo base_url(); ?>qr/<?php echo $this->session->userdata('npm'); ?>.pdf" target="_blank" class="btn btn-sm btn-info">Download QR Code</a>
          </div>
          <br>
          <?php if ($this->session->flashdata('success') != null): ?>
              <div class="alert alert-success">
                  <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="tim-icons icon-simple-remove"></i>
                  </button>
                  <span><b> Success - </b> <?php echo $this->session->flashdata('success'); ?></span>
                </div>
            <?php endif ?>
            <?php if ($this->session->flashdata('fail') != null): ?>
              <div class="alert alert-danger">
                  <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="tim-icons icon-simple-remove"></i>
                  </button>
                  <span><b> Failed - </b> <?php echo $this->session->flashdata('fail'); ?></span>
                </div>
            <?php endif ?>
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
                          <?php echo htmlentities($this->session->userdata('jabatan')); ?>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          DEPARTEMEN
                        </td>
                        <td>
                          <?php echo htmlentities($this->session->userdata('departemen')); ?>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          PUASA
                        </td>
                        <td>
                          <?php echo htmlentities($this->session->userdata('puasa')); ?>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          IZIN BERMALAM
                        </td>
                        <td>
                          <?php echo htmlentities($this->session->userdata('ib')); ?>
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

<!-- Modal -->
<div class="modal fade" id="modalPass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ganti Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo base_url(); ?>index.php/senat/gantiPass">
          <div class="form-group">
            <label class="col-form-label">Password Lama :</label>
            <input type="password" name="pass-lama" class="form-control" id="pass-lama" style="color: black" required>
          </div>
          <div class="form-group">
            <label class="col-form-label">Password Baru :</label>
            <input type="password" name="pass-baru" class="form-control" id="pass-baru" style="color: black" required>
          </div>
          <div class="form-group" >
            <label class="col-form-label">Konfirmasi Password Baru :</label>
            <input type="password" class="form-control" id="pass-baru-konf" style="color: black" required onkeyup="checkPasswordMatch()">
            <div><p id="div-konf"></p></div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" id="btn-pass" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>